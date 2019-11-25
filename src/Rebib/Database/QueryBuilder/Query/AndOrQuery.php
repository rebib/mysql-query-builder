<?php

namespace Rebib\Database\QueryBuilder\Query;

class AndOrQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' AND ';

    /**
     *
     * @param Query $query
     * @return AndOrQuery
     */
    public function add(Query $query): AndOrQuery
    {
        $this->query[] = $query;

        return $this;
    }

    public function buildQuery(array &$params): string
    {
        $queries = [];
        foreach ($this->query() as $v_query) {
            $queries[] = $v_query->buildQuery($params);
        }
        return '('.$this->arrayToString($queries, $this->operator()).')';
    }
}
