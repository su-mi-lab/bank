<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Join as JoinQuery;

/**
 * Class Join
 * @package Bank\Builder\Predicate
 */
class Join extends PredicateBuilder
{
    /**
     * @param JoinQuery $join
     * @return string
     */
    public function build($join): string
    {
        $joins = $join->getJoins();

        if (!$joins) {
            return '';
        }

        $query = array_map(function ($row) {
            $table = $row['table'] ?? null;
            $conditions = $row['conditions'] ?? null;
            $join = $row['join'] ?? null;

            return ' ' . $join . ' ' . $this->castTablePredicate($table) . ' ON ' . $this->quote($conditions, '');
        }, $joins);


        return implode('', $query);
    }

}