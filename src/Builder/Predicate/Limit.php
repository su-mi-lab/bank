<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Limit as LimitQuery;

/**
 * Class Limit
 * @package Bank\Builder\Predicate
 */
class Limit extends PredicateBuilder
{
    const LIMIT_CLAUSE = "LIMIT";
    const OFFSET_CLAUSE = "OFFSET";

    /**
     * @param LimitQuery $obj
     * @return string
     */
    public function build($obj): string
    {
        $limit = $obj->getLimit();
        $offset = $obj->getOffset();

        $query = '';

        if ($limit === null && $offset === null) {
            return $query;
        }

        if ($limit !== null) {
            $query .= ' ' . self::LIMIT_CLAUSE . ' ' . $limit;
        }

        if ($offset !== null) {
            $query .= ' ' . self::OFFSET_CLAUSE . ' ' . $offset;
        }

        return $query;
    }

}