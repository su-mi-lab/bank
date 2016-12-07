<?php

namespace Bank\Query\Clause;

/**
 * Class Where
 * @package Bank\Query
 *
 * @property Where $nest
 * @property Where $unNest
 * @property Where $or
 */
class Where
{
    /**
     * @var array
     */
    private $conditions = [];

    /**
     * @var Where|null
     */
    private $parent;

    function __construct($parent = null)
    {
        $this->parent = $parent;
    }

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
    public function include ($col, $items)
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
     * @param null $val
     */
    private function addConditions($col, $operator, $val = null)
    {

        $join = (!empty($this->or)) ? "OR" : "AND";

        $this->conditions[] = [
            'col' => $col,
            'value' => $val,
            'operator' => $operator,
            'join' => $join
        ];
    }

    /**
     * @return Where
     */
    private function getParent()
    {
        return $this->parent;
    }

    /**
     * @return array
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param $name
     * @return Where|null
     */
    public function __get($name)
    {
        $returnObj = null;
        switch ($name) {

            case "nest":
                $returnObj = new Where($this);
                $this->addConditions(null, null, $returnObj);
                break;
            case "unNest":
                $returnObj = $this->getParent();
                break;

            case "or":
                $this->or = true;
                $returnObj = $this;
                break;

            default:
                $returnObj = null;
                break;

        }

        return $returnObj;
    }

}