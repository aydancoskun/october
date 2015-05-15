<?php namespace Flynsarmy\Mfa\FormWidgets;

use Backend\Classes\FormWidgetBase;

class DisableMfa extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name'        => 'Disable MFA',
            'description' => 'Displays a button to disable MFA on a user form.'
        ];
    }

    public function prepareVars()
    {
        $this->vars['field'] = $this->formField;
        $this->vars['mfa_enabled'] = $this->model->mfa_enabled;
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('disablemfa');
    }

    public function onDisable()
    {
        $this->model->mfa_enabled = false;
        $this->model->save();

        $this->prepareVars();
        return [
            '#disableMfa' => $this->makePartial('disablemfa_contents'),
        ];
    }
}