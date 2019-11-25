<?php

namespace Rebib\Database\QueryBuilder\Query;

class EqualQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' = ';

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return EqualQuery
     */
    public function add(string $expr, string $value, bool $bind = true): EqualQuery
    {
        $this->query = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        if (!$this->query()) {
            return '';
        }
        list($bind, $expr, $value) = $this->query();
        $operator  = $this->operator;
        $queries   = [$expr];
        $queries[] = $operator;
        if ($bind) {
            $queries[] = "?";
            $params[]  = $value;
        } else {
            $queries[] = $value;
        }
        return $this->arrayToString($queries, ' ');
    }
}
