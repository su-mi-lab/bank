<?php

namespace Bank\DataStore;

use Bank\DataStore\Traits\ModelTrait;

/**
 * Class Model
 * @package Bank\DataStore
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