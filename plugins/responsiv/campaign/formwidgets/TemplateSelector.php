<?php namespace Responsiv\Campaign\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * TemplateSelector Form Widget
 */
class TemplateSelector extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'campaign_templateselector';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('templateselector');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['pages'] = $this->model->listPagesWithCampaignComponent();
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/templateselector.css', 'Responsiv.Campaign');
        $this->addJs('js/templateselector.js', 'Responsiv.Campaign');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
