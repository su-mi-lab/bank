<?php

namespace Bank\Query\Predicate;

/**
 * Class Expression
 * @package Bank\Query\Predicate
 */
class Expression
{
    /**
     * @var string
     */
    private $expression = [];

    function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

}