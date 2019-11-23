<?php

namespace Rebib\Database\QueryBuilder\Builder;

abstract class Builder
{

    /**
     *
     * @param array $queries
     * @param string $delimiter
     * @return string
     */
    protected function arrayToString(array $queries, string $delimiter = PHP_EOL): string
    {
        if (!$queries) {
            return '';
        }
        return implode($delimiter, $queries);
    }

    /**
     *
     * @return string
     */
    abstract public function buildQuery(): string;
}
