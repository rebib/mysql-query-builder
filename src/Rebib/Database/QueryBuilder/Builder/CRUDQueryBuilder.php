<?php

namespace Rebib\Database\QueryBuilder\Builder;

abstract class CRUDQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    private $tables = [];

    /**
     *
     * @param string $table
     * @return CRUDQueryBuilder
     */
    public function setTable(string $table): CRUDQueryBuilder
    {
        if (!in_array($table, $this->tables)) {
            $this->tables[] = $table;
        }

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTable(): string
    {
        return '('.$this->array2String($this->tables, ',').')';
    }
}
