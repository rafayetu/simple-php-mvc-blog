<?php


namespace app\models;


use app\core\Model;
use app\models\fields\EmailModelField;
use app\models\fields\PasswordModelField;
use app\models\fields\TextModelField;

class RegistrationModel extends Model
{
    public TextModelField $firstname;
    public TextModelField $lastname;
    public EmailModelField $email;
    public PasswordModelField $password;
    public PasswordModelField $confirmPassword;

    public function __construct()
    {
        $this->firstname = new TextModelField($name = "firstname", $verbose = "First Name");
        $this->lastname = new TextModelField($name = "lastname", $verbose = "Last Name");
        $this->email = new EmailModelField($name = "email", $verbose = "Email");
        $this->password = new PasswordModelField($name = "password", $verbose = "Password");
        $this->confirmPassword = new PasswordModelField($name = "confirmPassword", $verbose = "Confirm Password");

        $this->firstname->setRequired(true)->setMin(2)->setMax(50);;
        $this->lastname->setRequired(true)->setMin(2)->setMax(50);
        $this->email->setRequired(true);
        $this->password->setRequired(true);
        $this->confirmPassword->setRequired(true);

    }

    public function formValidation()
    {
        $validation = $this->confirmPassword->match($this->password);
        if (!$validation) {
            $this->is_valid = false;
            $this->addErrors($this->confirmPassword);
        }
    }


    public function register()
    {
        return true;
    }
}