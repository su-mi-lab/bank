<?php

namespace Bank\Driver\Platform;

/**
 * Class Mysql
 * @package Bank\Driver\Platform
 */
class Mysql implements ConnectionInterface
{

    /**
     * Begin transaction
     *
     * @return ConnectionInterface
     */
    public function beginTransaction(): ConnectionInterface
    {
        // TODO: Implement beginTransaction() method.
    }

    /**
     * Commit
     *
     * @return ConnectionInterface
     */
    public function commit(): ConnectionInterface
    {
        // TODO: Implement commit() method.
    }

    /**
     * Rollback
     *
     * @return ConnectionInterface
     */
    public function rollback(): ConnectionInterface
    {
        // TODO: Implement rollback() method.
    }

    public function execute($sql)
    {
        // TODO: Implement execute() method.
    }
}