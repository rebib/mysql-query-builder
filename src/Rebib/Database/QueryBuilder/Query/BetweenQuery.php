<?php

namespace Rebib\Database\QueryBuilder\Query;

class BetweenQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' BETWEEN %s AND %s ';

    /**
     *
     * @param string $expr
     * @param string $min
     * @param string $max
     * @param bool $bind bind parameter or not
     * @return BetweenQuery
     */
    public function add(string $expr, string $min, string $max,
                        bool $bind = true): BetweenQuery
    {
        $this->query = [$bind, $expr, $min, $max];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        if(!$this->query()){
            return '';
        }
        list($bind, $expr, $min, $max ) = $this->query();
        $queries = [$expr];
        if ($bind) {
            $params[] = $min;
            $params[] = $max;

            $min = $max = '?';
        }
        $queries[] = sprintf($this->operator(), $min, $max);
        return $this->arrayToString($queries, ' ');
    }
}
