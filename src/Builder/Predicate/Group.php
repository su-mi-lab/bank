<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Group as GroupQuery;

/**
 * Class Group
 * @package Bank\Builder\Predicate
 */
class Group extends PredicateBuilder
{
    const GROUP_CLAUSE = "GROUP BY";

    /**
     * @param GroupQuery $group
     * @return string
     */
    public function build($group): string
    {
        $group = $group->getGroup();

        if (!$group) {
            return "";
        }

        $query = array_map(function ($row) {
            return $this->quote($row);
        }, $group);

        return implode(',', $query);
    }

}