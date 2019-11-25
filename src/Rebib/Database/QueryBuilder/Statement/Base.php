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
}
