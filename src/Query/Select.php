<?php

namespace Bank\Query;

use Bank\Query\Predicate\Column;
use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Group;
use Bank\Query\Predicate\Join;
use Bank\Query\Predicate\Order;
use Bank\Query\Predicate\Where;

/**
 * Class Select
 * @package Bank\Query
 */
class Select
{

    /**
     * @var From
     */
    public $from;

    /**
     * @var Column
     */
    public $column;

    /**
     * @var Where
     */
    public $where;

    /**
     * @var Group
     */
    public $group;

    /**
     * @var Order
     */
    public $order;

    /***
     * @var Join
     */
    public $join;

    /**
     * Select constructor.
     * @param $table
     */
    function __construct($table)
    {
        $this->where = new Where;
        $this->from = new From;
        $this->column = new Column;
        $this->group = new Group;
        $this->order = new Order;
        $this->join = new Join;
        $this->from($table);
    }

    /**
     * @param $table
     * @return Select
     */
    private function from($table): Select
    {
        $this->from->table($table);
        return $this;
    }

    /**
     * @param array $column
     * @param $table
     * @return Select
     */
    public function cols(array $column, string $table = null): Select
    {
        $this->column->addColumn($column, $table);
        return $this;
    }

    /**
     * @param $group
     * @return Select
     */
    public function groupBy($group): Select
    {
        $this->group->addGroup($group);
        return $this;
    }

    /**
     * @param $order
     * @return Select
     */
    public function orderBy($order): Select
    {
        $this->order->addOrder($order);
        return $this;
    }

    /**
     * @param $table
     * @param $conditions
     * @return Select
     */
    public function innerJoin($table, $conditions): Select
    {
        $this->join->addJoin($table, $conditions, Join::INNER_JOIN);
        return $this;
    }

    /**
     * @param $table
     * @param $conditions
     * @return Select
     */
    public function leftJoin($table, $conditions): Select
    {
        $this->join->addJoin($table, $conditions, Join::LEFT_JOIN);
        return $this;
    }

    /**
     * @param $table
     * @param $conditions
     * @return Select
     */
    public function rightJoin($table, $conditions): Select
    {
        $this->join->addJoin($table, $conditions, Join::RIGHT_JOIN);
        return $this;
    }

    /**
     * @param $predicate
     * @return Select
     */
    public function reset($predicate): Select
    {
        switch ($predicate) {
            case "where":
                $this->where = new Where;
                break;
            case "column":
                $this->column = new Column;
                break;
            case "group":
                $this->group = new Group;
                break;
            case "order":
                $this->order = new Order;
                break;
            case "join":
                $this->join = new Join;
                break;
            default:
                break;
        }

        return $this;
    }


}