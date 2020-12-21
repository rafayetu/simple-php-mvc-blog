<?php


namespace app\core;


class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute, $type)
    {
        return new FormField($model, $attribute, $type);
    }

}