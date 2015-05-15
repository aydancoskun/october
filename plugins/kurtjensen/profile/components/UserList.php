<?php namespace KurtJensen\Profile\Components;

use DB;
use Lang;
use App;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\User\Models\User as user;
use ShahiemSeymor\Roles\Models\UserGroup;
use October\Rain\Auth\Models\User as UserBase;

//use KurtJensen\Cellphone\Models\Cellphone;
use KurtJensen\Cellphone\Models\Provider as CellProvider;

use KurtJensen\Profile\Models\Settings;
use KurtJensen\Profile\Components\ExtendedInfo;
// Testing
use Form;

class UserList extends ComponentBase
{
    public $people = [];
    
    public $userGroups = [];
    
    
    public $testform = '';
    
    public $sort = '';
    
    public $UserSelected = 0;


    public function componentDetails()
    {
        return [
            'name'        => 'UserList Component',
            'description' => 'Shows a list of users and their information when selected'
        ];
    }

    public function defineProperties()
    {
        return [
            'SLSlug' => [
                'title'       => 'Selected User Slug',
                'description' => '( Optional ) Slug for displaying a single users information.  If used page will only display user with an id that matches the slug.',
                'type'        => 'dropdown',
                'default'     => '{{ :slug }}'
            ],
        ];
    }

    public function init()
    {
        $this->getPrimaryUsergroups();
    }

    public function onRun()
    {
        $this->addCss('/plugins/kurtjensen/profile/assets/css/myinfo.css');
        
        $this->UserSelected = intval( $this->property('SLSlug'));
        if ( $this->UserSelected ) 
            return $this->UserDisplayOne();
        $this->page['sort'] = $this->sort = post('sort');        
        
        $this->loadUserInfo();
        $this->page['people'] = $this->people;
        
        
    }
    
    public function loadUserInfo()
    {
        $sort3 = null;
        /*
         * Sorting
         */
        switch ($this->sort)
        {
            case 'group': 
                $sort1 = 'primary_usergroup';
                $sort2 = 'surname';
                $sort3 = 'name';
            break;
            case 'given': 
                $sort1 = 'name';
                $sort2 = 'surname';
            break;
            default :
                $sort1 = 'surname';
                $sort2 = 'name';
        }
        
        
            
        $people = user::orderBy($sort1)->
                            orderBy($sort2);
                            
        if ($sort3) $people->orderBy($sort3);
        
        $this->people = $people->get();
        
        return $this->people;
    }
    
    public function UserDisplayOne()
    {
        $this->page['person'] = $this->person = user::find($this->UserSelected);

        $this->page['avatarThumb'] = $this->person->getAvatarThumb(200);
        
        $this->page['epsettings'] = ExtendedInfo::loadSettings($this->person);
        //$this->page['hint'] = count($this->page['epsettings']);
         
    }
    
    public function onUserDisplay()
    {
        $this->page['person'] = $this->person = user::find(post('id'));

        $this->page['avatarThumb'] = $this->person->getAvatarThumb(200);
        
        $this->page['epsettings'] = ExtendedInfo::loadSettings($this->person);
        //$this->page['hint'] = count($this->page['epsettings']);
         
    }
    

    public function getPrimaryUsergroups()
    {
        $this->userGroups = UserGroup::lists('name','id');
            
        $this->page['userGroups'] = $this->userGroups;
    }

}
