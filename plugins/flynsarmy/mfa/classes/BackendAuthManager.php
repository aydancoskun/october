<?php namespace Flynsarmy\Mfa\Classes;

use Hash;
use BackendAuth;
use Exception;
use Backend\Classes\AuthManager;

/**
 * Back-end authentication manager.
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class BackendAuthManager extends AuthManager
{
    protected static $instance;

    protected $backendAuthSessionKey;

    protected $requireActivation = false;

    // @todo Make this true
    protected $useThrottle = false;

    /**
     * Initialize the singleton free from constructor parameters.
     *
     * We need to save BackendAuth::$sessionKey so we can check the auth session
     * ID in check() against our MFA session ID.
     */
    protected function init()
    {
        $this->backendAuthSessionKey = $this->sessionKey;
        $this->sessionKey = 'admin_mfa';

        return parent::init();
    }

    public function generatePersistCode($user)
    {
        return md5($user->persist_code.$user->last_login->format('U'));
    }

    /**
     * Check to see if the user is logged in and activated, and hasn't been banned or suspended.
     *
     * @return bool
     */
    public function check()
    {
        $user = BackendAuth::getUser();

        // Something funky has happened. Don't initiate an MFA check.
        if ( !$user )
            return true;

        // Not using MFA. Good to move on.
        if ( !$user->mfa_enabled )
            return true;

        // User has never MFA'd before - so we know they'll need to do it
        if ( !$user->mfa_persist_code )
            return false;

        // The user has logged in again since last MFA. They'll need to re-MFA
        if ( $this->generatePersistCode($user) != $user->mfa_persist_code )
            return false;

        // Do standard checks
        if ( !parent::check() )
            return false;

        return true;
    }

    /**
     * Taken from October\Rain\Auth\Manager
     *
     * Attempts to authenticate the given user according to the passed credentials.
     *
     * @param array $credentials The user login details
     * @param bool $remember Store a non-expire cookie for the user
     */
    public function authenticate(array $credentials, $remember = true)
    {
        $user = BackendAuth::getUser();
        if ( !$user )
            throw new Exception('User not found.');

        /*
         * Default to the login name field or fallback to a hard-coded 'login' value
         */
        $loginName = $this->createUserModel()->getLoginName();

        if (empty($credentials['code']))
            throw new Exception('The code attribute is required.');

        /*
         * If throttling is enabled, check they are not locked out first and foremost.
         */
        if ($this->useThrottle) {
            $throttle = $this->findThrottleByLogin($user->$loginName, $this->ipAddress);
            $throttle->check();
        }

        /*
         * Look up the user by authentication credentials.
         */
        try {
            $user = $this->confirmUserByCredentials($user, $credentials);
        }
        catch (Exception $ex) {
            if ($this->useThrottle)
                $throttle->addLoginAttempt();

            throw $ex;
        }

        if ($this->useThrottle)
            $throttle->clearLoginAttempts();

        $user->clearResetPassword();
        $this->login($user, $remember);

        return $this->user;
    }

    /**
     * Taken from October\Rain\Auth\Manager
     *
     * Attempts to authenticate the given user according to the passed credentials.
     *
     * @param array $credentials The user login details
     * @param bool $remember Store a non-expire cookie for the user
     */
    public function authenticateBackup(array $credentials, $remember = true)
    {
        $user = BackendAuth::getUser();
        if ( !$user )
            throw new Exception('User not found.');

        /*
         * Default to the login name field or fallback to a hard-coded 'login' value
         */
        $loginName = $this->createUserModel()->getLoginName();

        if (empty($credentials['mfa_answer_1']) || empty($credentials['mfa_answer_2']))
            throw new Exception('Both answers are required.');

        /*
         * If throttling is enabled, check they are not locked out first and foremost.
         */
        if ($this->useThrottle) {
            $throttle = $this->findThrottleByLogin($user->$loginName, $this->ipAddress);
            $throttle->check();
        }

        /*
         * Look up the user by authentication credentials.
         */
        try {
            $user = $this->confirmUserByBackupCredentials($user, $credentials);
        }
        catch (Exception $ex) {
            if ($this->useThrottle)
                $throttle->addLoginAttempt();

            throw $ex;
        }

        if ($this->useThrottle)
            $throttle->clearLoginAttempts();

        $user->clearResetPassword();
        $this->login($user, $remember);

        return $this->user;
    }

    /**
     * Logs in the given user and sets properties
     * in the session.
     */
    public function login($user, $remember = true)
    {
        $result = parent::login($user, $remember);

        $user->mfa_persist_code = $this->generatePersistCode($user);
        $user->save();

        return $result;
    }

    /**
     * Finds a user by the given credentials.
     */
    public function confirmUserByCredentials($user, array $credentials)
    {
        if ( !$user->mfa_enabled )
            return $user;

        if ( !$user->mfa_secret )
            throw new Exception('User has not generated an MFA code.');

        require_once(__DIR__."/../vendor/sonata-project/google-authenticator/lib/FixedBitNotation.php");
        require_once(__DIR__."/../vendor/sonata-project/google-authenticator/lib/GoogleAuthenticator.php");

        $g = new \Google\Authenticator\GoogleAuthenticator();

        $code = $g->getCode($user->mfa_secret);

        if ( $credentials['code'] != $code )
            throw new Exception('A user was not found with the given credentials.');

        return $user;
    }

    /**
     * Finds a user by the given MFA security question credentials.
     */
    public function confirmUserByBackupCredentials($user, array $credentials)
    {
        if ( !$user->mfa_enabled )
            return $user;

        if ( !$user->mfa_secret )
            throw new Exception('User has not generated an MFA code.');

        foreach ( $credentials as $credential => $value )
        {
            if (!Hash::check($value, $user->{$credential})) {
                // Try to find a nice name for the credential
                $credentialName = $credential;
                if ( isset($user->attributeNames[$credential]) )
                    $credentialName = $user->attributeNames[$credential];

                $message = sprintf('A user was found to match all plain text credentials however hashed credential "%s" did not match.', $credentialName);

                throw new Exception($message);
            }
        }

        return $user;
    }
}
