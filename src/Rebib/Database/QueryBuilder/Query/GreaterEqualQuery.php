<?php

namespace Rebib\Database\QueryBuilder\Query;

class GreaterEqualQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' >= ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return GreaterEqualQuery
     */
    public function add(string $expr, string $value, bool $bind = true): GreaterEqualQuery
    {
        $this->query = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        $queries = [];
        //TODO
        return '('.$this->arrayToString($queries, $this->operator()).')';
    }
}
