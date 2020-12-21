<?php


namespace app\models;


use app\core\Model;
use app\models\fields\EmailField;
use app\models\fields\PasswordField;
use app\models\fields\TextField;

class RegistrationModel extends Model
{
    public TextField $firstname;
    public TextField $lastname;
    public EmailField $email;
    public PasswordField $password;
    public PasswordField $confirmPassword;

    public function __construct()
    {
        $this->firstname = new TextField($name = "firstname", $verbose = "First Name");
        $this->lastname = new TextField($name = "lastname", $verbose = "Last Name");
        $this->email = new EmailField($name = "email", $verbose = "Email");
        $this->password = new PasswordField($name = "password", $verbose = "Password");
        $this->confirmPassword = new PasswordField($name = "confirmPassword", $verbose = "Confirm Password");

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