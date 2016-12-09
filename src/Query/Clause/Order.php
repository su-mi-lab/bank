<?php

namespace Bank\Query\Clause;

/**
 * Class Order
 * @package Bank\Query\Clause
 */
class Order
{
    /**
     * @var array
     */
    private $order = [];

    /**
     * @param $order
     * @return Order
     */
    public function addOrder($order): Order
    {
        if (is_string($order)) {
            $this->order[] = $order;
        } else if (is_array($order)) {
            $this->order = array_merge($order, $this->order);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

}