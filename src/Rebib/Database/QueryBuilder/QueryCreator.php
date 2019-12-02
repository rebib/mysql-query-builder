<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Query\AndQuery;
use Rebib\Database\QueryBuilder\Query\BetweenQuery;
use Rebib\Database\QueryBuilder\Query\EqualQuery;
use Rebib\Database\QueryBuilder\Query\GreaterEqualQuery;
use Rebib\Database\QueryBuilder\Query\GreatorQuery;
use Rebib\Database\QueryBuilder\Query\InQuery;
use Rebib\Database\QueryBuilder\Query\IsEqualQuery;
use Rebib\Database\QueryBuilder\Query\IsNotEqualQuery;
use Rebib\Database\QueryBuilder\Query\LessEqualQuery;
use Rebib\Database\QueryBuilder\Query\LessQuery;
use Rebib\Database\QueryBuilder\Query\NotInQuery;
use Rebib\Database\QueryBuilder\Query\NotEqualQuery;
use Rebib\Database\QueryBuilder\Query\OrQuery;
use Rebib\Database\QueryBuilder\Query\LikeQuery;
use Rebib\Database\QueryBuilder\Query\NotLikeQuery;

class QueryCreator
{

    public static function getAndQuery(): AndQuery
    {
        return new AndQuery();
    }

    public static function getBetweenQuery(): BetweenQuery
    {
        return new BetweenQuery();
    }

    public static function getEqualQuery(): EqualQuery
    {
        return new EqualQuery();
    }

    public static function getGreaterEqualQuery(): GreaterEqualQuery
    {
        return new GreaterEqualQuery();
    }

    public static function getGreatorQuery(): GreatorQuery
    {
        return new GreatorQuery();
    }

    public static function getInQuery(): InQuery
    {
        return new InQuery();
    }

    public static function getIsEqualQuery(): IsEqualQuery
    {
        return new IsEqualQuery();
    }

    public static function getIsNotEqualQuery(): IsNotEqualQuery
    {
        return new IsNotEqualQuery();
    }

    public static function getLessEqualQuery(): LessEqualQuery
    {
        return new LessEqualQuery();
    }

    public static function getLessQuery(): LessQuery
    {
        return new LessQuery();
    }

    public static function getNotInQuery(): NotInQuery
    {
        return new NotInQuery();
    }

    public static function getNotEqualQuery(): NotEqualQuery
    {
        return new NotEqualQuery();
    }

    public static function getOrQuery(): OrQuery
    {
        return new OrQuery();
    }

    public static function getLikeQuery(): LikeQuery
    {
        return new LikeQuery();
    }

    public static function getNotLikeQuery(): NotLikeQuery
    {
        return new NotLikeQuery();
    }
}
