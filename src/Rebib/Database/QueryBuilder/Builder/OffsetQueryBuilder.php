<?php

namespace Rebib\Database\QueryBuilder\Builder;

class OffsetQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    protected $queries = [
        'offset' => 0,
        'row_count' => 10,
    ];

    /**
     *
     * @param int $offset
     * @return LimitQueryBuilder
     */
    public function addOffset(int $offset): LimitQueryBuilder
    {
        $this->queries['offset'] = $offset;
        return $this;
    }

    /**
     *
     * @param int $row_count
     * @return LimitQueryBuilder
     */
    public function addRowCount(int $row_count): LimitQueryBuilder
    {
        $this->queries['row_count'] = $row_count;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function buildQuery(): string
    {
        return "LIMIT ".implode(', ', $this->queries);
    }
}
