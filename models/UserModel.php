<?php


namespace app\models;


use app\core\Model;
use app\models\fields\EmailModelField;
use app\models\fields\IntegerModelField;
use app\models\fields\PasswordModelField;
use app\models\fields\TextModelField;

class UserModel extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const DB_TABLE = "users";

    public TextModelField $firstname;
    public TextModelField $lastname;
    public EmailModelField $email;
    public PasswordModelField $password;
    public PasswordModelField $confirmPassword;
    public IntegerModelField $status;

    public function __construct()
    {
        parent::__construct();
        $this->firstname = new TextModelField($name = "firstname", $verbose = "First Name");
        $this->lastname = new TextModelField($name = "lastname", $verbose = "Last Name");
        $this->email = new EmailModelField($name = "email", $verbose = "Email");
        $this->password = new PasswordModelField($name = "password", $verbose = "Password");
        $this->confirmPassword = new PasswordModelField($name = "confirmPassword", $verbose = "Confirm Password");
        $this->status = new IntegerModelField($name = 'status', $verbose = "Status");

        $this->firstname->setRequired(true)->setMin(2)->setMax(50);;
        $this->lastname->setRequired(true)->setMin(2)->setMax(50);
        $this->email->setRequired(true);
        $this->email->setUniqueMethod([$this, "isNewUser"]);
        $this->password->setRequired(true);
        $this->confirmPassword->setRequired(true);
        $this->status->setMax(self::STATUS_DELETED)->setDefault(self::STATUS_ACTIVE);
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
        if ($this->is_valid){
            $fields = [$this->firstname, $this->lastname, $this->email, $this->status, $this->password];
            $this->db->insertIntoTable(self::DB_TABLE, $fields);
            return true;
        } else {
            return false;
        }

    }

    public function isUserExist()
    {
        $record = $this->db->selectObject(self::DB_TABLE, [$this->email], [$this->email]);
        return ($record) ? true : false;
    }

    public function isNewUser(){
        return !$this->isUserExist();
    }
}