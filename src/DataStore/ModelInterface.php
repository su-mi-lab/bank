<?php

namespace Bank\DataStore;

/**
 * Interface ModelInterface
 * @package Bank\DataStore
 */
interface ModelInterface
{
    /**
     * @return string
     */
    public function getTableName(): string;

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