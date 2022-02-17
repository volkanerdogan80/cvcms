<?php


namespace App\Libraries;


class EmailTo
{
    protected $email;
    protected $user;
    protected $data;
    protected $subject;
    protected $template;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->template = config('email')->template;
        $this->data = [];
    }

    public function setData($data = [])
    {
        $this->data = $data;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email->setTo($email);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->email->setSubject($subject);
        return $this;
    }

    public function setTemplate($template = null, $custom = false)
    {
        if ($custom){
            $this->email->setMessage($template);
            return $this;
        }

        if (array_key_exists($this->template[$template], email_template())){
            $message = cve_view(cve_email_template($this->template[$template]), $this->data);
        }else{
            $message = view(cve_email_template($this->template[$template]), $this->data);
        }

        $this->email->setMessage($message);
        return $this;
    }

    public function send()
    {
        return $this->email->send();
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
}