<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Builder\SelectQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\UpdateQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\InsertQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\DeleteQueryBuilder;

class QueryBuilder
{

    /**
     *
     * @return SelectQueryBuilder
     */
    public static function select(): SelectQueryBuilder
    {
        return new SelectQueryBuilder();
    }

    /**
     *
     * @return UpdateQueryBuilder
     */
    public static function update(): UpdateQueryBuilder
    {
        return new UpdateQueryBuilder();
    }

    /**
     *
     * @return InsertQueryBuilder
     */
    public static function insert(): InsertQueryBuilder
    {
        return new InsertQueryBuilder();
    }

    /**
     *
     * @return DeleteQueryBuilder
     */
    public static function delete(): DeleteQueryBuilder
    {
        return new DeleteQueryBuilder();
    }
}
