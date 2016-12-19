<?php

namespace Bank\ORM;

use Bank\ORM\Traits\ModelTrait;

/**
 * Class Model
 * @package Bank\ORM
 */
abstract class Model implements ModelInterface
{
    use ModelTrait;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        self::injectionSchema();
    }
}