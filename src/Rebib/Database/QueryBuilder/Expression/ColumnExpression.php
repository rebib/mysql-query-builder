<?php

namespace Rebib\Database\QueryBuilder\Expression;

class ColumnExpression extends Expression
{

    /**
     *
     * @param string $column_name
     * @param string|null $table_ref
     * @return ColumnExpression
     */
    public function add(string $column_name, ?string $table_ref = null): ColumnExpression
    {
        if (empty($table_ref)) {
            $this->elements[] = $column_name;
        } else {
            $this->elements[] = $table_ref.'.'.$column_name;
        }
        return $this;
    }
}
