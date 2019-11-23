<?php

namespace Rebib\Database\QueryBuilder\Builder;

class JoinQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    protected $queries = [
        'LEFT' => [],
        'RIGHT' => [],
    ];

    public function addLeftJoin(array $table_reference,
                                array $join_specification): JoinQueryBuilder
    {
        $this->queries['LEFT'][] = [
            'table' => $table_reference,
            'condition' => $join_specification,
        ];

        return $this;
    }

    public function buildQuery(): string
    {
        $query = [];
        foreach ($this->queries as $type => $join) {
            switch ($type) {
                case "LEFT":
                case 'RIGHT':
                    $query[] = $this->buildLROuterJoin($join, $type);
                    break;
            }
        }
        return $this->arrayToString($query);
    }

    //protected
    protected function buildLROuterJoin(array $joins, string $type): string
    {
        $query = [];
        foreach ($joins as $v_join) {
            $sql   = [];
            $sql[] = "$type OUTER JOIN ";
            $sql[] = '('.$this->arrayToString($v_join['table'], ',').')';
            $sql[] = 'ON';
            $sql[] = '('.$this->arrayToString($v_join['condition'], ',').')';

            $query[] = $this->arrayToString($sql, ' ');
        }
        return $this->arrayToString($query);
    }
}
