<?php


namespace app\models\fields;


use app\core\Field;

class PasswordField extends Field
{
    /**
     * TextField constructor.
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
                array_push($this->errors, "Password didn't match");
        }
        return $validation;

    }


}