<?php

namespace Bank\Query\Predicate\Parts;

/**
 * Class SimplePredicate
 * @package Bank\Query\Predicate\Parts
 */
trait SimplePredicate
{

    /**
     * @var array
     */
    protected $predicate = [];

    /**
     * @param $predicate
     */
    protected function addPredicate($predicate)
    {
        if (is_array($predicate)) {
            $this->predicate = array_merge($predicate, $this->predicate);
        } else if (is_string($predicate)) {
            $this->predicate[] = $predicate;
        }
    }

    /**
     * @return array
     */
    protected function getPredicate(): array
    {
        return $this->predicate;
    }

}