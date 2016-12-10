<?php

namespace Bank\Query\Builder;

use Bank\Query\Predicate\From;

/**
 * Class FromBuilder
 * @package Bank\Query\Builder
 *
 * @method protected
 * \Bank\Platform\QueryBuilder::enclosedInBracket($params),
 * \Bank\Platform\QueryBuilder::quote(string $string):string,
 * \Bank\Platform\QueryBuilder::QueryBuilder::divideFirstParam($table)
 */
trait FromBuilder
{
    /**
     * @see QueryBuilder::buildFrom
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();

        list($alias, $tableName) = $this->divideFirstParam($table);

        $fromPredicate = $this->quote($tableName, '`');
        if ($alias) {
            $fromPredicate = $this->quote($tableName, '`') . " AS " . $this->quote($alias, '`');
        }

        return $fromPredicate;
    }
}