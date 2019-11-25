<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsEqualQuery extends EqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS ';

    /**
     *
     * @param string $expr
     * @param array $value
     * @return EqualQuery
     */
    public function add(string $expr, string $value): IsEqualQuery
    {
        return $this->add($expr, $value, true);
    }
}
