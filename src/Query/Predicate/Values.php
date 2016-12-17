<?php

namespace Bank\Query\Predicate;

/**
 * Class Values
 * @package Bank\Query\Predicate
 */
class Values
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * @param array $values
     * @return Values
     */
    public function addValues(array $values): Values
    {
        $this->values[] = $values;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}