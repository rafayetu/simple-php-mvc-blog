<?php


namespace app\models\fields;


use app\core\ModelField;

class PasswordModelField extends ModelField
{
    private ?string $savedPassword = null;
    /**
     * TextModelField constructor.
     * @param string $name
     * @param string|null $verbose
     */
    public function __construct(string $name, string $verbose = null)
    {
        parent::__construct($name, 'string', $verbose)
            ->setMin(8)
            ->setMax(50);
        return $this;

    }

    public function match($confirmPassword)
    {
        $validation = false;
        if ($this->getValue() && $confirmPassword->getValue()){
            $validation = $this->getValue() == $confirmPassword->getValue();
            if (!$validation)
                $this->addErrorMessage("Password didn't match");
        }
        return $validation;

    }
    public function fieldValidate($value)
    {
        return true;
    }

    /**
     * @return string|null
     */
//    public function getValue(): ?string
//    {
//        $this->savedPassword = parent::getValue();
//        return null;
//    }

    /**
     * @param string|null $dbValue
     */
    public function setDbValue(?string $dbValue): void
    {
        parent::setDbValue(password_hash($dbValue, PASSWORD_DEFAULT));
    }



}