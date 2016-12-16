<?php

namespace Bank\DataAccess;

/**
 * Class Connection
 * @package Bank\DataAccess
 */
class Connection implements ConnectionInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Connection constructor.
     * @param $dns
     * @param $user
     * @param $password
     */
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

    /**
     * @param string $sql
     * @param array $bindValue
     * @return \PDOStatement
     */
    public function prepare(string $sql, array $bindValue): \PDOStatement
    {
        /** @var \PDOStatement $statement */
        $statement = $this->pdo->prepare($sql);

        foreach ($bindValue as $key => &$item) {
            $statement->bindParam($key, $item);
        }

        return $statement;
    }
}