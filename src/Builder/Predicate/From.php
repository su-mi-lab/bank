<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\From as FromQuery;

/**
 * Class From
 * @package Bank\Query\Predicate
 */
class From extends PredicateBuilder
{
    const FROM_CLAUSE = "FROM";

    /**
     * @param FromQuery $from
     * @return string
     */
    public function build($from): string
    {
        $table = $from->getTable();
        return $this->castTablePredicate($table);
    }

}