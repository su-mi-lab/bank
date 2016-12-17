<?php

namespace Bank\Query\Predicate;

/**
 * Class Join
 * @package Bank\Query\Predicate
 */
class Join
{
    /**
     * @var array
     */
    private $joins = [];

    const INNER_JOIN = 'INNER JOIN';
    const LEFT_JOIN = 'LEFT JOIN';
    const RIGHT_JOIN = 'RIGHT JOIN';

    /**
     * @param $table
     * @param $conditions
     * @param string $join
     */
    public function addJoin($table, $conditions, $join = self::INNER_JOIN)
    {
        $this->joins[] = [
            'table' => $table,
            'conditions' => $conditions,
            'join' => $join
        ];
    }

    /**
     * @return array|string
     */
    public function getJoins()
    {
        return $this->joins;
    }
}