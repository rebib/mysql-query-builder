<?php

namespace Rebib\Database\QueryBuilder\Query;

class IsEqualQuery extends EqualQuery
{
    /**
     *
     * @var string
     */
    protected $operator = ' IS ';

    /**
     *
     * @param string $expr
     * @param array $value
     * @param bool $bind bind parameter or not
     * @return EqualQuery
     */
    public function add(string $expr, string $value, bool $bind = true): IsEqualQuery
    {
        if (in_array(strtoupper($value), ['TRUE', 'FALSE', 'UNKNOWN', 'NULL'])) {
            $bind = $bind;
            return $this;
        }
        return $this->add($expr, $value, false);
    }
}
