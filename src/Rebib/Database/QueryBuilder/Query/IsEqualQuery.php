<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsEqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return IsEqualQuery
     */
    public function addIsEqual(string $expr, string $value, bool $bind = true): IsEqualQuery
    {
        $this->queries['equal'][] = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        $queries = [];
        //TODO
        return '('.$this->arrayToString($queries, $this->operator()).')';
    }
}
