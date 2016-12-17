<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Order as OrderQuery;

/**
 * Class Order
 * @package Bank\Builder\Predicate
 */
class Order extends PredicateBuilder
{
    const ORDER_CLAUSE = "ORDER BY";

    /**
     * @param OrderQuery $order
     * @return string
     */
    public function build($order): string
    {
        $order = $order->getOrder();

        if (!$order) {
            return "";
        }

        $query = array_map(function ($row) {
            return $this->quote($row, "");
        }, $order);

        return implode(',', $query);
    }
}