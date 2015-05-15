<?php namespace Responsiv\Campaign\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

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

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Responsiv.Campaign', 'campaign', 'lists');
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