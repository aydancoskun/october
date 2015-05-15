<?php namespace Responsiv\Campaign\Classes;

use Mail;
use Event;
use Responsiv\Campaign\Models\Message;
use Responsiv\Campaign\Models\Subscriber;
use Responsiv\Campaign\Models\MessageStatus;
use Carbon\Carbon;

class CampaignManager
{

    use \October\Rain\Support\Traits\Singleton;

    public function process()
    {
        $this->processActive();
        $this->checkPending();
    }

    public function confirmReady($campaign)
    {
        if (!$campaign->is_delayed) {
            $campaign->launch_at = $campaign->freshTimestamp();
        }

        $campaign->status = MessageStatus::getPendingStatus();
        $campaign->save();

        if (!$campaign->is_delayed) {
            $this->launchCampaign($campaign);
        }
    }

    public function checkPending()
    {
        $now = new Carbon;
        $pendingId = MessageStatus::getPendingStatus()->id;

        $firstCampaign = Message::where('status_id', $pendingId)
            ->get()
            ->filter(function($message) use ($now) { return $message->launch_at <= $now; })
            ->shift()
        ;

        if ($firstCampaign) {
            $this->launchCampaign($firstCampaign);
        }
    }

    public function archiveCampaign($campaign)
    {
        // Change status to archived
        $campaign->status = MessageStatus::getArchivedStatus();
        $campaign->save();

        // Delete all subscriber info @todo
    }

    public function cancelCampaign($campaign)
    {
        // Change status to cancelled
        $campaign->status = MessageStatus::getCancelledStatus();
        $campaign->save();
    }

    public function launchCampaign($campaign)
    {
        $this->bindListSubscribers($campaign);
        $this->bindGroupSubscribers($campaign);
        $this->unbindSubscribers($campaign);

        // Change status to active
        $campaign->status = MessageStatus::getActiveStatus();

        $campaign->rebuildStats();
        $campaign->save();

        if ($campaign->is_repeating) {
            $this->repeatCampaign($campaign);
        }
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

    public function processActive()
    {
        $activeId = MessageStatus::getActiveStatus()->id;
        $campaigns = Message::where('status_id', $activeId)->get();

        foreach ($campaigns as $campaign) {
            $subscribers = $campaign->subscribers()->whereNull('sent_at');

            if (($staggerCount = $campaign->getStaggerCount()) !== -1) {
                $subscribers->limit($staggerCount);
            }

            $subscribers = $subscribers->get();

            foreach ($subscribers as $subscriber) {
                $this->sendToSubscriber($campaign, $subscriber);
                $subscriber->pivot->sent_at = $subscriber->freshTimestamp();
                $subscriber->pivot->save();
                $campaign->count_sent++;
            }

            if ($campaign->count_sent >= $campaign->count_subscriber) {
                $campaign->status = MessageStatus::getSentStatus();
            }

            $campaign->rebuildStats();
            $campaign->save();
        }
    }

    public function sendToSubscriber($campaign, $subscriber)
    {
        $html = $campaign->renderForSubscriber($subscriber);
        $text = $this->getTextMessage($campaign->getBrowserUrl($subscriber));
        Mail::rawTo($subscriber, ['html' => $html, 'text' => $text], function($message) use ($campaign) {
            $message->subject($campaign->subject);
        });
    }

    protected function getTextMessage($browserUrl)
    {
        //@todo Convert to language strings
        $lines = [];
        $lines[] = '---------------------------------------------';
        $lines[] = '------- Graphical email content';
        $lines[] = '---------------------------------------------';
        $lines[] = 'This email contains graphical content, you may view it in your browser using the address located below.';
        $lines[] = '<'.$browserUrl.'>';
        $lines[] = '---------------------------------------------';
        return implode(PHP_EOL.PHP_EOL, $lines);
    }

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
    protected function bindGroupSubscribers($campaign)
    {
        $groups = $campaign->groups;
        if (!is_array($groups)) return;

        $groupSubscribers = [];

        foreach ($groups as $groupType) {
            $groupSubscribers = $groupSubscribers + $this->getGroupRecipientsData($groupType);
        }

        $currentSubscribers = Subscriber::lists('id', 'email');
        $newSubscribers = array_diff_key($groupSubscribers, $currentSubscribers);

        $ids = [];

        foreach ($currentSubscribers as $email => $id) {
            $ids[] = $id;
        }

        foreach ($newSubscribers as $email => $info) {
            $info['email'] = $email;
            $subscriber = Subscriber::create($info);
            $ids[] = $subscriber->id;
        }

        if (count($ids) > 0) {
            $campaign->subscribers()->sync($ids, false);
        }
    }

    /**
     * Removes subscribers that have unsubscribed.
     */
    protected function unbindSubscribers($campaign)
    {
        $unsubscribed = $campaign->subscribers()
            ->whereNotNull('unsubscribed_at')
            ->lists('id');

        $campaign->subscribers()->detach($unsubscribed);
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