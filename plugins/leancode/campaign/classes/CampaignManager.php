<?php namespace Leancode\Campaign\Classes;

use Mail;
use Event;
use Leancode\Campaign\Models\Message;
use Leancode\Campaign\Models\Subscriber;
use Leancode\Campaign\Models\MessageStatus;
use Carbon\Carbon;
use ApplicationException;
use Html2Text\Html2Text;
use DB;
use Swift_SmtpTransport;
use Swift_Mailer;

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
            throw new ApplicationException('Sorry, you cannot recreate this mailing because it has addresses assigned to it.');
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
	    $backup_original_mailer = Mail::getSwiftMailer();
		// Setup our other mailer if needed
        $transport = Swift_SmtpTransport::newInstance('oktick-beta.com', 587,'tls' => ['verify_peer' => false]); // 'ssl', 'tls'
		$transport->setUsername('bounce.oktick-beta');
		$transport->setPassword('30c6f2fb4d2f9fdc1650cbfe8d38ca97');
		$transport->verify_peer(false);
/*
		$contextOptions = [
    'tls' => [
        'verify_peer' => false,
        'cafile' => '/path/to/cafile.pem',
        'CN_match' => 'example.com',
    ]
];
$context = stream_context_create($contextOptions);
*/

		// Any other mailer configuration stuff needed...
		$massmailer = new Swift_Mailer($transport);
		// Set the mailer as gmail
		Mail::setSwiftMailer($massmailer);

        $html = $campaign->renderForSubscriber($subscriber);
        $text = Html2Text::convert(str_replace(array("\r", "\n"), "", $html));
//        $text = $this->getTextMessage($campaign->getBrowserUrl($subscriber));
	        Mail::rawTo($subscriber, ['html' => $html, 'text' => $text], function($message) use ($campaign) {
    	    $message->subject($campaign->subject);
        });
		// Restore our original mailer
		Mail::setSwiftMailer($backup_original_mailer);
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
			$sql =	"insert INTO leancode_campaign_messages_subscribers ".
		    		"(".
		    		"SELECT ".
		    		"'$campaign->id', subscriber_id, null, null, null ".
		    		"FROM leancode_campaign_lists_subscribers ".
	    			"where list_id='$list->id'".
	    			") ON DUPLICATE KEY UPDATE message_id=message_id";
	    	$results =	DB::statement( DB::raw($sql) );
//	            $ids = $list->subscribers()->lists('id');
//            if ($ids && count($ids) > 0) {
//                $campaign->subscribers()->sync($ids, false);
//            }
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
        $apiResult = Event::fire('leancode.campaign.getRecipientsData', [$type]);
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
