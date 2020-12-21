<?php


namespace app\models\fields;


use app\core\Field;

class FloatField extends Field
{

    /**
     * TextField constructor.
     * @param string $name
     * @param string|null $verbose
     */
    public function __construct(string $name, string $verbose = null)
    {
        settype($this->min, "float");
        settype($this->max, "float");
        parent::__construct($name, 'float', $verbose);
        $this->setValue(0.00);
        return $this;

    }

    public function convert($value)
    {
        $value = trim($value);
        if (is_numeric($value)) {
            return floatval($value);
        } elseif (!is_null($this->default) && !$value) {
            return $this->default;
        } else {
            array_push($this->errors, "Input value is not valid float");
            return null;
        }
    }


}