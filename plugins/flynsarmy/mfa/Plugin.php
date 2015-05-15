<?php namespace Flynsarmy\Mfa;

use Event;
use System\Classes\PluginBase;
use BackendAuth;
use Request;
use Lang;
use Redirect;
use Backend;
use Backend\Controllers\Users as BackendUsers;
use Flynsarmy\Mfa\Classes\BackendAuthManager;
use Backend\Models\User as BackendUser;

/**
 * Mfa Plugin Information File
 */
class Plugin extends PluginBase
{
    // Make this plugin run on updates page
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Multi-Factor Authentication',
            'description' => 'Enables multi-factor authentication through Google Authenticator for backend users.',
            'author'      => 'Flynsarmy',
            'icon'        => 'icon-lock'
        ];
    }

    public function boot()
    {
        /*
         * Add MFA column to Administrators list
         */
        BackendUsers::extendListColumns(function(\Backend\Widgets\Lists $list, $model) {
            if ( !$model instanceof BackendUser ) return;

            $list->addColumns([
                'mfa_enabled' => [
                    'label'   => 'MFA?',
                    'type'    => 'switch',
                ],
            ]);
        });

    // Conditionally required fields
    //Event::listen('eloquent.validating: Backend\Models\User', function($model) {
    BackendUser::validating(function($model) {
        if ( !$model->mfa_enabled )
            return;

        // Get the original values from this model straight from the DB
        $original = $model->getOriginal();

        $model->rules['mfa_secret'] = 'required';
        $model->rules['mfa_question_1'] = 'required';
        $model->rules['mfa_question_2'] = 'required';

        // If no MFA is set in the DB yet, we need one set on the form
        if ( $original['mfa_answer_1'] === '' )
            $model->rules['mfa_answer_1'] = 'required';
        if ( $original['mfa_answer_2'] === '' )
            $model->rules['mfa_answer_2'] = 'required';
    });

    BackendUser::extend(function($model) {
        $model->addHashableAttribute('mfa_answer_1');
        $model->addHashableAttribute('mfa_answer_2');
        $model->setHidden(array_merge($model->getHidden(), ['mfa_answer_1', 'mfa_answer_2']));
        $model->attributeNames['mfa_question_1'] = 'MFA security question 1';
        $model->attributeNames['mfa_question_2'] = 'MFA security question 2';
        $model->attributeNames['mfa_answer_1'] = 'MFA security answer 1';
        $model->attributeNames['mfa_answer_2'] = 'MFA security answer 2';

            // Like a password field, mfa_answers shouldn't be changed in the DB
            // when they're left blank
            $model->bindEvent('model.setAttribute', function($key, $value) use ($model) {
                if ( in_array($key, ['mfa_answer_1', 'mfa_answer_2']) && $value === '' )
                    unset($model->attributes[$key]);
            });
        });

        /*
         * Add MFA fields to admin/profile forms
         */
        Event::listen('backend.form.extendFields', function(\Backend\Widgets\Form $widget) {
            if (!$widget->getController() instanceof BackendUsers) return;

            // Profile form
            if ($widget->getContext() == 'myaccount')
            {
                $widget->addFields([
                    'mfa_enabled' => [
                        'label'        => 'Use Multi-Factor Authentication?',
                        'type'         => 'checkbox',
                        'tab'          => 'MFA',
                        'comment'      => "Use Google Authenticator as an extra login check after entering your username and password."
                    ],
                    'mfa_secret' => [
                        'label'        => 'MFA Secret',
                        'type'         => 'Flynsarmy\Mfa\FormWidgets\MfaSecret',
                        'tab'          => 'MFA',
                        'attributes'   => [
                            'disabled' => 'disabled',
                        ],
                        'commentAbove' => "Note: Regenerating this will invalidate your existing Google Authenticator account. You'll need to re-add it.",
                    ],
                    'mfa_question_1' => [
                        'label'        => 'Security Question 1',
                        'type'         => 'text',
                        'tab'          => 'MFA',
                        'span'         => 'left',
                        'comment'      => "This question must be answered to access your account in the event of a lost MFA device.",
                    ],
                    'mfa_answer_1' => [
                        'label'        => 'Security Answer 1',
                        'type'         => 'password',
                        'tab'          => 'MFA',
                        'span'         => 'right',
                        'comment'      => "Leave this field blank to continue using your current answer.",
                    ],
                    'mfa_question_2' => [
                        'label'        => 'Security Question 2',
                        'type'         => 'text',
                        'tab'          => 'MFA',
                        'span'         => 'left',
                        'comment'      => "This question must be answered to access your account in the event of a lost MFA device.",
                    ],
                    'mfa_answer_2' => [
                        'label'        => 'Security Answer 2',
                        'type'         => 'password',
                        'tab'          => 'MFA',
                        'span'         => 'right',
                        'comment'      => "Leave this field blank to continue using your current answer.",
                    ],
                ], 'primary');
            }
            // Other admins
            elseif ( $widget->getContext() == 'update')
            {
                $widget->addFields([
                    'mfa_enabled' => [
                        'label'        => 'Disable Multi-Factor Authentication',
                        'type'         => 'Flynsarmy\Mfa\FormWidgets\DisableMfa',
                        'tab'          => 'MFA',
                        'comment'      => "This administrator has MFA turned on. Click the button above to turn it off for them."
                    ],
                ], 'primary');
            }
        });

        /*
         * Add MFA fields to frontend user form - requires rainlab.user
         */
        Event::listen('backend.form.extendFields', function(\Backend\Widgets\Form $widget) {
            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) return;
            if ($widget->getContext() != 'update') return;

            $widget->addFields([
                'mfa_enabled' => [
                    'label'       => 'Use MFA?',
                    'type'        => 'checkbox',
                    'span'        => 'left',
                    'description' => "Use Google Authenticator as an extra login check after entering your username and password."
                ],
                'mfa_secret' => [
                    'label'       => 'MFA Secret',
                    'type'        => 'text',
                    'span'        => 'right',
                    'description' => "Changing this will invalidate your existing Google Authenticator account. You will need to re-add it."
                ],
            ], 'primary');
        });

        /**
         * @param \Cms\Classes\Controller $controller
         * @param string $url
         * @param \Cms\Classes\Page $page
         */
        //Event::listen('cms.page.beforeDisplay', function(Controller $controller, $url, Page $page) {
        //
        //    if ( Auth::check()  )
        //    dd($url, $page, $controller);
        //
        //});

        /**
         * @param \Backend\Classes\Controller $controller
         * @param string $action
         * @param array $params
         */
        Event::listen('backend.page.beforeDisplay', function(\Backend\Classes\Controller $controller, $action, array $params) {
            // Admin isn't logged in yet or is accessing a public action. Nothing to do here.
            if ( !BackendAuth::check() || in_array($action, $controller->publicActions) )
                return;

            $manager = BackendAuthManager::instance();

            if ( !$manager->check() )
                return Request::ajax()
                    ? Response::make(Lang::get('backend::lang.page.access_denied.label'), 403)
                    : Redirect::guest(Backend::url('flynsarmy/mfa/auth'));

        });
    }
}
