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
    private $group = [];

    /**
     * @param $group
     * @return Group
     */
    public function addGroup($group): Group
    {
        if (is_string($group)) {
            $this->group[] = $group;
        } else if (is_array($group)) {
            $this->group = array_merge($group, $this->group);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getGroup(): array
    {
        return $this->group;
    }

}