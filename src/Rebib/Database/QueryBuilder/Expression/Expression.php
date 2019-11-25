<?php

namespace Rebib\Database\QueryBuilder\Expression;

abstract class Expression
{
    /**
     *
     * @var array
     */
    protected $expression = [];

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->expression = [];
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->expression;
    }
}
