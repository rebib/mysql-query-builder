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
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

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
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addEqual(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$expr, $value, $bind];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $min
     * @param string $max
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addBetween(string $expr, string $min, string $max,
                               bool $bind = true): WhereQueryBuilder
    {
        $this->queries['between'][] = [$expr, $min, $max, $bind];
        return $this;
    }

    public function buildQuery(): string
    {
        $this->parameters = [];
        $query            = [];
        foreach ($this->queries as $operator => $conditions) {
            if (!$conditions) {
                continue;
            }
            switch ($operator) {
                case 'between':
                    $query[] = $this->buildBetweenQuery($conditions);
                    break;
                case 'equal':
                    $query[] = $this->buildEqualQuery($conditions);
                    break;
            }
        }
        $where = $this->arrayToString($query, ' AND ');
        if ($where) {
            $where = $this->arrayToString(['WHERE', $where]);
        }
        return $where;
    }

    protected function buildBetweenQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 4) {
                continue;
            }
            if ($v_condition[3]) {
                $query[]            = $v_condition[0].' BETWEEN ? AND ?';
                $this->parameters[] = $v_condition[1];
                $this->parameters[] = $v_condition[2];
            } else {
                $query[] = $v_condition[0].' BETWEEN '.$v_condition[1].' AND '.$v_condition[2];
            }
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }

    protected function buildEqualQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 3) {
                continue;
            }
            if ($v_condition[2]) {
                $query[]            = $v_condition[0].' = ?';
                $this->parameters[] = $v_condition[1];
            } else {
                $query[] = $v_condition[0].' = '.$v_condition[1];
            }
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }
}
