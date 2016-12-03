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
     * @return ConnectionInterface
     */
    public function beginTransaction(): ConnectionInterface;

    /**
     * Commit
     *
     * @return ConnectionInterface
     */
    public function commit(): ConnectionInterface;

    /**
     * Rollback
     *
     * @return ConnectionInterface
     */
    public function rollback(): ConnectionInterface;

    public function execute($sql);
}