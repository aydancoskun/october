<?php namespace Responsiv\Campaign;

use Event;
use Backend;
use System\Classes\PluginBase;
use Responsiv\Campaign\Classes\CampaignWorker;

/**
 * Campaign Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Campaign Manager',
            'description' => 'Send messages to subscription lists',
            'author'      => 'Responsiv',
            'icon'        => 'icon-envelope-square'
        ];
    }

    public function boot()
    {
        if (class_exists('RainLab\User\Plugin')) {
            $this->reverseExtendRainLabUser();
        }
    }

    public function register()
    {
        $this->registerConsoleCommand('campaign.run', 'Responsiv\Campaign\Console\CampaignRun');
    }

    public function registerComponents()
    {
        return [
            'Responsiv\Campaign\Components\Template' => 'campaignTemplate',
            'Responsiv\Campaign\Components\Signup'   => 'campaignSignup',
        ];
    }

    public function registerNavigation()
    {
        return [
            'campaign' => [
                'label'       => 'Mailing List',
                'url'         => Backend::url('responsiv/campaign/messages'),
                'icon'        => 'icon-envelope',
                'permissions' => ['responsiv.campaign.*'],
                'order'       => 500,

                'sideMenu' => [
                    'messages' => [
                        'label'       => 'Campaigns',
                        'icon'        => 'icon-newspaper-o',
                        'url'         => Backend::url('responsiv/campaign/messages'),
                        'permissions' => ['responsiv.campaign.manage_messages'],
                    ],
                    'lists' => [
                        'label'       => 'Lists',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('responsiv/campaign/lists'),
                        'permissions' => ['responsiv.campaign.manage_subscribers'],
                    ],
                    'subscribers' => [
                        'label'       => 'Subscribers',
                        'icon'        => 'icon-user-plus',
                        'url'         => Backend::url('responsiv/campaign/subscribers'),
                        'permissions' => ['responsiv.campaign.manage_subscribers'],
                    ],
                ]

            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'responsiv.campaign.manage_messages' => ['tab' => 'Mailing List', 'label' => 'Manage campaigns'],
            'responsiv.campaign.manage_subscribers' => ['tab' => 'Mailing List', 'label' => 'Manage subscribers']
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'responsiv.campaign::mail.confirm_subscriber' => 'Confirmation email sent to a new subscriber when joining a mailing list.',
        ];
    }

    public function registerSchedule($schedule)
    {
        $schedule->call(function(){
            CampaignWorker::instance()->process();
        })->everyFiveMinutes();
    }

    /*
     * Conditional extension for the RainLab.User plugin
     */
    protected function reverseExtendRainLabUser()
    {
        Event::listen('responsiv.campaign.listRecipientGroups', function() {
            return [
                'rainlab-user-all-users' => 'All registered users',
            ];
        });

        Event::listen('responsiv.campaign.getRecipientsData', function($type) {
            if ($type != 'rainlab-user-all-users') return;

            $result = [];
            $allUsers = \RainLab\User\Models\User::select('name', 'surname', 'email')->get();
            foreach ($allUsers as $user) {
                $result[$user->email] = ['first_name' => $user->name, 'last_name' => $user->surname];
            }

            return $result;
        });
    }

}
