<?php

namespace Bank\Driver\Platform;

/**
 * Class Mysql
 * @package Bank\Driver\Platform
 */
class Mysql implements ConnectionInterface
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Begin transaction
     *
     * @return bool
     */
    public function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit
     *
     * @return bool
     */
    public function commit(): bool
    {
        return $this->pdo->commit();
    }

    /**
     * Rollback
     *
     * @return bool
     */
    public function rollback(): bool
    {
        return $this->pdo->rollBack();
    }

    /**
     * @param string $sql
     * @return int
     */
    public function exec(string $sql): int
    {
        return $this->pdo->exec($sql);
    }

    /**
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param $string
     * @return string
     */
    public function quote($string): string
    {
        return $this->pdo->quote($string);
    }
}