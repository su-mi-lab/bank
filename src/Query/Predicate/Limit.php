<?php

namespace Bank\Query\Predicate;

/**
 * Class Limit
 * @package Bank\Query\Predicate
 */
class Limit
{
    /**
     * @var int|null
     */
    private $limit = null;

    /**
     * @var int|null
     */
    private $offset = null;

    /**
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $limit
     * @return Limit
     */
    public function setLimit(int $limit): Limit
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $offset
     * @return Limit
     */
    public function setOffset(int $offset): Limit
    {
        $this->offset = $offset;
        return $this;
    }

}