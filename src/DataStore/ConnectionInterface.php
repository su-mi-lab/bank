<?php

namespace Bank\DataStore;

/**
 * Interface ConnectionInterface
 * @package Bank\DataStore
 */
interface ConnectionInterface
{
    /**
     * Begin transaction
     *
     * @return bool
     */
    public function beginTransaction(): bool;

    /**
     * Commit
     *
     * @return bool
     */
    public function commit(): bool;

    /**
     * Rollback
     *
     * @return bool
     */
    public function rollback(): bool;

    /**
     * @param string $sql
     * @return int
     */
    public function exec(string $sql): int;

    /**
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql);

    /**
     * @return int
     */
    public function lastInsertId(): int;

    /**
     * @param $string
     * @return string
     */
    public function quote($string): string;


    /**
     * @param string $sql
     * @param array $bindValue
     * @return \PDOStatement
     */
    public function prepare(string $sql, array $bindValue): \PDOStatement;
}