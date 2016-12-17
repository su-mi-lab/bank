<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Set as SetQuery;

/**
 * Class Set
 * @package Bank\Builder\Predicate
 */
class Set extends PredicateBuilder
{
    const SET_CLAUSE = "SET";

    /**
     * @param SetQuery $set
     * @return string
     * @throws \Exception
     */
    public function build($set): string
    {
        $sets = $set->getSets();

        if (!$sets) {
            throw new \Exception("Parameter is invalid");
        }

        $query = array_map(function ($key) use ($sets) {
            return $this->quote($key, "") . ' = ' . $this->quote($sets[$key], "'");
        }, array_keys($sets));

        return implode(',', $query);
    }
}