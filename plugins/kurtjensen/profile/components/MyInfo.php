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
     * @var User The ProUser model used for display
     * of a single ProUser.
     */
    public $ProUser;
    
    public $ProUserid;
    
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
        $this->ProUser = Auth::getUser();

        if (!$this->ProUser)
            return null;
        
        $this->ProUserid = intval( $this->ProUser->id );
        $this->page['ProUser'] = $this->ProUser;
        //$this->page['ProUser']['avatarThumb'] = $this->ProUser->getAvatarThumb();
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
                $this->ProUser->state['id'],                     // Cur Val
                array('class' => 'form-control custom-select')  // Input Field Params
                );
                
        if (!$this->ProUserid)
            return null;
    }


    protected function onUserUpdate()
    {
        if (!$this->ProUser)
            return null;
            
        $this->ProUser->save(post());
    }


}
