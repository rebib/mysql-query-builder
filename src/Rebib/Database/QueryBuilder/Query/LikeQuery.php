<?php

namespace Rebib\Database\QueryBuilder\Query;

class LikeQuery extends Query
{
    /**
     *
     * @var string
     */
    protected $operator = ' LIKE ';

    /**
     *
     * @var bool
     */
    protected $left = true;

    /**
     *
     * @var bool
     */
    protected $right = true;

    /**
     *
     * @return LikeQuery
     */
    public function disableLeftMatch(): LikeQuery
    {
        $this->left = false;
        return $this;
    }

    /**
     *
     * @return LikeQuery
     */
    public function disableRightMatch(): LikeQuery
    {
        $this->right = false;
        return $this;
    }

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return EqualQuery
     */
    public function add(string $expr, string $value, bool $bind = true): Query
    {
        $this->elements = [$bind, $expr, $value];
        return $this;
    }

    public function buildQuery(array &$params = []): string
    {
        if (!$this->toArray()) {
            return '';
        }
        list($bind, $expr, $value) = $this->toArray();
        $operator  = $this->operator;
        $queries   = [];
        $queries[] = $expr;
        $queries[] = $operator;
        if ($bind) {
            $queries[] = "?";
            $params[]  = ($this->left ? '%' : '').$value.($this->right ? '%' : '');
        } else {
            $queries[] = $value;
        }
        return $this->normalizeQuery($this->array2String($queries, ' '));
    }
}
