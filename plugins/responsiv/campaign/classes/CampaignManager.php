<?php
namespace Responsiv\Campaign\Classes;
use Mail;
use Event;
use Responsiv\Campaign\Models\Message;
use Responsiv\Campaign\Models\Subscriber;
use Responsiv\Campaign\Models\MessageStatus;
use Carbon\Carbon;
use ApplicationException;
use soundasleep\Html2Text;

class CampaignManager
{

    use \October\Rain\Support\Traits\Singleton;

    //
    // State
    //

    /**
     * Sets the status to pending, ready to be picked up by
     * the worker process.
     */
    public function confirmReady($campaign)
    {
        if (!$campaign->is_delayed) {
            $campaign->launch_at = $campaign->freshTimestamp();
        }

        $campaign->status = MessageStatus::getPendingStatus();
        $campaign->save();
    }

    /**
     * Sets the status to active, binds all the subscribers to the message,
     * recompiles the stats and repeats the campaign.
     */
    public function launchCampaign($campaign)
    {
        $campaign->status = MessageStatus::getActiveStatus();
        $campaign->save();

        $this->bindListSubscribers($campaign);
        $this->bindGroupSubscribers($campaign);

        $campaign->rebuildStats();
        $campaign->save();

        if ($campaign->is_repeating) {
            $this->repeatCampaign($campaign);
        }
    }

    /**
     * When a campaign has no subscribers
     */
    public function recreateCampaign($campaign)
    {
        if ($campaign->count_subscriber > 0) {
            throw new ApplicationException('Sorry, you cannot recreate this campaign because it has subscribers belonging to it.');
        }

        $campaign->status = MessageStatus::getDraftStatus();
        $campaign->save();
    }

    public function archiveCampaign($campaign)
    {
        // Delete all subscriber info in the pivot table
        $campaign->subscribers()->detach();

        $campaign->status = MessageStatus::getArchivedStatus();
        $campaign->save();
    }

    public function cancelCampaign($campaign)
    {
        $campaign->status = MessageStatus::getCancelledStatus();
        $campaign->save();
    }

    public function repeatCampaign($campaign)
    {
        $duplicate = $campaign->duplicateCampaign();
        $duplicate->is_delayed = true;

        $now = $campaign->freshTimestamp();
        switch ($campaign->repeat_frequency) {
            case 'daily': $now = $now->addDay(); break;
            case 'weekly': $now = $now->addWeek(); break;
            case 'monthly': $now = $now->addMonth(); break;
            case 'yearly': $now = $now->addYear(); break;
            default: $now = $now->addYears(5); break;
        }

        $duplicate->launch_at = $now;
        $duplicate->status = MessageStatus::getPendingStatus();
        $duplicate->count_repeat++;
        $duplicate->save();

        return $duplicate;
    }

    //
    // Sending
    //

    public function sendToSubscriber($campaign, $subscriber)
    {
        $html = $campaign->renderForSubscriber($subscriber);
        $text = Html2Text::convert(str_replace(array("\r", "\n"), "", $html));
//        $text = $this->getTextMessage($campaign->getBrowserUrl($subscriber));
        Mail::rawTo($subscriber, ['html' => $html, 'text' => $text], function($message) use ($campaign) {
        $message->subject($campaign->subject);
        });
    }

    protected function getTextMessage($browserUrl)
    {
        $lines = [];
        $lines[] = '---------------------------------------------';
        $lines[] = '------- Graphical email content';
        $lines[] = '---------------------------------------------';
        $lines[] = 'This email contains graphical content, you may view it in your browser using the address located below.';
        $lines[] = '<'.$browserUrl.'>';
        $lines[] = '---------------------------------------------';
        return implode(PHP_EOL.PHP_EOL, $lines);
    }

    //
    // Helpers
    //

    /**
     * Binds all subscribers from the campaign lists to the message.
     */
    protected function bindListSubscribers($campaign)
    {
        if (!$campaign->subscriber_lists()->count())
            return;

        foreach ($campaign->subscriber_lists as $list) {
            $ids = $list->subscribers()->lists('id');

            if ($ids && count($ids) > 0) {
                $campaign->subscribers()->sync($ids, false);
            }
        }
    }

    /**
     * Binds all subscribers from the campaign groups to the message.
     */
    public function bindGroupSubscribers($campaign)
    {
        $groups = $campaign->groups;
        if (!is_array($groups)) return;

        /*
         * Get all group subscriber emails and info
         */
        $groupSubscribers = [];

        foreach ($groups as $groupType) {
            $groupSubscribers = $groupSubscribers + $this->getGroupRecipientsData($groupType);
        }

        /*
         * Pair them to existing subscribers, or create them
         */
        $allSubscribers = Subscriber::lists('id', 'email');
        $ids = [];

        foreach ($groupSubscribers as $email => $info) {
            /*
             * New subscriber
             */
            if (!isset($allSubscribers[$email])) {
                $info['email'] = $email;
                $subscriber = new Subscriber;
                $subscriber->forceFill($info);
                $subscriber->confirmed_at = Carbon::now();
                $subscriber->save();
                $ids[] = $subscriber->id;
            }
            /*
             * Existing subscriber
             */
            else {
                $ids[] = $allSubscribers[$email];
            }
        }

        /*
         * Sync to the campaign
         */
        if (count($ids) > 0) {
            $campaign->subscribers()->sync($ids, false);
        }
    }

    /**
     * Returns an array of subscribers provided by a custom campaign group.
     */
    public function getGroupRecipientsData($type)
    {
        $result = [];
        $apiResult = Event::fire('responsiv.campaign.getRecipientsData', [$type]);
        if (is_array($apiResult)) {
            foreach ($apiResult as $data) {
                if (!is_array($data)) {
                    continue;
                }

                $result = $result + $data;
            }
        }

        return $result;
    }

}
