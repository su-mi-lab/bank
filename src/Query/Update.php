<?php

namespace Bank\Query;

use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Join;
use Bank\Query\Predicate\Set;
use Bank\Query\Predicate\Where;

/**
 * Class Update
 * @package Bank\Query
 */
class Update
{
    /**
     * @var From
     */
    private $from;

    /***
     * @var Join
     */
    private $join;

    /**
     * @var Set
     */
    private $set;

    /**
     * @var Where
     */
    public $where;

    /**
     * Select constructor.
     * @param $table
     */
    function __construct($table)
    {
        $this->where = new Where;
        $this->from = new From;
        $this->join = new Join;
        $this->set = new Set;
        $this->from($table);
    }

    /**
     * @param $table
     * @return Update
     */
    private function from($table): Update
    {
        $this->from->table($table);
        return $this;
    }

    /**
     * @param $sets
     * @return Update
     */
    public function set($sets): Update
    {
        $this->set->addSet($sets);
        return $this;
    }

    /**
     * @return Set
     */
    public function getSet(): Set
    {
        return $this->set;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }

    /**
     * @return Join
     */
    public function getJoin(): Join
    {
        return $this->join;
    }
}