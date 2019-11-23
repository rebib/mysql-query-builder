<?php

namespace Rebib\Database\QueryBuilder\Builder;

class GroupQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    private $groups = [];

    public function buildQuery(): string
    {
        return $this->arrayToString($this->groups, ',');
    }
}
