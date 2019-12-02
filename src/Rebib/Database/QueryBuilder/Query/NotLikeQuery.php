<?php

namespace Rebib\Database\QueryBuilder\Query;

class NotLikeQuery extends LikeQuery
{
        /**
     *
     * @var string
     */
    protected $operator = ' NOT LIKE ';
}
