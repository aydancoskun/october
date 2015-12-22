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
    public function process($test=false)
    {
        $this->isReady && $this->processPendingMessages($test);
        $this->isReady && $this->processActiveMessages($test);

        // @todo Move this action so the user can do it manually
        // $this->isReady && $this->processUnsubscribedSubscribers();

        return $this->logMessage;
    }

    /**
     * This will launch pending campaigns if there launch date has
     * passed.
     */
    public function processPendingMessages($test=false)
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
            $this->campaignManager->launchCampaign($campaign,$test);

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
    public function processActiveMessages($test=false)
    {
        $hourAgo = new Carbon;
        $hourAgo = $hourAgo->subMinutes(1);

        $activeId = MessageStatus::getActiveStatus()->id;

		while ($campaign = Message::where('status_id', $activeId)
            ->get()
            ->filter(function($message) use ($hourAgo) {
                return !$message->processed_at ||
                    $message->processed_at <= $hourAgo;
            })
            ->shift()
        ) {
	    	$subscribers_lists = $campaign->subscriber_lists()->get();
		    $use_massmailer = false;
		    foreach ($subscribers_lists as $subscribers_list) {
		    	if( $subscribers_list->id == 1 OR $subscribers_list->id == 99 ) {// i.e. the main start list to which large amount of mails are being sent
		    		$use_massmailer = true;
		    		break;
		    	}
	        }

	        $staggerCount = $campaign->getStaggerCount();
            $countSent = 0;
            if ($test) {
                $operation = "<";
                $operator = "50";
            } else {
                $operation = ">";
                $operator = "0";
            }
            while( $subscribers = $campaign->subscribers()->Where("id",$operation, $operator)->whereNull('sent_at')->limit(500)->get()){

	            foreach ($subscribers as $subscriber) {
	                if ($test and $subscriber->id < 50) {
                        $sql = <<<ENDSQL
UPDATE oktick.users SET
 PASSWORD = '',
 NAME = NULL,
 persist_code = NULL,
 phone = NULL,
 street_addr = NULL,
 city= NULL,
 zip= NULL,
 primary_usergroup=0,
 ok_first_name= NULL,
 ok_sample_products= NULL,
 ok_unsubscribed_at = NULL,
 ok_blacklisted_at = NULL,
 ok_created_ip_address = NULL,
 ok_confirmed_ip_address = NULL,
 ok_free_credits_datetime = '0000-00-00 00:00:00',
 ok_invoice_address_1 = "",
 ok_invoice_address_2 = "",
 ok_invoice_city = "",
 ok_invoice_country = "",
 ok_invoice_name = "",
 ok_invoice_state = "",
 ok_invoice_zip = "",
 ok_vendor_data = "",
 ok_sponored_products_count = 0,
 ok_company_name = "",
 ok_purchase_number = 0,
 last_login = NULL,
 is_activated = 0,
 activated_at = NULL,
 ok_credits = 0,
 ok_purchase_number = 0,
 surname = "",
 ok_vendor_data = "",
 company = "",
 iu_gender = NULL,
 iu_job = NULL,
 iu_about = NULL,
 iu_webpage = NULL,
 iu_blog = NULL,
 iu_facebook = NULL,
 iu_twitter = NULL,
 iu_skype = NULL,
 iu_icq = NULL,
 iu_comment = NULL,
 iu_telephone = NULL,
 iu_company = NULL
WHERE
 id = $subscriber->id AND ok_company_id = 1;
ENDSQL;
           	    	    DB::statement( DB::raw($sql) );
                        $sql = "UPDATE operations.bp_supplier_positions SET bp_position = 6 WHERE company_id = 1;";
           	    	    DB::statement( DB::raw($sql) );
                        $sql = "DELETE FROM operations.bp_sponsors WHERE user_id = $subscriber->id AND company_id = 1;";
           	    	    DB::statement( DB::raw($sql) );

                    }
    	            if ( ! filter_var($subscriber->email, FILTER_VALIDATE_EMAIL) ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 110 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". Mail invalid \n";
            	        continue;
    	            }
    	            if ( ! $subscriber->company_id ) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 120 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". No company id \n";
    	            	continue;
    	            }
    	            if ( $subscriber->unsubscribed_at && $subscriber->company_id <> 1 && ! $test) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 90 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". Unsubscribed \n";
    	            	continue;
    	            }
    	            if ( $subscriber->blacklisted_at && $subscriber->company_id <> 1 && ! $test) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 100 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". Blacklisted \n";
    	            	continue;
    	            }
    	            if ( $use_massmailer == true && $subscriber->is_activated && $subscriber->company_id <> 1 && ! $test) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 3 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". Already active \n";
    	            	continue;
    	            }
    	            if ( ! $subscriber->confirmed_at) {
    	            	$subscriber->confirmed_at = time();
    	            	$subscriber->save();
    	            }
    	            if ( ! $subscriber->activation_code) {
    	            	$subscriber->activation_code = md5(env('APP_KEY') . $subscriber->email);
    	            	$subscriber->save();
    	            }
    	            //$use_massmailer=true;
	                $num_send = $this->campaignManager->sendToSubscriber($campaign, $subscriber,$use_massmailer);
    	            if ( ! $num_send  && $subscriber->company_id <> 1 && ! $test) {
						$sql =	"UPDATE leancode_campaign_lists_subscribers SET list_id = 150 WHERE subscriber_id = ".$subscriber->id;
        	            $campaign->subscribers()->remove($subscriber);
        	            $campaign->count_subscriber--;
            	    	DB::statement( DB::raw($sql) );
        	            if (strpos(php_sapi_name(), 'cli') !== false)
        	            	echo $campaign->name . ": Removed " . $subscriber->email . ". Failure \n";
    	            	continue;
    	            }
                   	if (strpos(php_sapi_name(), 'cli') !== false) echo $campaign->name . ": Mailing $subscriber->email\n";
//                   	if (strpos(php_sapi_name(), 'cli') !== false) echo __FILE__.":".__LINE__." BLOCKED $subscriber->email\n";

    	            if (! $test) {
    	                $subscriber->pivot->sent_at = $subscriber->freshTimestamp();
            	        $subscriber->pivot->save();
                	    $campaign->count_sent++;
		    			$countSent++;
		    		}

                    if ( $staggerCount !== -1 && $countSent >= $staggerCount && ! $test) {
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
