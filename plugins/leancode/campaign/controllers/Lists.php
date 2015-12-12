<?php namespace Leancode\Campaign\Controllers;

use Flash;
use Request;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use DB;
use Exception;

/**
 * Lists Back-end Controller
 */
class Lists extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['leancode.campaign.manage_subscribers'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Leancode.Campaign', 'campaign', 'lists');
//		$sql =	"insert INTO leancode_campaign_failed_deliveries SET email = 'abc' ";
//	    $results =	DB::statement( DB::raw($sql) );
        
        
    }

    public function index_onProccessList()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            Flash::success('Successfully archived these mailings ??? What is that supposed to mean?');
        }
        else {
            Flash::error('There are no mailings selected to archive ??? What is that supposed to mean?');
        }
        return Redirect::refresh();

    }

    public function preview($recordId = null, $context = null)
    {
        $this->bodyClass = 'slim-container';

        $result = $this->asExtension('FormController')->preview($recordId, $context);

        if ($model = $this->formGetModel()) {
            $this->pageTitle = $model->name;
        }

        return $result;
    }

    public function preview_onDelete($recordId = null)
    {
        return $this->asExtension('FormController')->update_onDelete($recordId);
    }
}