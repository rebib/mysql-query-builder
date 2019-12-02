<?php

namespace Rebib\Database\QueryBuilder\Clause;

class JoinClause extends Clause
{
    /**
     *
     * @var string
     */
    protected $joinType = 'LEFT';

    /**
     * Return join type
     * 
     * @return string
     */
    public function getJoinType(): string
    {
        return $this->joinType;
    }

    /**
     *
     * @param string|array $table_reference
     * @param string|array $join_specification
     * @return JoinClause
     */
    public function add($table_reference, $join_specification): JoinClause
    {
        if (!is_array($table_reference)) {
            $table_reference = [$table_reference];
        }
        if (!is_array($join_specification)) {
            $join_specification = [$join_specification];
        }
        $this->elements[] = [
            $table_reference,
            $join_specification
        ];
        return $this;
    }
}
