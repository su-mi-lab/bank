<?php

namespace Bank\Query\Clause;

/**
 * Class Where
 * @package Bank\Query
 */
class Where
{

    public function equalTo($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" = '値'
    }

    public function notEqualTo($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" != '値'
    }

    public function greaterThan($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" > '値'
    }

    public function greaterThanOrEqualTo($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" >= '値'
    }

    public function lessThan($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" < '値'
    }

    public function lessThanOrEqualTo($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" <= '値'
    }

    public function in($col, $items)
    {
//SELECT "user".* FROM "user" WHERE "col" IN ('値1', '値2')
    }

    public function isNull($col)
    {
//SELECT "user".* FROM "user" WHERE "col" IS NULL
    }

    public function isNotNull($col)
    {
//SELECT "user".* FROM "user" WHERE "col" IS NOT NULL
    }

    public function like($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" LIKE '%値1%'
    }

    public function notLike($col, $val)
    {
//SELECT "user".* FROM "user" WHERE "col" NOT LIKE '%値1%'
    }

}