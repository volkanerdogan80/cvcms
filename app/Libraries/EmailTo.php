<?php


namespace App\Libraries;


class EmailTo
{
    protected $email;
    protected $user;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function setUser($user)
    {
        if (filter_var($user, FILTER_VALIDATE_EMAIL)){
            $this->email->setTo($user);
            return $this;
        }else{
            $this->user = $user;
            $this->email->setTo($this->user->email);
            return $this;
        }
    }

    public function accountVerify()
    {
        $this->email->setSubject('Hesabınızı Doğrulayın');
        $this->email->setMessage(view(PANEL_FOLDER . '/email/account-verify', ['user' => $this->user]));
        return $this;
    }

    public function accountVerifySuccess()
    {
        $this->email->setSubject('Hesabınız Doğrulandı');
        $this->email->setMessage(view(PANEL_FOLDER . '/email/account-verify-success', ['user' => $this->user]));
        return $this;
    }

    public function forgotPassword()
    {
        $this->email->setSubject('Şifre Sıfırlama Talebi');
        $this->email->setMessage(view(PANEL_FOLDER . '/email/forgot-password', ['user' => $this->user]));
        return $this;
    }

    public function passwordChangeSuccess()
    {
        $this->email->setSubject('Şifre Sıfırlama Talebi');
        $this->email->setMessage(view(PANEL_FOLDER . '/email/password-change-success', ['user' => $this->user]));
        return $this;
    }

    public function newsletterSubscribeSuccess()
    {
        $this->email->setSubject('Eposta Aboneliği Başarılı');
        $this->email->setMessage(view(PANEL_FOLDER . '/email/newsletter-subscribe-success', ['user' => $this->user]));
        return $this;
    }


    public function customMessage($subject, $message)
    {
        $this->email->setSubject($subject);
        $this->email->setMessage($message);
        return $this;
    }

    public function send()
    {
        return $this->email->send();
    }


}