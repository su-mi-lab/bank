<?php

namespace Bank\Query;

use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Values;

/**
 * Class Insert
 * @package Bank\Query
 */
class Insert
{
    /**
     * @var From
     */
    private $from;


    /**
     * @var Values
     */
    private $values;

    /**
     * Select constructor.
     * @param $table
     */
    function __construct($table)
    {
        $this->from = new From;
        $this->values = new Values;
        $this->from($table);
    }

    /**
     * @param array $values
     * @return Insert
     */
    public function values(array $values): Insert
    {
        $this->values->addValues($values);
        return $this;
    }

    /**
     * @param $table
     * @return Insert
     */
    private function from($table): Insert
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

    /**
     * @return Values
     */
    public function getValues(): Values
    {
        return $this->values;
    }
}