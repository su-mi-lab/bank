<?php

namespace Bank\Query\Builder;

use Bank\Query\Clause\Group;

/**
 * Class GroupBuilder
 * @package Bank\Query\Builder
 *
 * @method protected
 * \Bank\Platform\QueryBuilder::enclosedInBracket($params),
 * \Bank\Platform\QueryBuilder::quote(string $string):string,
 * \Bank\Platform\QueryBuilder::QueryBuilder::divideFirstParam($table)
 */
trait GroupBuilder
{

    /**
     * @param Group $group
     * @return string
     */
    protected function buildGroup(Group $group): string
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