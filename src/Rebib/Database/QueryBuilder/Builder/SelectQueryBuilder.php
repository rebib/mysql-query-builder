<?php

namespace Rebib\Database\QueryBuilder\Builder;

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
     * Constructor
     *
     */
    public function __construct()
    {
        $this->groupQuery  = new GroupQueryBuilder();
        $this->joinQuery   = new JoinQueryBuilder();
        $this->offsetQuery = new OffsetQueryBuilder();
        $this->orderQuery  = new OrderQueryBuilder();
        $this->whereQuery  = new WhereQueryBuilder();
        $this->fieldsQuery = new FieldsQueryBuilder();
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
        $query[] = 'SELECT';
        $query[] = $this->getFieldsQueryBuilder()->buildQuery();
        $query[] = 'FROM '.$this->getTable();
        $query[] = $this->getJoinQueryBuilder()->buildQuery();
        $query[] = $this->getWhereQueryBuilder()->buildQuery();
        $query[] = $this->getGroupQueryBuilder()->buildQuery();
        $query[] = $this->getOrderQueryBuilder()->buildQuery();
        $query[] = $this->getOffsetQueryBuilder()->buildQuery();

        return $this->arrayToString($query);
    }
}
