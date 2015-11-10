<?php namespace KurtJensen\Profile\Components;

use Auth;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use KurtJensen\Profile\Models\Profile as Profile;
use KurtJensen\Profile\Models\Settings;
use Redirect;

class ExtendedInfo extends ComponentBase
{
    public $user;

    public $userid;

    public $extprofile;

    public $epsettings;

    public function componentDetails()
    {
        return [
            'name' => 'Extended Info Display & Form',
            'description' => 'Frontend display and form for user to manage their extended information',
        ];
    }

    public function defineProperties()
    {
        return [
            'redirect' => [
                'title' => 'Form Redirect',
                'description' => 'Page to redirect to after submiting edit form.',
                'type' => 'dropdown',
                'default' => '',
                'group' => 'Links',
            ],
        ];
    }

    public function init()
    {
        $this->user = Auth::getUser();

        if (!$this->user) {
            return null;
        }

        $this->epsettings = $this->loadSettings($this->user);
        $this->userid = intval($this->user->id);
        $this->extprofile = $this->user->profile;
    }

    public function onRun()
    {

    }

    public function getRedirectOptions()
    {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    protected function onProfileForm()
    {
        if (!$this->user) {
            return null;
        }

    }

    protected function onProfileUpdate()
    {

        if (!$this->user) {
            return null;
        }

        $this->extprofile->fill(post());
        $this->extprofile->save();

        return Redirect::intended($this->pageUrl($this->property('redirect')));
    }

    public static function loadSettings($user)
    {
        return [
            'per_text_1' => [
                'label' => Settings::get('per_label_1', 'Place of Birth'),
                'comment' => Settings::get('per_desc_1', 'The town you were born in.'),
                'type' => Settings::get('per_typ_1', 'text'),
                'value' => isset($user->profile->per_text_1) ? $user->profile->per_text_1 : '',
            ],
            'per_text_2' => [
                'label' => Settings::get('per_label_2', 'Favorite Activity'),
                'comment' => Settings::get('per_desc_2', 'The thing you like to do most.'),
                'type' => Settings::get('per_typ_2', 'text'),
                'value' => isset($user->profile->per_text_2) ? $user->profile->per_text_2 : '',
            ],
            'per_text_3' => [
                'label' => Settings::get('per_label_3', 'About Me'),
                'comment' => Settings::get('per_desc_3', 'All about you.'),
                'type' => Settings::get('per_typ_3', 'textarea'),
                'value' => isset($user->profile->per_text_3) ? $user->profile->per_text_3 : '',
            ],
            'per_text_4' => [
                'label' => Settings::get('per_label_4', 'Hobbies'),
                'comment' => Settings::get('per_desc_4', 'How you invest in your free time.'),
                'type' => Settings::get('per_typ_4', 'textarea'),
                'value' => isset($user->profile->per_text_4) ? $user->profile->per_text_4 : '',
            ],
            'pro_text_1' => [
                'label' => Settings::get('pro_label_1', 'Position'),
                'comment' => Settings::get('pro_desc_1', 'Your current job title.'),
                'type' => Settings::get('pro_typ_1', 'text'),
                'value' => isset($user->profile->pro_text_1) ? $user->profile->pro_text_1 : '',
            ],
            'pro_text_2' => [
                'label' => Settings::get('pro_label_2', 'Assignment'),
                'comment' => Settings::get('pro_desc_2', 'Where are you working now.'),
                'type' => Settings::get('pro_typ_2', 'text'),
                'value' => isset($user->profile->pro_text_2) ? $user->profile->pro_text_2 : '',
            ],
            'pro_text_3' => [
                'label' => Settings::get('pro_label_3', 'Accomplishments'),
                'comment' => Settings::get('pro_desc_3', 'The positive things you have done so far.'),
                'type' => Settings::get('pro_typ_3', 'textarea'),
                'value' => isset($user->profile->pro_text_3) ? $user->profile->pro_text_3 : '',
            ],
            'pro_text_4' => [
                'label' => Settings::get('pro_label_4', 'Future Goals'),
                'comment' => Settings::get('pro_desc_4', 'The things you want to accomplish in the next year or more.'),
                'type' => Settings::get('pro_typ_4', 'textarea'),
                'value' => isset($user->profile->pro_text_4) ? $user->profile->pro_text_4 : '',
            ],
        ];
    }

}
