<?php

namespace Rebib\Database\QueryBuilder\Query;

class NotInQuery extends InQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' NOT IN ';

}
