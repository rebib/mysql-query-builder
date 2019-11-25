<?php

namespace Rebib\Database\QueryBuilder\Statement;

abstract class Base
{
    /**
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->clear();
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     *
     * @return Base
     */
    public function clear(): Base
    {
        $this->elements = [];
        return $this;
    }

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
}
