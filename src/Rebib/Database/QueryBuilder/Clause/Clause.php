<?php

namespace Rebib\Database\QueryBuilder\Clause;

abstract class Clause
{
    /**
     *
     * @var array 
     */
    protected $clause = [];

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->clause = [];
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->clause;
    }
}
