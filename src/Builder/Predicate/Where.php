<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Where as WhereQuery;

/**
 * Class Where
 * @package Bank\Builder\Predicate
 */
class Where extends PredicateBuilder
{

    const WHERE_CLAUSE = "WHERE";

    /** @var array */
    private $bindValue = [];

    /** @var int */
    private $bindCount = 0;

    /**
     * @param WhereQuery $where
     * @return string
     */
    public function build($where): string
    {
        $conditions = $where->getConditions();

        if (!$conditions) {
            return "";
        }

        $query = array_reduce($conditions, 'self::doBuild', []);
        $where = implode("", $query);

        return $where;
    }

    /**
     * @return array
     */
    public function getBindValue()
    {
        return $this->bindValue;
    }

    /**
     * @param $query
     * @param $row
     * @return array
     */
    protected function doBuild($query, $row): array
    {
        $value = $row["value"] ?? null;
        $join = $row["join"] ?? null;

        if ($value instanceof WhereQuery) {
            return $this->buildNestWhere($query, $value, $join);
        }

        return $this->buildSimpleWhere($query, $row);
    }

    /**
     * @param array $query
     * @param array $condition
     * @return array
     */
    protected function buildSimpleWhere(array $query, array $condition): array
    {
        $conditionVal = $condition["value"] ?? null;
        $col = $condition["col"] ?? null;
        $operator = $condition["operator"] ?? null;
        $join = $condition["join"] ?? null;

        $value = $this->castWhereValue($conditionVal);

        list($table, $column) = $this->divideFirstParam($col);
        if ($table) {
            $col = $table . "." . $column;
        }

        $where = ($value) ? "{$col} {$operator} {$value}" : "{$col} {$operator}";
        if ($query) {
            $where = " {$join} {$where}";
        }

        $query[] = $where;

        return $query;
    }

    /**
     * @param array $query
     * @param WhereQuery $where
     * @param string $join
     * @return array
     */
    protected function buildNestWhere(array $query, WhereQuery $where, string $join): array
    {
        $nest = $this->enclosedInBracket($this->build($where));
        if ($query) {
            $nest = " {$join} {$nest}";
        }
        $query[] = $nest;
        return $query;
    }

    /**
     * @param $conditionVal
     * @return string
     */
    protected function castWhereValue($conditionVal): string
    {
        $name = '';
        if (is_array($conditionVal)) {
            $name = $this->doCastWhereValues($conditionVal);
        } else if (!empty($conditionVal)) {
            $name = $this->doCastWhereValue($conditionVal);
        }

        return $name;
    }

    /**
     * @param $value
     * @return string
     */
    protected function doCastWhereValue($value): string
    {
        $name = $this->getBindName();
        $this->bindValue[$name] = $value;

        return $name;
    }

    /**
     * @param $value
     * @return string
     */
    protected function doCastWhereValues($value): string
    {
        $value = array_map(function ($item) {
            $name = $this->getBindName();
            $this->bindValue[$name] = $item;
            return $name;
        }, $value);

        return $this->enclosedInBracket(implode(" , ", $value));
    }

    /**
     * @return string
     */
    private function getBindName()
    {
        $name = ':b' . $this->bindCount;
        $this->bindCount++;

        return $name;
    }
}