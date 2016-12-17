<?php

namespace Bank\Builder;

/**
 * Interface PredicateBuilderInterface
 * @package Bank\Builder
 */
interface PredicateBuilderInterface
{
    /**
     * @param $query
     * @return string
     */
    public function build($query): string;
}