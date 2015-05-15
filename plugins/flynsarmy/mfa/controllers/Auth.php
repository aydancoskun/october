<?php namespace Flynsarmy\Mfa\Controllers;

use BackendMenu;
use Backend;
use Validator;
use Flash;
use Exception;
use BackendAuth;
use October\Rain\Support\ValidationException;
use Backend\Classes\Controller;
use Flynsarmy\Mfa\Classes\BackendAuthManager;

/**
 * Taken from Backend\Controllers\Auth
 */
class Auth extends Controller
{
    protected $publicActions = ['index', 'signin', 'lostDevice'];

    public function __construct()
    {
        parent::__construct();

        /*
         * Define layout and view paths
         */
        $this->layout = 'auth';

        //BackendMenu::setContext('Flynsarmy.Mfa', 'mfa', 'confirm');
    }

    /**
     * Default route, redirects to signin.
     */
    public function index()
    {
        return redirect(Backend::url('flynsarmy/mfa/auth/signin'));
    }

    /**
     * Displays the log in page.
     */
    public function signin()
    {
        $this->bodyClass = 'signin';

        try {
            if (post('postback')) {
                return $this->signin_onSubmit();
            }
            else {
                $this->bodyClass .= ' preload';
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function signin_onSubmit()
    {
        $rules = [
            'code'     => 'required|digits:6',
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        // Authenticate user
        $manager = BackendAuthManager::instance();
        $user = $manager->authenticate([
            'code' => post('code'),
        ], true);

        return $this->successRedirect($user);
    }

    /**
     * Displays the lost device page.
     */
    public function lostDevice()
    {
        $this->bodyClass = 'signin';

        $user = BackendAuth::getUser();

        $this->vars['question_1'] = $user->mfa_question_1;
        $this->vars['question_2'] = $user->mfa_question_2;

        try {
            if (post('postback')) {
                return $this->lostDevice_onSubmit();
            }
            else {
                $this->bodyClass .= ' preload';
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function lostDevice_onSubmit()
    {
        $rules = [
            'answer_1'     => 'required',
            'answer_2'     => 'required',
        ];

        $validation = Validator::make(post(), $rules);
        $validation->setAttributeNames([
            'answer_1' => "Question 1",
            'answer_2' => "Question 2",
        ]);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        // Authenticate user
        $manager = BackendAuthManager::instance();
        $user = $manager->authenticateBackup([
            'mfa_answer_1' => post('answer_1'),
            'mfa_answer_2' => post('answer_2'),
        ], true);

        return $this->successRedirect($user);
    }

    protected function successRedirect($user)
    {
        // User cannot access the dashboard
        if (!$user->hasAccess('backend.access_dashboard')) {
            $true = function(){ return true; };
            if ($first = array_first(BackendMenu::listMainMenuItems(), $true)) {
                return redirect($first->url);
            }
        }

        // Redirect to the intended page after successful sign in
        return redirect(Backend::url('backend'));
    }
}