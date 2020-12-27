<?php


namespace app\core;


/**
 * Class FormField
 * @package app\core
 */
class FormField
{
    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute, string $type)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString()
    {
        if ($this->type=="textarea")
            return $this->renderTextarea();
        else
            return $this->renderInput();
    }

    public function renderInput()
    {
        $model = $this->model;
        $attribute = $this->attribute;
        $field = $model->{$attribute};

        return sprintf('<div class="mb-3">
            <label for="%s" class="form-label">%s</label>
            <input type="%s" name="%s" class="form-control %s"
                   id="%s" value="%s">
            <div class="invalid-feedback">
                %s
            </div>
        </div>',
            $attribute,
            $field->verbose,
            $this->type,
            $attribute,
            $model->hasError($attribute)? 'is-invalid' : "",
            $attribute,
            $field->getValue(),
            $model->getFirstError($this->attribute)
        ) ;
    }

    private function renderTextarea()
    {
        $model = $this->model;
        $attribute = $this->attribute;
        $field = $model->{$attribute};

        return sprintf('<div class="mb-3">
            <label for="%s" class="form-label">%s</label>
            <textarea name="%s" class="form-control %s"
                   id="%s" rows="20">%s</textarea>
            <div class="invalid-feedback">
                %s
            </div>
        </div>',
            $attribute,
            $field->verbose,
            $attribute,
            $model->hasError($attribute)? 'is-invalid' : "",
            $attribute,
            $field->getValue(),
            $model->getFirstError($this->attribute)
        ) ;
    }


}