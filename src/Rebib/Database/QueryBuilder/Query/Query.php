<?php

namespace Rebib\Database\QueryBuilder\Query;

use Rebib\Database\QueryBuilder\Statement\Base;

abstract class Query extends Base
{
    /**
     *
     * @var string
     */
    protected $operator = ' = ';

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

    /**
     *
     * @param string $query
     * @return string
     */
    protected function normalizeQuery(string $query): string
    {
        if (trim($query)) {
            $query = "($query)";
        }
        return $query;
    }
}
