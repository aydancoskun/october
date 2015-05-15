<?php namespace KurtJensen\Profile\Controllers;

use Request;
use BackendMenu;
use Backend\Classes\Controller;
use RainLab\User\Models\User as user;

/**
 * Merge Back-end Controller
 */
class Merge extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['rainlab.users.access_users'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('RainLab.User', 'user', 'merge');
    }

    public function onGetSourceUser( $uid = false )
    {
        if (post('uid')) $uid = post('uid');
        
        return [
        '#mergeContainer' => $this->makePartial('merge_table', [
            'userFrom' => user::find( $uid )
        ])
    ];
    }
    

    public function getUserOptions()
    {
                $users = user::orderBy('surname')->
                            orderBy('name')->
                            get();
                foreach($users as $user)
                {
                    $people[$user['id']] = $user['surname'].', '.$user['name'].'&lt;'.$user['email'].'&gt;';
                }
        return $people;
    }
    

    public function onChangeSourceEmail()
    {
        $userFrom = user::where('email', post('sourceOldEmail'))->find( post('sourceId') );
        if(!$userFrom) return null;
        
        $userFrom->email = post('sourceEmail');
        $userFrom->save();
        
        return $this->onGetSourceUser( post('sourceId') ) + ['#layout-flash-messages' => '<p data-control="flash-message" class="flash-message success" data-interval="5">The email for '.$userFrom->name.' '.$userFrom->surname.' has been changed.</p>'];
    }
    

    public function onDeleteSource()
    {
        $userFrom = user::where('email', post('sourceOldEmail'))->find( post('sourceId') );
        if(!$userFrom) return null;
        $surname = $userFrom->surname;
        $name = $userFrom->name;
        $userFrom->delete();

        return ['#layout-flash-messages' => '<p data-control="flash-message" class="flash-message success" data-interval="5">User '.$name.' '.$surname.' has been deleted from the system.</p>'];
    }
    

    public function onTransferPassword($recordId = null) 
    {        
        if ((!$recordId) OR (!post('sourceId'))) return null;
        
        $userTo   = user::find( $recordId );
        $userFrom = user::find( post('sourceId') );
        
        if ((!$userTo) OR (!$userFrom)) return null;
        
        $userTo->setPasswordAttribute(  $userFrom->password );
        
        $userTo->forceSave();
        return ['#layout-flash-messages' => '<p data-control="flash-message" class="flash-message success" data-interval="5">The password for '.$userTo->name.' '.$userTo->surname.' has been updated to match the source user password.</p>'];
    }
}
