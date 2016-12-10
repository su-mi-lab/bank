<?php

namespace Bank\Platform\Mysql;

use Bank\Platform\ConnectionInterface;
use Bank\Platform\QueryBuilderInterface;
use Bank\Query\Predicate\Column;
use Bank\Query\Predicate\Expression;
use Bank\Query\Predicate\From;
use Bank\Query\Predicate\Group;
use Bank\Query\Predicate\Join;
use Bank\Query\Predicate\Order;
use Bank\Query\Predicate\Where;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Builder
 * @package Bank\Platform\Mysql
 */
class Builder implements QueryBuilderInterface
{
    const SELECT_CLAUSE = "SELECT";
    const FROM_CLAUSE = "FROM";
    const WHERE_CLAUSE = "WHERE";
    const GROUP_CLAUSE = "GROUP BY";
    const ORDER_CLAUSE = "ORDER BY";

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * QueryBuilder constructor.
     * @param $connection
     */
    function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string
    {
        $sql = self::SELECT_CLAUSE;

        if ($column = $this->buildSelect($query->column)) {
            $sql .= $column;
        }

        if ($from = $this->buildFrom($query->from)) {
            $sql .= " " . self::FROM_CLAUSE . " " . $from;
        }

        if ($join = $this->buildJoin($query->join)) {
            $sql .= $join;
        }

        if ($where = $this->buildWhere($query->where)) {
            $sql .= " " . self::WHERE_CLAUSE . " " . $where;
        }
        if ($group = $this->buildGroup($query->group)) {
            $sql .= " " . self::GROUP_CLAUSE . " " . $group;
        }

        if ($order = $this->buildOrder($query->order)) {
            $sql .= " " . self::ORDER_CLAUSE . " " . $order;
        }

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
     * @param string|Expression $value
     * @param string $bracket
     * @return string
     */
    protected function quote($value, string $bracket = "'"):string
    {
        if ($value instanceof Expression) {
            return $value->getExpression();
        }

        $value = trim($this->connection->quote($value), "'");
        return $bracket . $value . $bracket;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function enclosedInBracket(string $string):string
    {
        return '(' . $string . ')';
    }

    /**
     * @param $param
     * @return array
     */
    protected function divideFirstParam($param): array
    {
        $key = null;
        $value = $param;
        if (is_array($param)) {
            $key = array_keys($param);
            $value = array_values($param);
            $key = reset($key);
            $value = reset($value);
        }

        return [
            $key,
            $value
        ];
    }

    /**
     * @see QueryBuilder::buildFrom
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();
        return $this->castTablePredicate($table);
    }

    /**
     * @param $table
     * @return string
     */
    protected function castTablePredicate($table): string
    {
        list($alias, $tableName) = $this->divideFirstParam($table);

        $tablePredicate = $this->quote($tableName, '`');
        if ($alias) {
            $tablePredicate = $this->quote($tableName, '`') . " AS " . $this->quote($alias, '`');
        }

        return $tablePredicate;

    }

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

    /**
     * @param Order $order
     * @return string
     */
    protected function buildOrder(Order $order): string
    {
        $order = $order->getOrder();

        if (!$order) {
            return "";
        }

        $query = array_map(function ($row) {
            return $this->quote($row, "");
        }, $order);

        return implode(',', $query);
    }

    /**
     * @param Column $column
     * @return string
     */
    protected function buildSelect(Column $column): string
    {
        $columns = $column->getColumns();

        if (!$columns) {
            return " *";
        }

        return " " . $this->castSelectPredicate($columns);
    }

    /**
     * @param array $columns
     * @return string
     */
    protected function castSelectPredicate(array $columns): string
    {
        $select = array_reduce($columns, function ($query, $column) {
            list($table, $cols) = $this->divideFirstParam($column);
            return $this->quoteSelectPredicate($cols, $table, null, $query);
        }, []);

        return implode(',', $select);
    }

    /**
     * @param $column
     * @param string $table
     * @param string $alias
     * @param array $list
     * @return array
     */
    protected function quoteSelectPredicate($column, string $table, $alias, array $list): array
    {
        if (is_array($column)) {
            return array_reduce(array_keys($column), function ($list, $key) use ($table, $column) {
                $col = $column[$key];

                $alias = null;
                if (!is_numeric($key)) {
                    $alias = $key;
                }

                return $this->quoteSelectPredicate($col, $table, $alias, $list);
            }, $list);
        }

        $query = $this->quote($column, '`');
        if ($table) {
            $query = $this->quote($table, '`') . '.' . $query;
        }

        if ($alias) {
            $query = $query . ' AS ' . $this->quote($alias, '`');
        }

        $list[] = $query;
        return $list;
    }

    /**
     * @see QueryBuilder::buildWhere
     * @param Where $where
     * @return string
     */
    protected function buildWhere(Where $where): string
    {
        $conditions = $where->getConditions();

        if (!$conditions) {
            return "";
        }

        $query = array_reduce($conditions, function ($query, $condition) {

            $value = $condition["value"] ?? null;
            $join = $condition["join"] ?? null;

            if ($value instanceof Where) {
                return $this->buildNestWhere($query, $value, $join);
            }

            return $this->buildSimpleWhere($query, $condition);
        }, []);

        $where = implode("", $query);

        return $where;
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
     * @param Where $where
     * @param string $join
     * @return array
     */
    protected function buildNestWhere(array $query, Where $where, string $join): array
    {
        $nest = $this->enclosedInBracket($this->buildWhere($where));
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

            $value = $this->enclosedInBracket(implode(" , ", $value));
        } else if (!empty($conditionVal)) {
            $value = $this->quote($conditionVal);
        }

        return $value;
    }

    /**
     * @param Join $join
     * @return string
     */
    protected function buildJoin(Join $join): string
    {
        $joins = $join->getJoins();

        if (!$joins) {
            return '';
        }

        $query = array_map(function ($row) {
            $table = $row['table'] ?? null;
            $conditions = $row['conditions'] ?? null;
            $join = $row['join'] ?? null;

            return ' ' . $join . ' ' . $this->castTablePredicate($table) . ' ON ' . $this->quote($conditions, '');
        }, $joins);


        return implode('', $query);

    }
}