<?php

namespace Rebib\Database\QueryBuilder\Query;

class LessQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' < ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return LessQuery
     */
    public function add(string $expr, string $value, bool $bind = true): LessQuery
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
