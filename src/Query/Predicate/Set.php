<?php

namespace Bank\Query\Predicate;

/**
 * Class Set
 * @package Bank\Query\Predicate
 */
class Set
{
    /**
     * @var array|string
     */
    private $sets = [];

    /**
     * @param array $sets
     * @return Set
     */
    public function addSet(array $sets): Set
    {
        $this->sets = array_merge($this->sets, $sets);
        return $this;
    }

    /**
     * @return array
     */
    public function getSets(): array
    {
        return $this->sets;
    }
}