<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Statement\Base;

abstract class Builder extends Base
{

    /**
     *
     * @return string
     */
    abstract public function buildQuery(): string;
}
