<?php namespace Responsiv\Campaign\Components;

use Mail;
use Request;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Responsiv\Campaign\Models\Subscriber;
use Responsiv\Campaign\Models\SubscriberList;
use Exception;

class Signup extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Signup Form',
            'description' => 'Sign up a new person to a campaign mailing list.'
        ];
    }

    public function defineProperties()
    {
        return [
            'list' => [
                'title'       => 'Add to list',
                'description' => 'The campaign list code to subscribe the person to.',
                'type'        => 'dropdown'
            ],
            'confirm' => [
                'title'       => 'Require confirmation',
                'description' => 'Subscribers must confirm their email address.',
                'type'        => 'checkbox',
                'default'     => 0,
                'showExternalParam' => false
            ],
            'templatePage' => [
                'title'       => 'Confirmation page',
                'description' => 'If confirmation is required, select any mail template used for generating a confirmation URL link.',
                'type'        => 'dropdown',
                'showExternalParam' => false
            ],
        ];
    }

    public function getTemplatePageOptions()
    {
        return Page::withComponent('campaignTemplate')->sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getListOptions()
    {
        return SubscriberList::orderBy('name')->lists('name', 'code');
    }

    public function onSignup()
    {
        /*
         * Validate input
         */
        $data = [
            'email' => post('email'),
            'first_name' => post('first_name'),
            'last_name' => post('last_name')
        ];

        $rules = [
            'email' => 'required|email|min:2|max:64',
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }


        try {

            /*
             * Create and add the subscriber
             */
            $isThrottled = $this->checkThrottle();

            if (!$isThrottled) {
                $subscriber = $this->listSubscribe($data);
                $requireConfirmation = !$subscriber->confirmed_at;
            }
            else {
                $requireConfirmation = null;
            }

            $this->page['error'] = null;
            $this->page['isThrottled'] = $isThrottled;
            $this->page['requireConfirmation'] = $requireConfirmation;

        }
        catch (Exception $ex) {
            $this->page['error'] = $ex->getMessage();
        }
    }

    protected function listSubscribe(array $data)
    {
        $listCode = $this->property('list');
        $requireConfirmation = $this->property('confirm', false);

        $subscriber = Subscriber::signup([
            'email' => array_get($data, 'email'),
            'first_name' => array_get($data, 'first_name'),
            'last_name' => array_get($data, 'last_name'),
            'created_ip_address' => Request::ip()
        ], $listCode, !$requireConfirmation);

        /*
         * Send confirmation email
         */
        if (!$subscriber->confirmed_at) {
            $params = [
                'confirmUrl' => $this->getConfirmationUrl($subscriber)
            ];

            Mail::sendTo($subscriber->email, 'responsiv.campaign::mail.confirm_subscriber', $params);
        }

        return $subscriber;
    }

    protected function getConfirmationUrl($subscriber)
    {
        $pageName = $this->property('templatePage');
        return Page::url($pageName, ['code' => $subscriber->getUniqueCode()]) . '?verify=1';
    }

    /**
     * Returns true if user is throttled.
     */
    protected function checkThrottle()
    {
        return Subscriber::checkThrottle(Request::ip());
    }
}