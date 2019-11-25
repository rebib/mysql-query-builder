<?php

namespace Rebib\Database\QueryBuilder\Query;

class InQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' IN ';

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return InQuery
     */
    public function add(string $expr, array $value, bool $bind = true): InQuery
    {
        $this->elements = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        list($bind, $expr, $value) = $this->toArray();
        $operator = $this->operator;

        $queries = [];
        if ($bind) {
            //TODO
            $params = $params;
        } else {
            $queries[] = $expr;
            $queries[] = $operator;
            $queries[] = '('.$this->arrayToString($value, ',').')';
        }
        return $this->normalizeQuery($this->arrayToString($queries, ' '));
    }
}
