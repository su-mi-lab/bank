<?php

namespace Bank\Query;

use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Where;

/**
 * Class Delete
 * @package Bank\Query
 */
class Delete
{
    /**
     * @var From
     */
    private $from;

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
        $this->from($table);
    }

    /**
     * @param $table
     * @return Delete
     */
    private function from($table): Delete
    {
        $this->from->table($table);
        return $this;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }
}