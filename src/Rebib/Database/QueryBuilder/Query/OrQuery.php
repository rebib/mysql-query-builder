<?php

namespace Rebib\Database\QueryBuilder\Query;

class OrQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' OR ';

    public function add(Query $query): OrQuery
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
