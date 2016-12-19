<?php

namespace Bank\Builder\Platform\Mysql;

use Bank\Builder\QueryBuilderInterface;
use Bank\DataStore\ConnectionInterface;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Builder
 * @package Bank\Builder\Platform\Mysql
 */
class Builder implements QueryBuilderInterface
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * @var array
     */
    private $bindValue = [];

    /**
     * QueryBuilder constructor.
     * @param ConnectionInterface $connection
     */
    function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function getBindValue(): array
    {
        return $this->bindValue;
    }


    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string
    {
        $from = $this->from;
        $column = $this->column;
        $group = $this->group;
        $join = $this->join;
        $limit = $this->limit;
        $order = $this->order;
        $where = $this->where;

        $sql = $from::SELECT_CLAUSE;

        if ($queryString = $column->build($query->getColumn())) {
            $sql .= $queryString;
        }

        if ($queryString = $from->build($query->getFrom())) {
            $sql .= " " . $from::FROM_CLAUSE . " " . $queryString;
        }

        if ($queryString = $join->build($query->getJoin())) {
            $sql .= $queryString;
        }

        if ($queryString = $where->build($query->where)) {
            $sql .= " " . $where::WHERE_CLAUSE . " " . $queryString;
        }

        if ($queryString = $group->build($query->getGroup())) {
            $sql .= " " . $group::GROUP_CLAUSE . " " . $queryString;
        }

        if ($queryString = $order->build($query->getOrder())) {
            $sql .= " " . $order::ORDER_CLAUSE . " " . $queryString;
        }

        if ($queryString = $limit->build($query->getLimit())) {
            $sql .= $queryString;
        }

        $this->bindValue = $where->getBindValue();

        return $sql;
    }

    /**
     * @param Insert $query
     * @return string
     */
    public function buildInsertQuery(Insert $query): string
    {
        $from = $this->from;
        $values = $this->values;

        $sql = $from::INSERT_CLAUSE;

        if ($queryString = $from->build($query->getFrom())) {
            $sql .= " " . $queryString;
        }

        if ($queryString = $values->build($query->getValues())) {
            $sql .= " " . $queryString;
        }

        return $sql;
    }

    /**
     * @param Update $query
     * @return string
     */
    public function buildUpdateQuery(Update $query): string
    {
        $from = $this->from;
        $join = $this->join;
        $set = $this->set;
        $where = $this->where;

        $sql = $from::UPDATE_CLAUSE;

        if ($queryString = $from->build($query->getFrom())) {
            $sql .= " " . $queryString;
        }

        if ($queryString = $join->build($query->getJoin())) {
            $sql .= $queryString;
        }

        if ($queryString = $set->build($query->getSet())) {
            $sql .= " " . $set::SET_CLAUSE . " " . $queryString;
        }

        if ($queryString = $where->build($query->where)) {
            $sql .= " " . $where::WHERE_CLAUSE . " " . $queryString;
        }

        $this->bindValue = $where->getBindValue();

        return $sql;
    }

    /**
     * @param Delete $query
     * @return string
     */
    public function buildDeleteQuery(Delete $query): string
    {
        $from = $this->from;
        $where = $this->where;
        $sql = $from::DELETE_CLAUSE;

        if ($queryString = $from->build($query->getFrom())) {
            $sql .= " " . $queryString;
        }

        if ($queryString = $where->build($query->where)) {
            $sql .= " " . $where::WHERE_CLAUSE . " " . $queryString;
        }

        $this->bindValue = $where->getBindValue();

        return $sql;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $name = '\\Bank\\Builder\\Predicate\\' . ucfirst($name);
        return new $name($this->connection);
    }
}