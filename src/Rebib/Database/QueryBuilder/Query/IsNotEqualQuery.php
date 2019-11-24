<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsNotEqualQuery
{ /**
 *
 * @var string
 */
    protected $operator = ' IS NOT ';

    /**
     *
     * @param string $expr
     * @param string $value
     * @param bool $bind bind parameter or not
     * @return IsNotEqualQuery
     */
    public function addIsNotEqual(string $expr, string $value, bool $bind = true): IsNotEqualQuery
    {
        $this->queries['equal'][] = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params): string
    {
        $queries = [];
        //TODO
        return '('.$this->arrayToString($queries, $this->operator()).')';
    }
}
