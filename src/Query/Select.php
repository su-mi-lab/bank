<?php

namespace Bank\Query;

use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;

/**
 * Class Select
 * @package Bank\Query
 */
class Select
{

    /**
     * @var From
     */
    public $from;

    /**
     * @var Where
     */
    public $where;

    function __construct()
    {
        $this->where = new Where;
        $this->from = new From;
    }

    /**
     * @param $table
     * @return Select
     */
    public function from($table): Select
    {
        $this->from->table($table);
        return $this;
    }

}