<?php namespace Leancode\Campaign\Classes;

use Mail;
use Event;
use Leancode\Campaign\Models\Message;
use Leancode\Campaign\Models\Subscriber;
use Leancode\Campaign\Models\MessageStatus;
use Carbon\Carbon;
use ApplicationException;

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
        $hourAgo = $hourAgo->subMinutes(15);

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
            $subscribers = $campaign->subscribers()->whereNull('sent_at');

            if (($staggerCount = $campaign->getStaggerCount()) !== -1) {
                $subscribers->limit($staggerCount);
            }

            $subscribers = $subscribers->get();

            $countSent = 0;
            foreach ($subscribers as $subscriber) {
                if (!$subscriber->confirmed_at || $subscriber->unsubscribed_at) {
                    $campaign->subscribers()->remove($subscriber);
                    continue;
                }

                $this->campaignManager->sendToSubscriber($campaign, $subscriber);

                $subscriber->pivot->sent_at = $subscriber->freshTimestamp();
                $subscriber->pivot->save();
                $campaign->count_sent++;
                $countSent++;
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
            $subscriber->delete();

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