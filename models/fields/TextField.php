<?php


namespace app\models\fields;


use app\core\Field;

class TextField extends Field
{

    /**
     * TextField constructor.
     * @param string $name
     * @param string|null $verbose
     */
    public function __construct(string $name, string $verbose = null)
    {
        parent::__construct($name, 'string', $verbose)
            ->setMin(1)
            ->setMax(100);
        return $this;
    }


}