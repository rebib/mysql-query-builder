<?php

namespace Rebib\Database\QueryBuilder\Query;

class GreatorQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' > ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return GreatorQuery
     */
    public function add(string $expr, string $value, bool $bind = true): GreatorQuery
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
