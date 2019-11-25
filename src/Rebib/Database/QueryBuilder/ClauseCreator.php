<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Clause\JoinClause;
use Rebib\Database\QueryBuilder\Clause\UnionClause;

class ClauseCreator
{

    public static function getJoinClause(): JoinClause
    {
        return new JoinClause();
    }

    public static function getUnionClause(): UnionClause
    {
        return new UnionClause();
    }
}
