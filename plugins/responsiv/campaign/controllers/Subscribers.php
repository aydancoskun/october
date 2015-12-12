<?php namespace Responsiv\Campaign\Controllers;

use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Responsiv\Campaign\Models\Subscriber;

/**
 * Subscribers Back-end Controller
 */
class Subscribers extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['responsiv.campaign.manage_subscribers'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Responsiv.Campaign', 'campaign', 'subscribers');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $recordId) {
                if (!$record = Subscriber::find($recordId)) continue;
                $record->delete();
            }

            Flash::success(Lang::get('backend::lang.list.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('backend::lang.list.delete_selected_empty'));
        }

        return $this->listRefresh();
    }

    public function listInjectRowClass($record)
    {
        if ($record->unsubscribed_at) {
            return 'negative';
        }

        if ($record->confirmed_at) {
            return 'positive';
        }
    }
}