<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Set as SetQuery;

/**
 * Class Set
 * @package Bank\Query\Predicate
 */
class Set extends PredicateBuilder
{
    const SET_CLAUSE = "SET";

    /**
     * @param SetQuery $set
     * @return string
     */
    public function build($set): string
    {
        $sets = $set->getSets();

        if (!$sets) {
            return '';
        }

        $query = array_map(function ($key) use ($sets) {
            return $this->quote($key, "") . ' = ' . $this->quote($sets[$key], "'");
        }, array_keys($sets));

        return implode(',', $query);
    }

}