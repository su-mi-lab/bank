<?php

namespace Bank\Query\Builder;

use Bank\Query\Predicate\Order;

/**
 * Class OrderBuilder
 * @package Bank\Query\Builder
 *
 * @method protected
 * \Bank\Platform\QueryBuilder::enclosedInBracket($params),
 * \Bank\Platform\QueryBuilder::quote(string $string):string,
 * \Bank\Platform\QueryBuilder::QueryBuilder::divideFirstParam($table)
 */
trait OrderBuilder
{

    /**
     * @param Order $order
     * @return string
     */
    protected function buildOrder(Order $order): string
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