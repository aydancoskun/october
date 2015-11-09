<?php namespace Leancode\Campaign\Classes;

use Mail;
use Event;
use Leancode\Campaign\Models\Message;
use Leancode\Campaign\Models\Subscriber;
use Leancode\Campaign\Models\MessageStatus;
use Carbon\Carbon;
use ApplicationException;
use DB;

/**
 * Worker class, engaged by the automated worker
 */
class CampaignWorker
{

    use \October\Rain\Support\Traits\Singleton;

    /**
     * @var Leancode\Campaign\Classes\CampaignManager
     */
    protected $campaignManager;

    /**
     * @var bool There should be only one task performed per execution.
     */
    protected $isReady = true;

    /**
     * @var string Processing message
     */
    protected $logMessage = 'There are no outstanding activities to perform.';

    /**
     * Initialize this singleton.
     */
    protected function init()
    {
        $this->campaignManager = CampaignManager::instance();
    }

    /*
     * Process all tasks
     */
    public function process()
    {
        $this->isReady && $this->processPendingMessages();
        $this->isReady && $this->processActiveMessages();

        // @todo Move this action so the user can do it manually
        // $this->isReady && $this->processUnsubscribedSubscribers();

        return $this->logMessage;
    }

    /**
     * This will launch pending campaigns if there launch date has
     * passed.
     */
    public function processPendingMessages()
    {
        $now = new Carbon;
        $pendingId = MessageStatus::getPendingStatus()->id;

        $campaign = Message::where('status_id', $pendingId)
            ->get()
            ->filter(function($message) use ($now) {
                return $message->launch_at <= $now;
            })
            ->shift()
        ;

        if ($campaign) {
            $this->campaignManager->launchCampaign($campaign);

            $this->logActivity(sprintf(
                'Launched campaign "%s" with %s subscriber(s) queued.',
                $campaign->name,
                $campaign->count_subscriber
            ));
        }
    }

    /**
     * This will send messages subscribers of active campaigns.
     */
    public function processActiveMessages()
    {
        $hourAgo = new Carbon;
        $hourAgo = $hourAgo->subMinutes(1);

        $activeId = MessageStatus::getActiveStatus()->id;

        $campaign = Message::where('status_id', $activeId)
            ->get()
            ->filter(function($message) use ($hourAgo) {
                return !$message->processed_at ||
                    $message->processed_at <= $hourAgo;
            })
            ->shift()
        ;
        if ($campaign) {
	        $subscribers_lists = $campaign->subscriber_lists()->get();
		    $is_send_to_start_list = false;
		    foreach ($subscribers_lists as $subscribers_list) {
		    	if( $subscribers_list->id == 1) {// i.e. the main start list
		    		$is_send_to_start_list = true;
		    		break;
		    	}
	        }

	        $staggerCount = $campaign->getStaggerCount();
            $countSent = 0;
            while( $subscribers = $campaign->subscribers()->whereNull('sent_at')->limit(500)->get()){

	            foreach ($subscribers as $subscriber) {

    	            if ( ! filter_var($subscriber->email, FILTER_VALIDATE_EMAIL) ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 110 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because email invalid \n";
            	        continue;
    	            }
    	            if ( ! $subscriber->company_id ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 120 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because no company id \n";
    	            	continue;
    	            }
    	            if ( $subscriber->unsubscribed_at ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 90 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because unsubscribed \n";
    	            	continue;
    	            }
    	            if ( $subscriber->blacklisted_at ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 100 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because blacklisted \n";
    	            	continue;
    	            }
    	            if ( $subscriber->is_activated ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 3 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because is activated already and does not need promotion \n";
    	            	continue;
    	            }
    	            if ( ! $subscriber->confirmed_at) {
    	            	$subscriber->confirmed_at = time();
    	            	$subscriber->save();
    	            }
    	            if ( ! $subscriber->activation_code) {
    	            	$subscriber->activation_code = md5("ipiresearch".$subscriber->email);
    	            	$subscriber->save();
    	            }
	                $num_send = $this->campaignManager->sendToSubscriber($campaign, $subscriber,$is_send_to_start_list);
    	            if ( ! $num_send ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 150 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo __FILE__.":".__LINE__." Subscriber $subscriber->email removed because of failure\n";
    	            	continue;
    	            }
                   	if (strpos(php_sapi_name(), 'cli') !== false) echo __FILE__.":".__LINE__." Mailing $subscriber->email\n";
//                   	if (strpos(php_sapi_name(), 'cli') !== false) echo __FILE__.":".__LINE__." BLOCKED $subscriber->email\n";

    	            $subscriber->pivot->sent_at = $subscriber->freshTimestamp();
        	        $subscriber->pivot->save();
            	    $campaign->count_sent++;
					$countSent++;

                    if ( $staggerCount !== -1 && $countSent >= $staggerCount ) {
                    	break 2;
                    }
	            }
            	if( ! count($subscribers) ) break;
			}
            if ($campaign->count_sent >= $campaign->count_subscriber) {
                $campaign->status = MessageStatus::getSentStatus();

            }

            $campaign->rebuildStats();
            $campaign->processed_at = $campaign->freshTimestamp();
            $campaign->save();

			// step 1
			$sql =	"UPDATE leancode_campaign_lists_subscribers a, leancode_campaign_messages_subscribers b SET list_id = 2 WHERE a.subscriber_id = b.subscriber_id AND list_id = 1 AND b.sent_at <> ''";
	    	DB::statement( DB::raw($sql) );

			// step 2
			$sql =	"UPDATE leancode_campaign_lists_subscribers a, users b SET list_id = 3 WHERE a.subscriber_id = b.id AND list_id = 2 AND b.is_activated = 1";
	    	DB::statement( DB::raw($sql) );

			// step 3
			$sql =	"UPDATE leancode_campaign_lists_subscribers a, users b SET list_id = 4 WHERE a.subscriber_id = b.id AND list_id = 3 AND b.ok_free_credits_datetime <> '0000-00-00 00:00:00'";
	    	DB::statement( DB::raw($sql) );

			// step 3
			$sql =	"UPDATE leancode_campaign_lists_subscribers a, operations.bp_sponsors b SET list_id = 5 WHERE a.subscriber_id = b.user_id AND list_id = 4";
	    	DB::statement( DB::raw($sql) );

            $this->logActivity(sprintf(
                'Sent campaign "%s" to %s subscriber(s).',
                $campaign->name,
                $countSent
            ));
        }

    }

    /**
     * This will find subscribers who are unsubscribed for longer
     * than 14 days and delete their account.
     */
    public function processUnsubscribedSubscribers()
    {
        $endDate = new Carbon;
        $endDate = $endDate->subDays(14);

        $subscriber = Subscriber::whereNotNull('unsubscribed_at')
            ->get()
            ->filter(function($subscriber) use ($endDate) {
                return $subscriber->unsubscribed_at <= $endDate;
            })
            ->shift()
        ;

        if ($subscriber) {
//            $subscriber->delete();

            $this->logActivity(sprintf(
                'Deleted subscriber "%s"  who opted out 14 days ago.',
                $subscriber->email
            ));
        }
    }

    /**
     * Called when activity has been performed.
     */
    protected function logActivity($message)
    {
        $this->logMessage = $message;
        $this->isReady = false;
    }

}
