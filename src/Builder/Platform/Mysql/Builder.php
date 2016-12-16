<?php

namespace Bank\Builder\Platform\Mysql;

use Bank\Builder\QueryBuilderInterface;
use Bank\Builder\Predicate\From;
use Bank\Builder\Predicate\Values;
use Bank\Builder\Predicate\Column;
use Bank\Builder\Predicate\Group;
use Bank\Builder\Predicate\Join;
use Bank\Builder\Predicate\Limit;
use Bank\Builder\Predicate\Order;
use Bank\Builder\Predicate\Set;
use Bank\Builder\Predicate\Where;
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
        $form = new From($this->connection);
        $column = new Column($this->connection);
        $group = new Group($this->connection);
        $join = new Join($this->connection);
        $limit = new Limit($this->connection);
        $order = new Order($this->connection);
        $where = new Where($this->connection);

        $sql = $form::SELECT_CLAUSE;

        if ($queryString = $column->build($query->getColumn())) {
            $sql .= $queryString;
        }

        if ($queryString = $form->build($query->getFrom())) {
            $sql .= " " . $form::FROM_CLAUSE . " " . $queryString;
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
        $form = new From($this->connection);
        $values = new Values($this->connection);

        $sql = $form::INSERT_CLAUSE;

        if ($queryString = $form->build($query->getFrom())) {
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
        $form = new From($this->connection);
        $join = new Join($this->connection);
        $set = new Set($this->connection);
        $where = new Where($this->connection);

        $sql = $form::UPDATE_CLAUSE;

        if ($queryString = $form->build($query->getFrom())) {
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
        $form = new From($this->connection);
        $where = new Where($this->connection);
        $sql = $form::DELETE_CLAUSE;

        if ($queryString = $form->build($query->getFrom())) {
            $sql .= " " . $queryString;
        }

        if ($queryString = $where->build($query->where)) {
            $sql .= " " . $where::WHERE_CLAUSE . " " . $queryString;
        }

        $this->bindValue = $where->getBindValue();

        return $sql;
    }
}