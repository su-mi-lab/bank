<?php

namespace Bank\Query\Predicate;

use Bank\Query\Predicate\Parts\SimplePredicate;

/**
 * Class Group
 * @package Bank\Query\Predicate
 */
class Group
{

    use SimplePredicate;

    /**
     * @param $groupBy
     * @return Group
     */
    public function addGroup($groupBy): Group
    {
        $this->addPredicate($groupBy);
        return $this;
    }

    /**
     * @return array
     */
    public function getGroup(): array
    {
        return $this->getPredicate();
    }
}