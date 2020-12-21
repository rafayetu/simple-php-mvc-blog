<?php


namespace app\core;


class FormField
{
    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * FormField constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, string $type)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString()
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


}