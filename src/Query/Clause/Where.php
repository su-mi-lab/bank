<?php

namespace Bank\Query\Clause;

/**
 * Class Where
 * @package Bank\Query
 */
class Where
{
    /**
     * @var array
     */
    private $conditions = [];

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function equalTo($col, $val)
    {
        $this->addConditions($col, "=", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function notEqualTo($col, $val)
    {
        $this->addConditions($col, "!=", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function greaterThan($col, $val)
    {
        $this->addConditions($col, ">", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function greaterThanOrEqualTo($col, $val)
    {
        $this->addConditions($col, ">=", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function lessThan($col, $val)
    {
        $this->addConditions($col, "<", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function lessThanOrEqualTo($col, $val)
    {
        $this->addConditions($col, "<=", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $items
     * @return $this
     */
    public function include($col, $items)
    {
        $this->addConditions($col, "IN", $items);
        return $this;
    }

    /**
     * @param $col
     * @return $this
     */
    public function isNull($col)
    {
        $this->addConditions($col, "IS NULL");
        return $this;
    }

    /**
     * @param $col
     * @return $this
     */
    public function isNotNull($col)
    {
        $this->addConditions($col, "IS NOT NULL");
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function like($col, $val)
    {
        $this->addConditions($col, "LIKE", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $val
     * @return $this
     */
    public function notLike($col, $val)
    {
        $this->addConditions($col, "NOT LIKE", $val);
        return $this;
    }

    /**
     * @param $col
     * @param $operator
     * @param $val
     * @param null $table
     */
    private function addConditions($col, $operator, $val = null, $table = null)
    {
        $this->conditions[] = [
            'col' => $col,
            'table' => $table,
            'val' => $val,
            'operator' => $operator
        ];
    }

    /**
     * @return array
     */
    public function getConditions()
    {
        return $this->conditions;
    }

}