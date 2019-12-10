<?php

namespace Rebib\Database\QueryBuilder\Builder\Query;

class OrderQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    private $queries = [];

    /**
     *
     * @param string $column
     * @param string $order
     * @param string $table_ref
     * @param bool $force replace or not if exists
     * @return OrderQueryBuilder
     */
    public function addOrder(string $column, string $order,
                             string $table_ref = null, bool $force = false): OrderQueryBuilder
    {
        if (!empty($table_ref)) {
            $column = $table_ref.'.'.$column;
        }
        if ($force === false && !empty($this->queries[$column])) {
            return $this;
        } else {
            $order = strtoupper(trim($order));
        }
        if (!in_array($order, ['ASC', 'DESC'])) {
            return $this;
        }
        $this->queries[$column] = $order;
        return $this;
    }

    /**
     * Add ASC ORDER
     *
     * @param string $column
     * @param string $table_ref
     * @param bool $force replace or not if exists
     * @return OrderQueryBuilder
     */
    public function addOrderByAsc(string $column, string $table_ref = null,
                                  bool $force = false): OrderQueryBuilder
    {
        return $this->addOrder($column, 'ASC', $table_ref, $force);
    }

    /**
     * Add DESC ORDER
     *
     * @param string $column
     * @param string $table_ref
     * @param bool $force
     * @return OrderQueryBuilder
     */
    public function addOrderByDesc(string $column, string $table_ref = null,
                                   bool $force = false): OrderQueryBuilder
    {
        return $this->addOrder($column, 'DESC', $table_ref, $force);
    }

    /**
     *
     * @return string
     */
    public function buildQuery(): string
    {
        if (count($this->queries) === 0) {
            return '';
        }
        $query = [];
        foreach ($this->queries as $column => $order) {
            $query[] = "$column $order";
        }
        return 'ORDER BY '.$this->array2String($query, ', ');
    }
}
