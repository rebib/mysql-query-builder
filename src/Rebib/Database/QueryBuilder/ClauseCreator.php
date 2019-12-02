<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Clause\LeftJoinClasuse;
use Rebib\Database\QueryBuilder\Clause\RightJoinClause;
use Rebib\Database\QueryBuilder\Clause\UnionClause;

class ClauseCreator
{

    public static function getLeftJoinClause(): LeftJoinClasuse
    {
        return new LeftJoinClasuse();
    }

    public static function getUnionClause(): UnionClause
    {
        return new UnionClause();
    }
}
