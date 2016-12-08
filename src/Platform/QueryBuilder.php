<?php

namespace Bank\Platform;

use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;
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

    const SELECT_CLAUSE = "SELECT";
    const FROM_CLAUSE = "FROM";
    const WHERE_CLAUSE = "WHERE";

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
        $sql .= " *";
        if ($from = $this->buildFrom($query->from)) {
            $sql .= " " . self::FROM_CLAUSE . " " . $from;
        }
        if ($where = $this->buildWhere($query->where)) {
            $sql .= " " . self::WHERE_CLAUSE . " " . $where;
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
     * @param From $from
     * @return string
     */
    abstract protected function buildFrom(From $from): string;

    /**
     * @param Where $where
     * @return string
     */
    abstract protected function buildWhere(Where $where): string;

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