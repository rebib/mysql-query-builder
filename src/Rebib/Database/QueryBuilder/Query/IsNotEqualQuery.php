<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsNotEqualQuery extends EqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS NOT ';

}
