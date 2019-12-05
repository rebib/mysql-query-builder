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
     * @param string|null $delimiter
     * @param bool $quotes
     * @return string
     */
    protected function arrayToString(array $queries, string $delimiter = PHP_EOL,
                                     bool $quotes = false): string
    {
        $data = array_filter(array_map('trim', $queries), 'strlen');
        if ($data) {
            if (empty($delimiter)) {
                $delimiter = PHP_EOL;
            }
            if ($quotes) {
                $quote  = "'";
                $string = $quote.implode($quote.$delimiter.$quote, $data).$quote;
            } else {
                $string = implode($delimiter, $data);
            }
        } else {
            $string = '';
        }
        return $string;
    }
}
