<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\Predicate\Parts\SimplePredicate;
use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Order as OrderQuery;

/**
 * Class Order
 * @package Bank\Builder\Predicate
 */
class Order extends PredicateBuilder
{
    use SimplePredicate;

    const ORDER_CLAUSE = "ORDER BY";

    /**
     * @param OrderQuery $order
     * @return string
     */
    public function build($order): string
    {
        $order = $order->getOrder();
        return $this->doBuild($order, '');
    }
}