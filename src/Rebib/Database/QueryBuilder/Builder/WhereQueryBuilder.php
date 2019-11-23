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
    public function addIs(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$expr, $value, $bind, 'IS'];
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return WhereQueryBuilder
     */
    public function addIsNot(string $expr, string $value, bool $bind = true): WhereQueryBuilder
    {
        $this->queries['equal'][] = [$expr, $value, $bind, 'IS NOT'];
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
        $this->queries['equal'][] = [$expr, $value, $bind, '<>'];
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
        $this->queries['equal'][] = [$expr, $value, $bind, '>='];
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
        $this->queries['equal'][] = [$expr, $value, $bind, '<='];
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
        $this->queries['equal'][] = [$expr, $value, $bind, '='];
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
        $this->params = [];
        $query        = [];
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
            $con = $v_condition[0];
            if ($v_condition[3]) {
                $con            .= ' BETWEEN ? AND ?';
                $this->params[] = $v_condition[1];
                $this->params[] = $v_condition[2];
            } else {
                $con .= ' BETWEEN '.$v_condition[1].' AND '.$v_condition[2];
            }
            $query[] = $con;
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }

    protected function buildEqualQuery(array $conditions): string
    {
        $query = [];
        foreach ($conditions as $v_condition) {
            if (count($v_condition) !== 4) {
                continue;
            }
            $con = $v_condition[0].' '.$v_condition[3].' ';
            if ($v_condition[2]) {
                $con            .= "?";
                $this->params[] = $v_condition[1];
            } else {
                $con .= $v_condition[1];
            }
            $query[] = $con;
        }
        return '('.$this->arrayToString($query, ' AND ').')';
    }
}
