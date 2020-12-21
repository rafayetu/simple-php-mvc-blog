<?php


namespace app\models\fields;


use app\core\Field;

class IntegerField extends Field
{

    /**
     * TextField constructor.
     * @param string $name
     * @param string|null $verbose
     */
    public function __construct(string $name, string $verbose = null)
    {
        parent::__construct($name, 'integer', $verbose);
        $this->setValue(0);
        return $this;

    }

    public function convert($value)
    {
        $value = trim($value);
        if(ctype_digit($value)){
            return intval($value);
        } elseif (!is_null($this->default) && !$value) {
            return $this->default;
        } else {
            array_push($this->errors, "Input value is not valid integer");
            return null;
        }
    }

}