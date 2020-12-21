<?php


namespace app\core;


abstract class Model
{
    public array $errors = [];
    public bool $is_valid = true;

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if (!$this->validate($key, $value)){
                    $this->is_valid = false;

                }
            }
        }
        $this->formValidation();
    }

    private function validate($key, $value)
    {
        $field = $this->{$key};
        $validation = $field->validate($value);
        if (!$validation) {
            $this->addErrors($field);
        }
        return $validation;
    }

    protected function addErrors($field)
    {
        $this->errors[$field->name] = array(
            "name" => $field->verbose,
            "messages" => $field->errors
        );
    }

    protected function formValidation(){
        return true;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return isset($this->errors[$attribute]["messages"][0]) ? $this->errors[$attribute]["messages"][0] : "";
    }
}