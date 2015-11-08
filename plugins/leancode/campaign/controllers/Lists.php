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

            foreach ($checkedIds as $messageId) {
            	if( $messageId = 90){
					// This inserts into the subscriber table those that have unsubscribed from the emails. This would already work automatically but this way the figure is visible in the "dash"
				    $sql =	"INSERT into leancode_campaign_lists_subscribers ".
				    		"(select 90, id from leancode_campaign_subscribers where unsubscribed_at is not NULL) ".
				    		"ON DUPLICATE KEY UPDATE leancode_campaign_lists_subscribers.list_id = leancode_campaign_lists_subscribers.list_id";
					$result = DB::statement( DB::raw($sql) );

					// This deletes those that have unsubscribed from any other list
				    $sql =	"DELETE one FROM leancode_campaign_lists_subscribers one WHERE EXISTS ".
				    		"( SELECT 1 FROM leancode_campaign_subscribers two WHERE one.subscriber_id = two.id AND one.list_id <> 90 AND two.unsubscribed_at is not null )";
					DB::statement( DB::raw($sql) );
				}
            	elseif( $messageId = 100){
					// This inserts into the subscriber table those that have arrived in the mail box as undeliverable. This still needs to be filled in still.
				    $sql =	"INSERT into leancode_campaign_lists_subscribers ".
				    		"(select 100, id from leancode_campaign_subscribers where blacklisted_at is not NULL) ".
				    		"ON DUPLICATE KEY UPDATE leancode_campaign_lists_subscribers.list_id = leancode_campaign_lists_subscribers.list_id";
					$result = DB::statement( DB::raw($sql) );

					// This deletes those that are blacklisted from any other list other than unsubscribed and blacklisted
				    $sql =	"DELETE one FROM leancode_campaign_lists_subscribers one WHERE EXISTS ".
							"( SELECT 1 FROM leancode_campaign_failed_deliveries two WHERE one.subscriber_id = two.id AND one.list_id <> 90 AND one.list_id <> 100)";
					DB::statement( DB::raw($sql) );
            	}
            	elseif( $messageId = 0){
            		// Update start point list
            	}
            	elseif( $messageId = 1){
            		// Update Received First contact list
            	}
            	elseif( $messageId = 2){
            		// Update Responded but didn't claim credit list
            	}
            	elseif( $messageId = 3){
            		// Update Clained Credit but didn't use list
            	}
            	elseif( $messageId = 4){
            		// Update Active using his Credit list
            	}
            	elseif( $messageId = 5){
            		// Update Inactive in using his Credit list
            	}
            	elseif( $messageId = 6){
            		// Edited their product list
            	}
            	elseif( $messageId = 7){
            		// Ran our of credits list
            	}
            	elseif( $messageId = 8){
            		// Bought credits list
            	}
            }

            Flash::success('Successfully archived these mailings ');
        }
        else {
            Flash::error('There are no mailings selected to archive.');
        }
        return Redirect::refresh();

    	try{
//    		This inserts into the subscriber table those that have unsubscribed from the emails. This would already work automatically but this way the figure is visible in the "dash"
		    $sql= "INSERT into leancode_campaign_lists_subscribers (select 90, id from leancode_campaign_subscribers where unsubscribed_at is not NULL) ON DUPLICATE KEY UPDATE leancode_campaign_lists_subscribers.list_id = leancode_campaign_lists_subscribers.list_id";
			$result = DB::statement( DB::raw($sql) );
//    if (Request::input('someVar') != 'someValue')
			throw new Exception('Something went wrong');

//			This deletes those that have unsubscribed from any other list
		    $sql= "DELETE one FROM leancode_campaign_lists_subscribers one WHERE EXISTS ( SELECT 1 FROM leancode_campaign_subscribers two WHERE one.subscriber_id = two.id AND one.list_id <> 90 AND two.unsubscribed_at is not null )";
			DB::statement( DB::raw($sql) );

	    	Flash::success("List processing complete");
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
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