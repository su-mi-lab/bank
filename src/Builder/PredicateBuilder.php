<?php

namespace Bank\Builder;

use Bank\DataAccess\ConnectionInterface;
use Bank\Query\Predicate\Expression;

/**
 * Class AbstractBuilder
 * @package Builder
 */
abstract class PredicateBuilder implements PredicateBuilderInterface
{
    const SELECT_CLAUSE = "SELECT";
    const UPDATE_CLAUSE = "UPDATE";
    const DELETE_CLAUSE = "DELETE FROM";
    const INSERT_CLAUSE = "INSERT INTO";

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * QueryBuilder constructor.
     * @param $connection
     */
    function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string|Expression $value
     * @param string $bracket
     * @return string
     */
    protected function quote($value, string $bracket = "'"):string
    {
        if ($value instanceof Expression) {
            return $value->getExpression();
        }

        $value = trim($this->connection->quote($value), "'");
        return $bracket . $value . $bracket;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function enclosedInBracket(string $string):string
    {
        return '(' . $string . ')';
    }

    /**
     * @param $param
     * @return array
     */
    protected function divideFirstParam($param): array
    {
        $key = null;
        $value = $param;
        if (is_array($param)) {
            $key = array_keys($param);
            $value = array_values($param);
            $key = reset($key);
            $value = reset($value);
        }

        return [
            $key,
            $value
        ];
    }

    /**
     * @param $table
     * @return string
     */
    protected function castTablePredicate($table): string
    {
        list($alias, $tableName) = $this->divideFirstParam($table);

        $tablePredicate = $this->quote($tableName, '`');
        if ($alias) {
            $tablePredicate = $this->quote($tableName, '`') . " AS " . $this->quote($alias, '`');
        }

        return $tablePredicate;

    }
}