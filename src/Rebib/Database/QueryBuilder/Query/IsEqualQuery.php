<?php

namespace Rebib\Database\QueryBuilder\Query;

use InvalidArgumentException;

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
    public function add(string $expr, string $value, bool $bind = true): EqualQuery
    {
        if (!in_array(strtoupper($value), ['TRUE', 'FALSE', 'UNKNOWN', 'NULL'])) {
            throw new InvalidArgumentException("Invalid value for IS QUERY");
        } else {
            $bind = false;
        }
        return parent::add($expr, $value, $bind);
    }
}
