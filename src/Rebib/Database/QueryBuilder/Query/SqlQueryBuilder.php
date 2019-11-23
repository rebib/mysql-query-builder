<?php

namespace Rebib\Database\QueryBuilder\Query;

abstract class SqlQueryBuilder
{


    /**
     *
     * @param array $queries
     * @param string $delimiter
     * @return string
     */
    protected function arrayToString(array $queries, string $delimiter = PHP_EOL): string
    {
        return implode($delimiter, $queries);
    }

    /**
     *
     * @return string
     */
    abstract public function buildQuery(): string;
}
