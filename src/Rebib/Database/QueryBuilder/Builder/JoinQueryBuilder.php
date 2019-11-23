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

    public function setLeftJoins(array $joins, bool $force = false): JoinQueryBuilder
    {
        if ($force === true) {
            $this->queries['LEFT'] = $joins;
        } else {
            foreach ($joins as $join) {
                $this->addLeftJoin($join[0], $join[1]);
            }
        }
        return $this;
    }

    public function addLeftJoin(array $table_reference,
                                array $join_specification): JoinQueryBuilder
    {
        $this->queries['LEFT'][] = [
            $table_reference,
            $join_specification,
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
            $sql[] = "$type OUTER JOIN";
            $sql[] = '('.$this->arrayToString($v_join[0], ',').')';
            $sql[] = 'ON';
            $sql[] = '('.$this->arrayToString($v_join[1], ',').')';

            $query[] = $this->arrayToString($sql, ' ');
        }
        return $this->arrayToString($query);
    }
}
