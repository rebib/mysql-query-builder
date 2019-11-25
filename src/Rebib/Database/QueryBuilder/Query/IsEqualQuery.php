<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsEqualQuery extends EqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS ';

}
