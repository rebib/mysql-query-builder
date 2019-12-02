<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Clause\JoinClause;

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

    /**
     *
     * @param array $joins
     * @param bool $force
     * @return JoinQueryBuilder
     */
    public function setLeftJoins(array $joins, bool $force = false): JoinQueryBuilder
    {
        if ($force === true) {
            $this->queries['LEFT'] = $joins;
        } else {
            foreach ($joins as $join) {
                if (!is_array($join[0])) {
                    $join[0] = [$join[0]];
                }
                if (!is_array($join[1])) {
                    $join[1] = [$join[1]];
                }
                $this->addLeftJoin($join[0], $join[1]);
            }
        }
        return $this;
    }

    /**
     *
     * @param array $table_reference
     * @param array $join_specification
     * @return JoinQueryBuilder
     */
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
            $sql[] = '('.$this->arrayToString($v_join[1], ' AND ').')';

            $query[] = $this->arrayToString($sql, ' ');
        }
        return $this->arrayToString($query);
    }
}
