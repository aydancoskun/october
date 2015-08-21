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
    
    public $statelist;
    
    public $countrylist;
    
    public $showCountry;
    
    public $defaultCountry;
    

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
            'showCountry' => [
                'title'       => 'Show Country Field',
                'description' => 'Country field for allowing users to choose a country.',
                'type'        => 'dropdown',
                'default'     => 0,
                'group'       => 'Country',
                'options'     => [0=>'No',1=>'Yes']
            ],
            'country' => [
                'title'       => 'Default Country',
                'description' => 'Default country for editing address. If not showing country field then this will set user country on form save.',
                'type'        => 'dropdown',
                'default'     => '1',
                'group'       => 'Country',
                'options'     => Country::getNameList(),
            ]
        ];
    }
    
    function init()
    {
        if (!$this->user = $this->user())
            return null;
        
        $this->userid = intval( $this->user->id );
        $this->defaultCountry = $this->property('country');
        $this->showCountry = $this->property('showCountry');
    }

    function onRun()
    {
        $this->addCss('/plugins/kurtjensen/profile/assets/css/myinfo.css');
    }


    protected function onUserForm()
    {
        $country = $this->user->country['id']>0?$this->user->country['id']:$this->defaultCountry;
        
        $this->countryInput($country);
        $this->stateInput($country,$this->user->state['id']);
        
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


    protected function onCountryChange()
    {
        return $this->stateInput(post('country'));
    }


    protected function countryInput($country)
    {
        $this->countrylist =
            Country::formSelect(
                'country',                                      // name
                $country,                                       // Cur Val
                array('class' => 'form-control custom-select',
                      'data-request' => 'onCountryChange',
                      'data-request-update' => '\'MyInfo::_state\' : \'#state_div\'')  // Input Field Params
                );
        return $this->countrylist;
    }


    protected function stateInput($country,$state = null)
    {
        $this->statelist =
            State::formSelect(
                'state',                                        // name
                $country,                                       // CountryID
                $state,                                         // Cur Val
                array('class' => 'form-control custom-select')  // Input Field Params
                );
        return $this->statelist;
    }
    

}
