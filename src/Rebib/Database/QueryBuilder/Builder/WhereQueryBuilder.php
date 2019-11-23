<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Query\Query;

class WhereQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    private $queries = [
        'between' => [],
        'equal' => [],
    ];

    /**
     *
     * @var array
     */
    private $parameters = [];

    /**
     *
     * @param Query $query
     * @return WhereQueryBuilder
     */
    public function addQuery(Query $query): WhereQueryBuilder
    {
        //TODO
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @return WhereQueryBuilder
     */
    public function addEqual(string $expr, string $value): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$expr, $value];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $min
     * @param string $max
     * @return WhereQueryBuilder
     */
    public function addBetween(string $expr, string $min, string $max): WhereQueryBuilder
    {
        $this->queries['between'][] = [$expr, $min, $max];
        return $this;
    }

    public function buildQuery(): string
    {
        $query = [];
        foreach ($this->queries as $operator => $conditions) {
            switch ($operator) {
                case 'between':
                    $query[] = $this->buildBetweenQuery($conditions);
                    break;
            }
        }
        if ($query) {
            array_unshift($query, 'WHERE');
        }
        return $this->arrayToString($query, ' AND ');
    }

    //protected



    protected function buildBetweenQuery(array $conditions)
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 3) {
                continue;
            }
            $query[] = $v_condition[0].' BETWEEN ? AND ?';

            $this->parameters[] = $v_condition[1];
            $this->parameters[] = $v_condition[2];
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }

    protected function buildEqualQuery(array $conditions)
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 3) {
                continue;
            }
            $query[] = $v_condition[0].' = ?';

            $this->parameters[] = $v_condition[1];
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }
}
