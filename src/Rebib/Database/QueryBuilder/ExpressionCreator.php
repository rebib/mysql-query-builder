<?php

namespace Rebib\Database\QueryBuilder;

use Rebib\Database\QueryBuilder\Expression\ColumnExpression;

class ExpressionCreator
{

    public static function getColumnExpression(): ColumnExpression
    {
        return new ColumnExpression();
    }
}
