<?php

namespace Bank\Query\Predicate;

use Bank\Query\Predicate\Parts\SimplePredicate;

/**
 * Class Order
 * @package Bank\Query\Predicate
 */
class Order
{
    use SimplePredicate;

    /**
     * @param $orderBy
     * @return Order
     */
    public function addOrder($orderBy): Order
    {
        $this->addPredicate($orderBy);

        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->getPredicate();
    }
}