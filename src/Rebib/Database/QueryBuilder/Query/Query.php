<?php

namespace Rebib\Database\QueryBuilder\Query;

abstract class Query
{
    /**
     *
     * @var string
     */
    protected $operator = '=';

    /**
     *
     * @var array
     */
    protected $query = [];

    /**
     *
     * @return array
     */
    public function query(): array
    {
        return $this->query;
    }

    /**
     *
     * @return string
     */
    public function operator(): string
    {
        return $this->operator;
    }

    /**
     *
     * @param array $queries
     * @param string $delimiter
     * @return string
     */
    public function arrayToString(array $queries, string $delimiter = PHP_EOL): string
    {
        $data = array_filter(array_map('trim', $queries), 'strlen');
        if (!$data) {
            return '';
        }
        return implode($delimiter, $data);
    }

    /**
     *
     * @param array $params
     * @return string
     */
    abstract public function buildQuery(array &$params): string;
}
