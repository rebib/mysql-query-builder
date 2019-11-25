<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsNotEqualQuery extends IsEqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS NOT ';

}
