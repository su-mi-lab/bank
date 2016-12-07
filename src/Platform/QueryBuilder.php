<?php

namespace Bank\Platform;

use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Builder
 * @package Bank\Platform
 */
abstract class QueryBuilder implements BuilderInterface
{

    /**
     * @var ConnectionInterface
     */
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $string
     * @return string
     */
    protected function quote($string):string
    {
        return $this->connection->quote($string);
    }

    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string
    {
        $sql = "SELECT * ";
        $sql .= $this->buildFrom($query->getFrom());
        $sql .= $this->buildWhere($query->getWhere());

        return $sql;
    }

    /**
     * @param Insert $query
     * @return string
     */
    public function buildInsertQuery(Insert $query): string
    {
    }

    /**
     * @param Update $query
     * @return string
     */
    public function buildUpdateQuery(Update $query): string
    {

    }

    /**
     * @param Delete $query
     * @return string
     */
    public function buildDeleteQuery(Delete $query): string
    {

    }

    /**
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();

        if (is_array($table)) {
            $alias = array_keys($table);
            $tableName = array_values($table);
            return "FROM `" . reset($tableName) . "` AS `" . reset($alias) . "`";
        }

        return "FROM `{$table}`";
    }


    /**
     * @param Where $where
     * @param bool $nest
     * @return string
     */
    protected function buildWhere(Where $where, $nest = false): string
    {
        $conditions = $where->getConditions();

        if (!$conditions) {
            return "";
        }

        $query = array_reduce($conditions, function ($query, $condition) {

            $conditionVal = $condition["value"];
            $col = $condition["col"];
            $operator = $condition["operator"];
            $join = $condition["join"];

            #region nest
            if ($conditionVal instanceof Where) {
                return $this->buildNestWhere($query, $conditionVal, $join);
            }
            #endregion

            $value = $this->castWhereValue($conditionVal);

//            if (!empty($condition["table"])) {
//                $col = $condition["table"] . "." . $col;
//            }

            $where = ($value) ? "{$col} {$operator} {$value}" : "{$col} {$operator}";
            if ($query) {
                $where = " {$join} {$where}";
            }

            $query[] = $where;

            return $query;
        }, []);

        $where = implode("", $query);

        if (!$nest) {
            $where = " WHERE {$where} ";
        }

        return $where;
    }

    /**
     * @param $query
     * @param $condition
     * @return array
     */
    protected function buildNestWhere(array $query, Where $where, string $join): array
    {
        $nest = '(' . $this->buildWhere($where, true) . ')';
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
        $value = "";
        if (is_array($conditionVal)) {
            $value = array_map(function ($item) {
                return $this->quote($item);
            }, $conditionVal);

            $value = "(" . implode(" , ", $value) . ")";
        } else if (!empty($conditionVal)) {
            $value = $this->quote($conditionVal);
        }

        return $value;
    }


}