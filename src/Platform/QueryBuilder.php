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
    abstract protected function buildFrom(From $from): string;

    /**
     * @param Where $where
     * @return string
     */
    abstract protected function buildWhere(Where $where): string;




}