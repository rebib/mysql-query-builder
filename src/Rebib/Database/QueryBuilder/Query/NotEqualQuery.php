<?php

namespace Rebib\Database\QueryBuilder\Query;

class NotEqualQuery extends EqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' <> ';

}
