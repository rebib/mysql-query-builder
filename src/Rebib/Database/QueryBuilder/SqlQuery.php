<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Query\SelectQuery;
use Rebib\Database\QueryBuilder\Query\UpdateQuery;
use Rebib\Database\QueryBuilder\Query\InsertQuery;
use Rebib\Database\QueryBuilder\Query\DeleteQuery;

class SqlQuery
{

    public static function select(): SelectQuery
    {
        return new SelectQuery();
    }

    public static function update(): UpdateQuery
    {
        return new UpdateQuery();
    }

    public static function insert(): InsertQuery
    {
        return new InsertQuery();
    }

    public static function delete(): DeleteQuery
    {
        return new DeleteQuery();
    }
}
