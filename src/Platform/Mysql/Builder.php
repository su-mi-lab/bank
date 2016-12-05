<?php

namespace Bank\Platform\Mysql;

use Bank\Platform\QueryBuilder;
use Bank\Query\Clause\From;

/**
 * Class Builder
 * @package Bank\Platform
 */
class Builder extends QueryBuilder
{
    /**
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();

        if (is_array($table)) {
            $alias = array_keys($table);
            $table_name = array_values($table);
            return "FROM `" . reset($table_name) . "` AS `" . reset($alias) . "`";
        } else {
            return "FROM `{$table}`";
        }
    }

}