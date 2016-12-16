<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\From as FromQuery;

/**
 * Class From
 * @package Bank\Builder\Predicate
 */
class From extends PredicateBuilder
{
    const FROM_CLAUSE = "FROM";

    /**
     * @param FromQuery $from
     * @return string
     * @throws \Exception
     */
    public function build($from): string
    {
        $table = $from->getTable();

        if (!$table) {
            throw new \Exception("Parameter is invalid");
        }

        return $this->castTablePredicate($table);
    }

}