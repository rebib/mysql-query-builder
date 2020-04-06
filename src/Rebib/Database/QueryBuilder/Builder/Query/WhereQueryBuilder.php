<?php

namespace Rebib\Database\QueryBuilder\Builder\Query;

use InvalidArgumentException;
use Rebib\Database\QueryBuilder\Query\Query;
use Rebib\Database\QueryBuilder\Query\OrQuery;
use Rebib\Database\QueryBuilder\Builder\Builder;

class WhereQueryBuilder extends Builder {

    /**
     *
     * @var array
     */
    private $queries = [
        'between' => [],
        'equal' => [],
        'in' => [],
    ];

    /**
     *
     * @var array
     */
    private $params = [];

    /**
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->params;
    }

    /**
     *
     * @param Query $query
     * @return WhereQueryBuilder
     */
    public function addQuery(Query $query): WhereQueryBuilder
    {
        $this->queries[] = $query;
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addIn(string $expr, array $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['in'][] = [$bind, $expr, $value, 'IN'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addNotIn(string $expr, array $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['in'][] = [$bind, $expr, $value, 'NOT IN'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addIsEqual(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$bind, $expr, $value, 'IS'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addIsNotEqual(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$bind, $expr, $value, 'IS NOT'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addNotEqual(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$bind, $expr, $value, '<>'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addGreaterEqual(string $expr, string $value,
            bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$bind, $expr, $value, '>='];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addLessEqual(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$bind, $expr, $value, '<='];
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
        $this->queries['equal'][] = [$bind, $expr, $value, '='];
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
        $this->queries['between'][] = [$bind, $expr, $min, $max];
        return $this;
    }

    public function buildQuery(): string
    {
        $this->params = [];
        $query = [];
        foreach ($this->queries as $operator => $v_query) {
            if ($v_query instanceof Query) {
                $query[] = $v_query->buildQuery($this->params);
            } elseif ($v_query) {
                switch ($operator) {
                    case 'between':
                        $query[] = $this->buildBetweenQuery($v_query);
                        break;
                    case 'equal':
                        $query[] = $this->buildEqualQuery($v_query);
                        break;
                    case 'in':
                        $query[] = $this->buildInQuery($v_query);
                        break;
                }
            }
        }
        $where = $this->array2String($query, PHP_EOL . 'AND ');
        if ($where) {
            $where = 'WHERE ' . $where;
        }
        return $where;
    }

    protected function buildInQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 4) {
                continue;
            }
            list($bind, $expr, $value, $operator) = $v_condition;
            $con = [];
            $con[] = $expr;
            if ($bind) {
                //TODO
                $this->TODO();
            } else {
                $con[] = $operator;
                $con[] = '(';
                $con[] = $this->array2String($value, ',');
                $con[] = ')';
            }
            $query[] = $this->array2String($con, ' ');
        }
        return '(' . $this->array2String($query, PHP_EOL . '    AND ') . ')';
    }

    protected function buildBetweenQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 4) {
                continue;
            }
            list($bind, $expr, $min, $max ) = $v_condition;
            $con = [];
            $con[] = $expr;
            if ($bind) {
                $con[] = 'BETWEEN ? AND ?';
                $this->params[] = $min;
                $this->params[] = $max;
            } else {
                $con[] = 'BETWEEN ' . $min . ' AND ' . $max;
            }
            $query[] = $this->array2String($con, ' ');
        }
        return '(' . $this->array2String($query, PHP_EOL . '    AND ') . ')';
    }

    protected function buildEqualQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 4) {
                continue;
            }
            list($bind, $expr, $value, $operator) = $v_condition;
            $con = [];
            $con[] = $expr;
            $con[] = $operator;
            if ($bind) {
                $con[] = "?";
                $this->params[] = $value;
            } else {
                $con[] = $value;
            }
            $query[] = $this->array2String($con, ' ');
        }
        return '(' . $this->array2String($query, PHP_EOL . ' AND ') . ')';
    }

}
