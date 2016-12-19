<?php

namespace Bank\Builder\Predicate\Parts;

/**
 * Class SimplePredicate
 * @package Bank\Builder\Predicate\Parts
 *
 * @method quote($row, $bracket)
 */
trait SimplePredicate
{

    /**
     * @param $predicate
     * @param string $bracket
     * @return string
     */
    protected function doBuild($predicate, $bracket = "'"): string
    {
        if (!$predicate) {
            return "";
        }

        $query = array_map(function ($row) use ($bracket) {
            return $this->quote($row, $bracket);
        }, $predicate);

        return implode(',', $query);
    }


}