<?php namespace Leancode\Campaign\Components;

use Event;
use Config;
use Request;
use Response;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Leancode\Campaign\Models\Message;
use Leancode\Campaign\Models\Subscriber;
use Exception;
use DB;

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
     * @var Leancode\Campaign\Models\Subscriber
     */
    protected $subscriber;

    /**
     * @var Leancode\Campaign\Models\Message
     */
    protected $campaign;

    public function componentDetails()
    {
        return [
            'name'        => 'Addresso Template',
            'description' => 'Used for displaying web-based versions of campaign messages.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        if ( ! ($code = $this->param('code')) || $code == 'default') {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        // Internal call
        if ($code == LARAVEL_START) return;

        if (get('unsubscribe')) {
            return $this->handleUnsubscribe($code);
        }
        if (get('activate')) {
            return $this->handleActivate($code);
        }


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
//        echo "campaignId=$campaignId<br>";
//        echo "subscriberId=$subscriberId<br>";
//        echo "hash=$hash<br>";
//        exit;
        /*
         * Render unique content for the subscriber
         */
        $this->campaign = Message::find((int) $campaignId);
//        var_dump($this->campaign);
//        echo "<br><br><br><br>";
//        exit;
        $this->subscriber = DB::table('leancode_campaign_subscribers')->where('id', (int) $subscriberId)->first();
//        var_dump($this->subscriber);
//        echo "<br><br><br><br>";
//        exit;

//        $this->subscriber = $this->campaign->subscribers()
//            ->where('id', (int) $subscriberId)
//            ->first();

        if (!$this->subscriber) {
            $this->subscriber = Subscriber::find((int) $subscriberId);
        }

        if (!$this->campaign || !$this->subscriber) {
            throw new ApplicationException('Invalid code');
        }

        var_dump($this->campaign);
        echo "<br><br><br><br>";
        var_dump($this->subscriber);
        echo "<br><br><br><br>";
        exit;

        /*
         * Verify unique hash
         */
        $verifyValue = $campaignId.'!'.$subscriberId;
        $verifyHash = md5( env('APP_KEY') . $verifyValue.'!'.$this->subscriber->email);

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
        return '<html><head><title>Verification successful</title></head><body><h1>Email verification successful</h1><p></p></body></html>';
    }

	protected function handleActivate($code=false) {
    	return redirect('/'.$code);
    }

	protected function handleUnsubscribe($code=false) {
    	return redirect('/unsubscribe/'.$code);
/*
		if ( isset($this->subscriber->pivot) AND ! $this->subscriber->pivot->stop_at) {
        	$pivot = $this->subscriber->pivot;
        	$pivot->stop_at = $this->campaign->freshTimestamp();
            $pivot->read_at = $this->campaign->freshTimestamp();
            $pivot->save();
            $this->campaign->count_read++;
            $this->campaign->count_stop++;
            $this->campaign->save();
            $this->subscriber->confirmed_at = null;
            $this->subscriber->unsubscribed_at = $this->subscriber->freshTimestamp();
            $this->subscriber->save();
            $already="";
		} else {
            $already="done";
        }
    	return redirect('/unsubscribe/'.$code);
*/
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
