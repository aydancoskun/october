<?php namespace KurtJensen\Profile;

use Backend;
use Event;
use File;
use KurtJensen\Profile\Models\Profile as ProfileModel;
use KurtJensen\Profile\Models\Settings;
use RainLab\User\Controllers\Users as UsersController;
use RainLab\User\Models\User as UserModel;
use ShahiemSeymor\Roles\Models\UserGroup;
use System\Classes\PluginBase;

/**
 * Profile Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.User', 'RainLab.Location', 'RainLab.UserPlus'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Profile',
            'description' => 'Adds humanizing / social information to users',
            'author' => 'Kurt Jensen',
            'icon' => 'icon-child',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Profiles',
                'description' => 'Configure profile preferences.',
                'icon' => 'icon-child',
                'category' => 'Users',
                'class' => 'KurtJensen\Profile\Models\Settings',
                'order' => 100,
                'permissions' => ['kurtjensen.profile.settings'],
            ],
        ];

    }

    public function registerComponents()
    {
        return [
            'KurtJensen\Profile\Components\MyInfo' => 'MyInfo',
            'KurtJensen\Profile\Components\ExtendedInfo' => 'ExtendedInfo',
            'KurtJensen\Profile\Components\Profpic' => 'Profpic',
            'KurtJensen\Profile\Components\UserList' => 'UserList',
            'KurtJensen\Profile\Components\Gallery' => 'Gallery',
            'KurtJensen\Profile\Components\VCard' => 'VCard',
        ];
    }

    public function boot()
    {
        UserModel::extend(function ($model) {
            $model->hasOne['profile'] = ['KurtJensen\Profile\Models\Profile',
                'key' => 'user_id',
                'otherKey' => 'id'];
        });

        UsersController::extendFormFields(function ($form, $model, $context) {

            if (!$model instanceof UserModel) {
                return;
            }

            if (!$model->exists) {
                return;
            }

            if ($form->getContext() != 'update') {
                return;
            }

            if (!ProfileModel::getFromUser($form->model)) {
                return;
            }

            // Flash::success($model->profile->created_at);
            // Ensure that a profile model always exists
            ProfileModel::getFromUser($model);

            $groupsField = $form->getField('groups');

            $form->removeField('groups');

            $form->addTabFields([
                'primary_usergroup' => [
                    'label' => 'Primary User Group',
                    'comment' => 'Set the primary group association for this user.',
                    'tab' => 'rainlab.user::lang.user.account',
                    'type' => 'dropdown',
                    'options' => $this->getPrimaryUsergroupOptions(),
                ],
                'groups' => [
                    'label' => 'Groups/Roles',
                    'tab' => 'rainlab.user::lang.user.account',
                    'type' => 'relation',
                    'emptyOption' => 'There are no user groups available.',
                ],
                'profile[per_text_1]' => [
                    'label' => Settings::get('per_label_1', 'Place of Birth'),
                    'comment' => Settings::get('per_desc_1', 'The town you were born in.'),
                    'tab' => 'Personal',
                    'type' => Settings::get('per_typ_1', 'text'),
                    'options' => ['test' => 'test', 'test2' => 'test2', 'custom' => 'custom'],
                ],
                'profile[per_text_2]' => [
                    'label' => Settings::get('per_label_2', 'Favorite Activity'),
                    'comment' => Settings::get('per_desc_2', 'The thing you like to do most.'),
                    'tab' => 'Personal',
                    'type' => Settings::get('per_typ_2', 'text'),
                ],
                'profile[per_text_3]' => [
                    'label' => Settings::get('per_label_3', 'About Me'),
                    'comment' => Settings::get('per_desc_3', 'All about you.'),
                    'tab' => 'Personal',
                    'type' => Settings::get('per_typ_3', 'textarea'),
                ],
                'profile[per_text_4]' => [
                    'label' => Settings::get('per_label_4', 'Hobbies'),
                    'comment' => Settings::get('per_desc_4', 'How you invest in your free time.'),
                    'tab' => 'Personal',
                    'type' => Settings::get('per_typ_4', 'textarea'),
                ],
                'profile[pro_text_1]' => [
                    'label' => Settings::get('pro_label_1', 'Position'),
                    'comment' => Settings::get('pro_desc_1', 'Your current job title.'),
                    'tab' => 'Professional',
                    'type' => Settings::get('pro_typ_1', 'text'),
                ],
                'profile[pro_text_2]' => [
                    'label' => Settings::get('pro_label_2', 'Assignment'),
                    'comment' => Settings::get('pro_desc_2', 'Where are you working now.'),
                    'tab' => 'Professional',
                    'type' => Settings::get('pro_typ_2', 'text'),
                ],
                'profile[pro_text_3]' => [
                    'label' => Settings::get('pro_label_3', 'Accomplishments'),
                    'comment' => Settings::get('pro_desc_3', 'The positive things you have done so far.'),
                    'tab' => 'Professional',
                    'type' => Settings::get('pro_typ_3', 'textarea'),
                ],
                'profile[pro_text_4]' => [
                    'label' => Settings::get('pro_label_4', 'Future Goals'),
                    'comment' => Settings::get('pro_desc_4', 'The things you want to accomplish in the next year or more.'),
                    'tab' => 'Professional',
                    'type' => Settings::get('pro_typ_4', 'textarea'),
                ],
            ]);
        });

        Event::listen('backend.menu.extendItems', function ($manager) {
            $manager->addSideMenuItems('RainLab.User', 'user', [
                'merge' => [
                    'label' => 'Merge',
                    'icon' => 'icon-exchange',
                    'code' => 'merge',
                    'owner' => 'RainLab.User',
                    'url' => Backend::url('kurtjensen/profile/merge'),
                    'permissions' => ['kurtjensen.profile.merge'],
                ],
            ]);
        });
    }

    public function getPrimaryUsergroupOptions()
    {
        return UserGroup::lists('name', 'id');
    }

    public function registerPermissions()
    {
        return [
            'kurtjensen.profile.merge' => ['tab' => 'rainlab.user::lang.plugin.tab', 'label' => 'Profile Merging'],
            'kurtjensen.profile.settings' => ['tab' => 'rainlab.user::lang.plugin.tab', 'label' => 'Profile Settings'],
        ];
    }

}
