<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Builder\SelectQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\UpdateQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\InsertQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\DeleteQueryBuilder;

class QueryBuilder
{

    public static function select(): SelectQueryBuilder
    {
        return new SelectQueryBuilder();
    }

    public static function update(): UpdateQueryBuilder
    {
        return new UpdateQueryBuilder();
    }

    public static function insert(): InsertQueryBuilder
    {
        return new InsertQueryBuilder();
    }

    public static function delete(): DeleteQueryBuilder
    {
        return new DeleteQueryBuilder();
    }
}
