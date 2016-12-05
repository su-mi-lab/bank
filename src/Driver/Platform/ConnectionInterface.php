<?php

namespace Bank\Driver\Platform;

/**
 * Interface ConnectionInterface
 * @package Bank\Driver\Platform
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
     * @param string $statement
     * @return int
     */
    public function exec(string $statement): int;

    /**
     * @return int
     */
    public function lastInsertId(): int;

    /**
     * @param $string
     * @return string
     */
    public function quote($string): string;
}