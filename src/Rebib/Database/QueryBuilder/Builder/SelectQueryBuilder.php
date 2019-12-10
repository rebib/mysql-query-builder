<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Builder\Query\FieldsQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\Query\GroupQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\Query\OffsetQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\Query\JoinQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\Query\WhereQueryBuilder;
use Rebib\Database\QueryBuilder\Builder\Query\OrderQueryBuilder;

class SelectQueryBuilder extends CRUDQueryBuilder
{
    /**
     *
     * @var GroupQueryBuilder
     */
    private $groupQuery;

    /**
     *
     * @var JoinQueryBuilder
     */
    private $joinQuery;

    /**
     *
     * @var OffsetQueryBuilder
     */
    private $offsetQuery;

    /**
     *
     * @var OrderQueryBuilder
     */
    private $orderQuery;

    /**
     *
     * @var WhereQueryBuilder
     */
    private $whereQuery;

    /**
     *
     * @var FieldsQueryBuilder
     */
    private $fieldsQuery;

    /**
     *
     * @var bool
     */
    private $isBuild = false;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->groupQuery  = new GroupQueryBuilder();
        $this->joinQuery   = new JoinQueryBuilder();
        $this->offsetQuery = new OffsetQueryBuilder();
        $this->orderQuery  = new OrderQueryBuilder();
        $this->whereQuery  = new WhereQueryBuilder();
        $this->fieldsQuery = new FieldsQueryBuilder();
    }

    public function __clone()
    {
        $this->groupQuery  = clone( $this->groupQuery);
        $this->joinQuery   = clone( $this->joinQuery);
        $this->offsetQuery = clone( $this->offsetQuery);
        $this->orderQuery  = clone( $this->orderQuery);
        $this->whereQuery  = clone( $this->whereQuery);
        $this->fieldsQuery = clone( $this->fieldsQuery);
    }

    /**
     *
     * @return GroupQueryBuilder
     */
    public function getGroupQueryBuilder(): GroupQueryBuilder
    {
        return $this->groupQuery;
    }

    /**
     *
     * @return JoinQueryBuilder
     */
    public function getJoinQueryBuilder(): JoinQueryBuilder
    {
        return $this->joinQuery;
    }

    /**
     *
     * @return OffsetQueryBuilder
     */
    public function getOffsetQueryBuilder(): OffsetQueryBuilder
    {
        return $this->offsetQuery;
    }

    /**
     *
     * @return OrderQueryBuilder
     */
    public function getOrderQueryBuilder(): OrderQueryBuilder
    {
        return $this->orderQuery;
    }

    /**
     *
     * @return WhereQueryBuilder
     */
    public function getWhereQueryBuilder(): WhereQueryBuilder
    {
        return $this->whereQuery;
    }

    /**
     *
     * @return FieldsQueryBuilder
     */
    public function getFieldsQueryBuilder(): FieldsQueryBuilder
    {
        return $this->fieldsQuery;
    }

    /**
     *
     * @return string
     */
    public function buildQuery(): string
    {
        $this->isBuild = true;

        $query[] = 'SELECT '.$this->getFieldsQueryBuilder()->buildQuery();
        $query[] = 'FROM '.$this->getTable();
        $query[] = $this->getJoinQueryBuilder()->buildQuery();
        $query[] = $this->getWhereQueryBuilder()->buildQuery();
        $query[] = $this->getGroupQueryBuilder()->buildQuery();
        $query[] = $this->getOrderQueryBuilder()->buildQuery();
        $query[] = $this->getOffsetQueryBuilder()->buildQuery();
        return $this->array2String($query);
    }

    public function getQueryParameters(): array
    {
        if ($this->isBuild == false) {
            $this->buildQuery();
        }
        return $this->getWhereQueryBuilder()->getParameters();
    }
}
