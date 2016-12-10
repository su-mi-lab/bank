<?php

namespace Bank\Platform\Mysql;

use Bank\Platform\ConnectionInterface;

/**
 * Class Connection
 * @package Bank\Platform\Mysql
 */
class Connection implements ConnectionInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    function __construct($dns, $user, $password)
    {
        $this->pdo = new \PDO($dns, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

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
     * @param string $sql
     * @return \PDOStatement
     */
    public function query(string $sql)
    {
        return $this->pdo->query($sql);
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