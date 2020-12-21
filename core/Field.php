<?php


namespace app\core;


abstract class Field
{
    public string $name;
    private ?string $value = null;
    protected ?string $default = null;
    private string $type;
    public string $verbose;
    protected ?int $min = null;
    protected ?int $max = null;
    protected bool $required = false;
    public array $errors = [];

    /**
     * Field constructor.
     * @param string $name
     * @param string $type
     * @param string|null $verbose
     */
    public function __construct(string $name, string $type, string $verbose)
    {
        $this->name = $name;
        $this->type = $type;

        settype($this->value, $this->type);
        settype($this->default, $this->type);
        $this->verbose = !is_null($verbose) ? $verbose : $this->name;
        return $this;
    }

    public function validate($value)
    {
        $validation = ($this->required) ? $this->validateRequired($value) : true;
        $value = $this->convert($value);
        $validation &= (!in_array($this->type, ['integer', 'float'])) ? $this->validateMinMax($value) : $this->validateNumberMinMax($value);
        $validation &= $this->fieldValidate($value);
        if ($validation)
            $this->setValue($value);
        return $validation;

    }


    private function validateRequired($value)
    {
        $message = "$this->verbose field is required";
        if (!is_null($this->default))
            $is_value = true;
        elseif ($this->type == 'string' && !$value)
            $is_value = false;
        elseif (in_array($this->type, ['integer', 'float']) && $value === '')
            $is_value = false;
        else
            $is_value = true;

        if (!$is_value) {
            array_push($this->errors, $message);
        }
        return $is_value;
    }

    public function fieldValidate($value)
    {
        return true;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @param string|null $default
     */
    public function setDefault(?string $default)
    {
        $this->value = $default;
        $this->default = $default;
        return $this;
    }

    /**
     * @param int|null $min
     */
    public function setMin(?int $min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param int|null $max
     */
    public function setMax(?int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required)
    {
        $this->required = $required;
        return $this;
    }


    protected function convert($value){
        return trim($value);
    }

    protected function validateMinMax($value){
        $message = "";
        $validation = true;
        if (!is_null($this->min) &&  !is_null($this->max)){
            $validation = strlen($value) >= $this->min && strlen($value) <= $this->max;
            if (!$validation)
                $message = "Field value can be {$this->min} to {$this->max} characters";
        } elseif (!is_null($this->min)) {
            $validation = strlen($value) >= $this->min;
            if (!$validation)
                $message = "Field value should be at least {$this->min} characters";
        } elseif (!is_null($this->max)) {
            $validation = strlen($value) <= $this->max;
            if (!$validation)
                $message = "Field value should be maximum {$this->max} characters";
        }
        if (!$validation) {
            array_push($this->errors, $message);
        }
        return $validation;
    }

    protected function validateNumberMinMax($value){
        $message = "";
        $validation = true;

        if (!is_null($this->min) &&  !is_null($this->max)){
            $validation = $value >= $this->min && $value <= $this->max;
            if (!$validation)
                $message = "Field value can be {$this->min} to {$this->max}";
        } elseif (!is_null($this->min)) {
            $validation = $value >= $this->min;
            if (!$validation)
                $message = "Field value should be at least {$this->min}";
        } elseif (!is_null($this->max)) {
            $validation = $value <= $this->max;
            if (!$validation)
                $message = "Field value should be maximum {$this->max}";
        }
        if (!$validation) {
            array_push($this->errors, $message);
        }
        return $validation;    }

}