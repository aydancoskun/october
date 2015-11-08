<?php namespace Leancode\Campaign;

use Event;
use Backend;
use System\Classes\PluginBase;
use Leancode\Campaign\Classes\CampaignWorker;

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
            'name'        => 'Addresso',
            'description' => 'Send mailings to lists',
            'author'      => 'Leancode',
            'icon'        => 'icon-envelope-square'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('addresso.run', 'Leancode\Campaign\Console\CampaignRun');
    }

    public function registerComponents()
    {
        return [
            'Leancode\Campaign\Components\Template' => 'campaignTemplate',
            'Leancode\Campaign\Components\Signup'   => 'campaignSignup',
        ];
    }

    public function registerNavigation()
    {
        return [
            'campaign' => [
                'label'       => 'Addresso',
                'url'         => Backend::url('leancode/campaign/messages'),
                'icon'        => 'icon-envelope',
                'permissions' => ['leancode.campaign.*'],
                'order'       => 500,

                'sideMenu' => [
                    'messages' => [
                        'label'       => 'Mailings',
                        'icon'        => 'icon-newspaper-o',
                        'url'         => Backend::url('leancode/campaign/messages'),
                        'permissions' => ['leancode.campaign.manage_messages'],
                    ],
                    'lists' => [
                        'label'       => 'Mailing Lists',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('leancode/campaign/lists'),
                        'permissions' => ['leancode.campaign.manage_subscribers'],
                    ],
                    'subscribers' => [
                        'label'       => 'Addresses',
                        'icon'        => 'icon-user-plus',
                        'url'         => Backend::url('leancode/campaign/subscribers'),
                        'permissions' => ['leancode.campaign.manage_subscribers'],
                    ],
                ]

            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'leancode.campaign.manage_messages' => ['tab' => 'Mailings', 'label' => 'Manage campaigns'],
            'leancode.campaign.manage_subscribers' => ['tab' => 'Mailings', 'label' => 'Manage subscribers']
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'leancode.campaign::mail.confirm_subscriber' => 'Confirmation email sent to a new public when joining a mailing list.',
        ];
    }

    public function registerSchedule($schedule)
    {
        $schedule->call(function(){
            CampaignWorker::instance()->process();
        })->everyFiveMinutes();
    }

    public function boot()
    {
        if (class_exists('RainLab\User\Plugin')) {
            $this->reverseExtendRainLabUser();
        }
    }

    /*
     * Conditional extension for the RainLab.User plugin
     */
    protected function reverseExtendRainLabUser()
    {
        Event::listen('leancode.campaign.listRecipientGroups', function() {
            return [
                'rainlab-user-all-users' => 'All registered users',
            ];
        });

        Event::listen('leancode.campaign.getRecipientsData', function($type) {
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
