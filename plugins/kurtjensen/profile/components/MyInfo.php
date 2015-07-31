<?php namespace KurtJensen\Profile\Components;

use Auth;
use Input;
use Redirect;
use Cms\Classes\ComponentBase;
use System\Models\File as File;
use RainLab\User\Models\State as State;
use RainLab\User\Models\Country as Country;

use Config;

class MyInfo extends ComponentBase
{
    /**
     * @var User The user model used for display
     * of a single user.
     */
    public $user;
    
    public $userid;
    
    public $stateslist;

    public function componentDetails()
    {
        return [
            'name'        => 'Basic Info Display & Form',
            'description' => 'Frontend display and form for user to manage their basic information'
        ];
    }

    public function defineProperties()
    {
        return [
            'country' => [
                'title'       => 'Primary Country',
                'description' => 'Country for editing address.',
                'type'        => 'dropdown',
                'default'     => '1',
                'group'       => 'Country',
                'options'     => Country::getNameList(),
            ],
        ];
    }
    
    function init()
    {
        if (!$this->user = $this->user())
            return null;
        
        $this->userid = intval( $this->user->id );
    }

    function onRun()
    {
        $this->addCss('/plugins/kurtjensen/profile/assets/css/myinfo.css');
    }


    protected function onUserForm()
    {
        $this->stateslist = $this->page['stateslist'] = 
            State::formSelect(
                'state',                                        // name
                $this->property('country'),                     // CountryID
                $this->user->state['id'],                     // Cur Val
                array('class' => 'form-control custom-select')  // Input Field Params
                );
                
        if (!$this->userid)
            return null;
    }

    /**
     * Returns the logged in user, if available
     */
    public function user()
    {
        if (!Auth::check())
            return null;

        return Auth::getUser();
    }


    protected function onUserUpdate()
    {
        if (!$user = $this->user())
            return;
        $user->fill(post());
        $user->save();
    }


}
