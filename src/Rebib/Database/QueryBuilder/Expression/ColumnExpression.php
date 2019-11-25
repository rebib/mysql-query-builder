<?php

namespace Rebib\Database\QueryBuilder\Expression;

class ColumnExpression extends Expression
{

    /**
     *
     * @param string $column_name
     * @param string|null $table_reference
     * @return ColumnExpression
     */
    public function add(string $column_name, ?string $table_reference = null): ColumnExpression
    {
        if (empty($table_reference)) {
            $this->expression[] = $column_name;
        } else {
            $this->expression[] = $table_reference.'.'.$column_name;
        }
        return $this;
    }
}
