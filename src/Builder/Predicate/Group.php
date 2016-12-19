<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\Predicate\Parts\SimplePredicate;
use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Group as GroupQuery;

/**
 * Class Group
 * @package Bank\Builder\Predicate
 */
class Group extends PredicateBuilder
{
    use SimplePredicate;

    const GROUP_CLAUSE = "GROUP BY";

    /**
     * @param GroupQuery $group
     * @return string
     */
    public function build($group): string
    {
        $group = $group->getGroup();
        return $this->doBuild($group);
    }
}