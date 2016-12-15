<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Values as ValuesQuery;

/**
 * Class Values
 * @package Bank\Builder\Predicate
 */
class Values extends PredicateBuilder
{

    const VALUES_CLAUSE = "VALUES";

    /**
     * @param ValuesQuery $values
     * @return string
     */
    public function build($values): string
    {
        $val = $values->getValues();

        if (!$val) {
            return "";
        }

        $cols = array_map(function ($col) {
            return $this->quote($col, "");
        }, array_keys(reset($val)));

        $items = $this->buildValuesItem($val);

        return $this->enclosedInBracket(implode(',', $cols)) . ' ' . self::VALUES_CLAUSE . ' ' . implode(',', $items) . ';';
    }

    /**
     * @param $values
     * @return array
     */
    protected function buildValuesItem($values): array
    {
        return array_map(function ($items) {
            $items = array_map(function ($col) {
                return $this->quote($col, "'");
            }, array_values($items));

            return $this->enclosedInBracket(implode(',', $items));
        }, $values);
    }
}