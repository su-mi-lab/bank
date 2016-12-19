<?php

namespace Bank\ORM;

/**
 * Interface ModelInterface
 * @package Bank\ORM
 */
interface ModelInterface
{
    /**
     * @return string
     */
    public static function getTableName(): string;

    /**
     * @return string
     */
    public function getPrimaryCol(): string;

    /**
     * @return int
     */
    public function getPrimaryKey(): int;

    /**
     * @return array
     */
    public function getTableRowData(): array;
}