<?php

namespace Bank\Query\Predicate;

/**
 * Class Order
 * @package Bank\Query\Predicate
 */
class Order
{
    /**
     * @var array
     */
    private $orderBy = [];

    /**
     * @param $orderBy
     * @return Order
     */
    public function addOrder($orderBy): Order
    {
        if (is_string($orderBy)) {
            $this->orderBy[] = $orderBy;
        } else if (is_array($orderBy)) {
            $this->orderBy = array_merge($orderBy, $this->orderBy);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->orderBy;
    }
}