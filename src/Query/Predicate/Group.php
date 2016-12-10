<?php

namespace Bank\Query\Predicate;

/**
 * Class Group
 * @package Bank\Query\Predicate
 */
class Group
{
    /**
     * @var array
     */
    private $groupBy = [];

    /**
     * @param $groupBy
     * @return Group
     */
    public function addGroup($groupBy): Group
    {
        if (is_array($groupBy)) {
            $this->groupBy = array_merge($groupBy, $this->groupBy);
        } else if (is_string($groupBy)) {
            $this->groupBy[] = $groupBy;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getGroup(): array
    {
        return $this->groupBy;
    }

}