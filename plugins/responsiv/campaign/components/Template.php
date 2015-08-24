<?php namespace Responsiv\Campaign\Components;

use Event;
use Config;
use Request;
use Response;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Responsiv\Campaign\Models\Message;
use Responsiv\Campaign\Models\Subscriber;
use Exception;

class Template extends ComponentBase
{

    /**
     * @var bool Display a tracking pixel
     */
    protected $trackingMode = false;

    /**
     * @var bool User has opted-out of mailing list
     */
    protected $unsubscribeMode = false;

    /**
     * @var Responsiv\Campaign\Models\Subscriber
     */
    protected $subscriber;

    /**
     * @var Responsiv\Campaign\Models\Message
     */
    protected $campaign;

    public function componentDetails()
    {
        return [
            'name'        => 'Campaign Template',
            'description' => 'Used for displaying web-based versions of campaign messages.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        if (!($code = $this->param('code')) || $code == 'default') {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        // Internal call
        if ($code == LARAVEL_START) return; //LARAVEL_START

        // Verify subscription
        if (get('verify')) {
            return $this->handleVerify($code);
        }

        try {
            $this->validateCampaignCode($code);
        }
        catch (Exception $ex) {
            return 'Invalid request!';
        }

        if (get('unsubscribe')) {
            return $this->handleUnsubscribe();
        }

        $this->markSubscriberAsRead();

        if ($this->trackingMode) {
            return $this->renderTrackingPixel();
        }

        return $this->campaign->renderForSubscriber($this->subscriber);
    }

    protected function markSubscriberAsRead()
    {
        if (!isset($this->subscriber->pivot))
            return;

        $pivot = $this->subscriber->pivot;
        if ($pivot->read_at) return;

        $pivot->read_at = $this->campaign->freshTimestamp();
        $pivot->save();

        $this->campaign->count_read++;
        $this->campaign->save();
    }

    protected function validateCampaignCode($code)
    {
        if (ends_with($code, '.png')) {
            $this->trackingMode = true;
            $code = substr($code, 0, -4);
        }

        $parts = explode('!', base64_decode($code));
        if (count($parts) < 3) {
            throw new ApplicationException('Invalid code');
        }

        list($campaignId, $subscriberId, $hash) = $parts;

        /*
         * Render unique content for the subscriber
         */
        $this->campaign = Message::find((int) $campaignId);
        $this->subscriber = $this->campaign->subscribers()
            ->where('id', (int) $subscriberId)
            ->first();

        if (!$this->subscriber) {
            $this->subscriber = Subscriber::find((int) $subscriberId);
        }

        if (!$this->campaign || !$this->subscriber) {
            throw new ApplicationException('Invalid code');
        }

        /*
         * Verify unique hash
         */
        $verifyValue = $campaignId.'!'.$subscriberId;
        $verifyHash = md5($verifyValue.'!'.$this->subscriber->email);

        if ($hash != $verifyHash) {
            throw new ApplicationException('Invalid hash');
        }
    }

    protected function handleVerify($code)
    {
        $parts = explode('!', base64_decode($code));
        if (count($parts) < 2) {
            throw new ApplicationException('Invalid code');
        }

        list($subscriberId, $hash) = $parts;

        $subscriber = Subscriber::find((int) $subscriberId);

        if (!$subscriber) {
            throw new ApplicationException('Invalid code');
        }

        $verifyCode = $subscriber->getUniqueCode();
        if ($code != $verifyCode) {
            throw new ApplicationException('Invalid hash');
        }

        $subscriber->confirmed_ip_address = Request::ip();
        $subscriber->confirmed_at = $subscriber->freshTimestamp();
        $subscriber->unsubscribed_at = null;
        $subscriber->save();

        // @todo Template + Language
        return '<html><head><title>Verification successful</title></head><body><h1>Verification successful</h1><p>Your email has been successfully added to this list!</p></body></html>';
    }

    protected function handleUnsubscribe()
    {
        if (!isset($this->subscriber->pivot)) {
            return 'You are already unsubscribed from our mailing list!';
        }

        $pivot = $this->subscriber->pivot;
        if ($pivot->stop_at) {
            return 'You are already unsubscribed from our mailing list!';
        }

        $pivot->stop_at = $this->campaign->freshTimestamp();
        $pivot->read_at = $this->campaign->freshTimestamp();
        $pivot->save();

        $this->campaign->count_read++;
        $this->campaign->count_stop++;
        $this->campaign->save();

        $this->subscriber->confirmed_at = null;
        $this->subscriber->unsubscribed_at = $this->subscriber->freshTimestamp();
        $this->subscriber->save();

        // @todo Template + Language
        return '<html><head><title>Unsubscribe successful</title></head><body><h1>Unsubscribe successful</h1><p>Your email has been successfully unsubscribed from this list!</p></body></html>';
    }

    protected function renderTrackingPixel()
    {
        header_remove();
        // Request::header('referer'); // Track referer?

        // Transparent 1x1 image/png
        $contents = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');

        $response = Response::make($contents);
        $response->header('Content-Type', 'image/png');
        return $response;
    }

}
