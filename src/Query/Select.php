<?php

namespace Bank\Query;

use Bank\Query\Predicate\Column;
use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Group;
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

    /**
     * Select constructor.
     */
    function __construct()
    {
        $this->where = new Where;
        $this->from = new From;
        $this->column = new Column;
        $this->group = new Group;
        $this->order = new Order;
    }

    /**
     * @param $table
     * @return Select
     */
    public function from($table): Select
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
     * @param $group
     * @return Select
     */
    public function orderBy($order): Select
    {
        $this->order->addOrder($order);
        return $this;
    }
}