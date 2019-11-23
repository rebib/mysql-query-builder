<?php

namespace Rebib\Database\QueryBuilder\Builder;

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
     * @param bool $force replace or not if exists
     * @return OrderQueryBuilder
     */
    public function addOrder(string $column, string $order, bool $force = false): OrderQueryBuilder
    {
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
     * @param bool $force replace or not if exists
     * @return OrderQueryBuilder
     */
    public function addOrderByAsc(string $column, bool $force = false): OrderQueryBuilder
    {
        return $this->addOrder($column, 'ASC', $force);
    }

    /**
     * Add DESC ORDER
     *
     * @param string $column
     * @param bool $force replace or not if exists
     * @return OrderQueryBuilder
     */
    public function addOrderByDesc(string $column, bool $force = false): OrderQueryBuilder
    {
        return $this->addOrder($column, 'DESC', $force);
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
        return 'ORDER BY '.implode(', ', $query);
    }
}
