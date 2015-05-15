<?php namespace Flynsarmy\Mfa\FormWidgets;

use Request;
use Google\Authenticator\GoogleAuthenticator;
use Backend\Classes\FormWidgetBase;
use Endroid\QrCode\QrCode;

class MfaSecret extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name'        => 'MFA Secret generator',
            'description' => 'Displays a secret field complete with QR code and Generate button.'
        ];
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('usersecret');
    }

    public function prepareVars()
    {
        $this->vars['field'] = $this->formField;
        $this->vars['value'] = $this->model->{$this->valueFrom};
        if ( $this->vars['value'] )
        {
            $text = $this->getQRString(
                $this->vars['value'],
                strtolower($this->model->first_name) ?: 'user',
                Request::server('HTTP_HOST', 'october.dev')
            );

            $qrCode = new QrCode();
            $this->vars['qrcode'] = $qrCode
                ->setText( $text )
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                ->getDataUri();
        }
    }

    public function getQRString( $secret, $user, $host )
    {
        return sprintf("otpauth://totp/%s@%s?secret=%s", $user, $host, $secret);
    }

    public function onGenerate()
    {
        $gauth = new GoogleAuthenticator();
        $this->model->{$this->valueFrom} = $gauth->generateSecret();

        $this->prepareVars();
        return [
            '#mfaSecret' => $this->makePartial('usersecret_contents'),
        ];
    }
}