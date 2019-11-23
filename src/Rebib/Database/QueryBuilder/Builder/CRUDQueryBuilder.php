<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Builder;

abstract class CRUDQueryBuilder extends Builder
{
    /**
     *
     * @var string
     */
    private $tables;

    /**
     *
     * @param string $table
     * @return CRUDQuery
     */
    public function setTable(string $table): CRUDQuery
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
        return '('.$this->arrayToString($this->tables, ',').')';
    }
}
