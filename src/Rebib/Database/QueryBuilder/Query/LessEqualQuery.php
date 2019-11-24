<?php

namespace Rebib\Database\QueryBuilder\Query;

class LessEqualQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' <= ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return LessEqualQuery
     */
    public function add(string $expr, string $value, bool $bind = true): LessEqualQuery
    {
        $this->query = [$bind, $expr, $value, '<='];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        $queries = [];
        //TODO
        return '('.$this->arrayToString($queries, $this->operator()).')';
    }
}
