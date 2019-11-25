<?php

namespace Rebib\Database\QueryBuilder\Builder;

class DeleteQueryBuilder extends CRUDQueryBuilder
{

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {

    }

    public function buildQuery(): string
    {
        //TODO
    }
}
