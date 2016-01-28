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
use Swift_Message;

class CampaignManager
{

    use \October\Rain\Support\Traits\Singleton;

    //
    // State
    //

    protected $ENCRYPTION_KEY = "kljahfjkdsahfjka43q5trgfdsfgzhgjfgnbvdsh!@#$%^&*";

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
    public function launchCampaign($campaign, $test=false)
    {
        $campaign->status = MessageStatus::getActiveStatus();
        $campaign->save();

        $this->bindListSubscribers($campaign,$test);
        $this->bindGroupSubscribers($campaign,$test);

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

    public function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return base64_encode ($encrypted_string);
    }

    public function sendToSubscriber($campaign, $subscriber, $use_massmailer = false)
    {
        $html = $campaign->renderForSubscriber($subscriber);
        $text = Html2Text::convert(str_replace(array("\r", "\n"), "", $html));
        print_r($subscriber);
        print_r($text);
        exit;

        if( $use_massmailer ){
            if(!defined('MAILHOST')) define('MAILHOST','okaytick.com');
    	    $backup_original_mailer = Mail::getSwiftMailer();
		    // Setup our other mailer if needed
            $transport = Swift_SmtpTransport::newInstance('okaytick.com', 25); // 'ssl', 'tls'
		    $transport->setUsername('okaytick');
		    $transport->setPassword('2e76656dcba6562ffeb68d524de1053e90a229a0');
		    // Any other mailer configuration stuff needed...
		    $massmailer = new Swift_Mailer($transport);
		    Mail::setSwiftMailer($massmailer);

//          $to_email = array($subscriber->email => '');
            $to_email = array('leancode@gmail.com' => '', 'ipiresearch@gmail.com' => '');
//          $to_email = array('web-5NgSEw@mail-tester.com' => '');

            $subject = $campaign->subject;
            $subject = str_replace("oktick.com", "okaytick.com", $subject);
            $subject = str_replace("https", "http", $subject);

            $html = str_replace("oktick.com", "okaytick.com", $html);
            $html = str_replace("https", "http", $html);

            $text = str_replace("oktick.com", "okaytick.com", $text);
            $text = str_replace("https", "http", $text);

            // Create the message
            $message = Swift_Message::newInstance()
                ->setReturnPath('bounce@okaytick.com')
                ->setSubject($subject)   // Give the message a subject
                ->setFrom(array('info@okaytick.com' => 'OKTicK Search Ltd'))   // Set the From address with an associative array
                ->setTo($to_email)   // Set the To addresses with an associative array
                ->setBody($html, 'text/html')
                ->addPart($text, 'text/plain')
                ->setId($subscriber->id . ".8938145113." . time() ."@aruba1.generated") // ipaddresss of oktick-beta.com in middle
                ->setReplyTo(array('info@okaytick.com' => 'OKTicK Search Ltd'))   //Specifies the address where replies are sent to
                ->setSender(array('info@okaytick.com' => 'OKTicK Search Ltd'))   //Specifies the address of the person who physically sent the message (higher precedence than From:)
                ->setPriority(3) //normal
            ;

            $numSent = $massmailer->send($message);
    		// Restore our original mailer
	    	Mail::setSwiftMailer($backup_original_mailer);
		    return $numSent;
/*****************************************************************************************
            $setUrl = "http://okaytick.com/api.php";
            $setReturnPath = "bounce@oktick.com";
            $setFrom = array('info@oktick.com' => 'OKTicK Search Ltd');
            $setId = $subscriber->id . ".".$campaign->id."." . time() ."@oktick.generated";
            $setReplyTo = array('info@oktick.com' => 'OKTicK Search Ltd');
            $setSender = array('info@oktick.com' => 'OKTicK Search Ltd');
            $setPriority = 3; // normal

            $query = array(
                "setReturnPath"=>$setReturnPath,
                "setSubject" => $campaign->subject,
                "setFrom" => $setFrom,
                "setTo" => $subscriber->email,
                "setBody" => $html,
                "addPart" => $text,
                "setId" => $setId,
                "setReplyTo" => $setReplyTo,
                "setBody" => $html,
                "setSender" => $setSender,
                "setPriority" => $setPriority,
            );
            $query = json_encode($query);
            $query = $this->encrypt ( $query ,$this->ENCRYPTION_KEY );
            $query = urlencode($query);
            $query = '__PAYLOAD__=' . $query;
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL,$setUrl);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$query);
            $result = curl_exec($ch);
            return $result;
*****************************************************************************************/
        } else {
    	    Mail::rawTo($subscriber, ['html' => $html, 'text' => $text], function($message) use ($campaign, $subscriber) {
                $message->subject($campaign->subject)
                    ->setReturnPath('bounce@oktick.com')
                    ->setFrom(array('info@oktick.com' => 'OKTicK Search Ltd'))   // Set the From address with an associative array
                    ->setReplyTo(array('info@oktick.com' => 'OKTicK Search Ltd'))   //Specifies the address where replies are sent to
                    ->setId($subscriber->id . "." . time() ."@oktick.generated") // ipaddresss of oktick.com in middle
                ;
            });
            return true;
        }
    }

    //
    // Helpers
    //

    /**
     * Binds all subscribers from the campaign lists to the message.
     */
    protected function bindListSubscribers($campaign, $test)
    {
        if (!$campaign->subscriber_lists()->count()) return;
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
    public function bindGroupSubscribers($campaign, $test)
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
