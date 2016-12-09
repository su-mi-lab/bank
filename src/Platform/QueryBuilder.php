<?php

namespace Bank\Platform;

use Bank\Query\Builder\FromBuilder;
use Bank\Query\Builder\GroupBuilder;
use Bank\Query\Builder\OrderBuilder;
use Bank\Query\Builder\WhereBuilder;
use Bank\Query\Builder\SelectBuilder;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Builder
 * @package Bank\Platform
 */
abstract class QueryBuilder implements QueryBuilderInterface
{
    use FromBuilder, WhereBuilder, SelectBuilder, GroupBuilder, OrderBuilder;

    const SELECT_CLAUSE = "SELECT";
    const FROM_CLAUSE = "FROM";
    const WHERE_CLAUSE = "WHERE";
    const GROUP_CLAUSE = "GROUP BY";
    const ORDER_CLAUSE = "ORDER BY";

    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * QueryBuilder constructor.
     * @param $connection
     */
    function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string
    {
        $sql = self::SELECT_CLAUSE;

        if ($column = $this->buildSelect($query->column)) {
            $sql .= $column;
        }

        if ($from = $this->buildFrom($query->from)) {
            $sql .= " " . self::FROM_CLAUSE . " " . $from;
        }
        if ($where = $this->buildWhere($query->where)) {
            $sql .= " " . self::WHERE_CLAUSE . " " . $where;
        }
        if ($group = $this->buildGroup($query->group)) {
            $sql .= " " . self::GROUP_CLAUSE . " " . $group;
        }

        if ($order = $this->buildOrder($query->order)) {
            $sql .= " " . self::ORDER_CLAUSE . " " . $order;
        }

        return $sql;
    }

    /**
     * @param Insert $query
     * @return string
     */
    public function buildInsertQuery(Insert $query): string
    {
    }

    /**
     * @param Update $query
     * @return string
     */
    public function buildUpdateQuery(Update $query): string
    {

    }

    /**
     * @param Delete $query
     * @return string
     */
    public function buildDeleteQuery(Delete $query): string
    {

    }

    /**
     * @param string $string
     * @return string
     */
    protected function quote(string $string):string
    {
        return $this->connection->quote($string);
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

}