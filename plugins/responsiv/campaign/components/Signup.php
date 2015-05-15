<?php namespace Responsiv\Campaign\Components;

use Mail;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Responsiv\Campaign\Models\Subscriber;
use Responsiv\Campaign\Models\SubscriberList;

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
                'default'     => 1,
                'showExternalParam' => false
            ],
            'templatePage' => [
                'title'       => 'Confirmation page',
                'description' => 'If confirmation is required, select any mail template to used for generating the confirmation link.',
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
        $data = post();

        $rules = [
            'email' => 'required|email|min:2|max:64',
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails())
            throw new ValidationException($validation);

        /*
         * Create and add the subscriber
         */
        $listCode = $this->property('list');
        $requireConfirmation = $this->property('confirm', false);

        $subscriber = Subscriber::signup([
            'email' => post('email'),
            'first_name' => post('first_name'),
            'last_name' => post('last_name'),
        ], $listCode, !$requireConfirmation);

        $this->page['requireConfirmation'] = $requireConfirmation;

        /*
         * Send confirmation email
         */
        if ($requireConfirmation) {
            $params = [
                'confirmUrl' => $this->getConfirmationUrl($subscriber)
            ];

            Mail::sendTo($subscriber->email, 'responsiv.campaign::mail.confirm_subscriber', $params);
        }
    }

    protected function getConfirmationUrl($subscriber)
    {
        $pageName = $this->property('templatePage');
        return Page::url($pageName, ['code' => $subscriber->getUniqueCode()]) . '?verify=1';
    }

}