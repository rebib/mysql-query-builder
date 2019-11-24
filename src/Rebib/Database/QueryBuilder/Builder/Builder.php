<?php

namespace Rebib\Database\QueryBuilder\Builder;

use InvalidArgumentException;

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
        $data = array_filter(array_map('trim', $queries), 'strlen');
        if (!$data) {
            return '';
        }
        return implode($delimiter, $data);
    }

    /**
     * TODO
     * 
     * @throws InvalidArgumentException
     */
    protected function TODO()
    {
        //TODO
        throw new InvalidArgumentException('TODO: '.get_class($this));
    }

    /**
     *
     * @return string
     */
    abstract public function buildQuery(): string;
}
