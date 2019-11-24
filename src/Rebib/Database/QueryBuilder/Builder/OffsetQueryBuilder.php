<?php

namespace Rebib\Database\QueryBuilder\Builder;

class OffsetQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    protected $offset = [
        'offset' => 0,
        'row_count' => 0,
    ];

    /**
     *
     * @param int $offset
     * @return OffsetQueryBuilder
     */
    public function addOffset(int $offset): OffsetQueryBuilder
    {
        $this->offset['offset'] = $offset;
        return $this;
    }

    /**
     *
     * @param int $row_count
     * @return OffsetQueryBuilder
     */
    public function addRowCount(int $row_count): OffsetQueryBuilder
    {
        $this->offset['row_count'] = $row_count;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function buildQuery(): string
    {
        if (!$this->offset['row_count']) {
            return '';
        }
        return "LIMIT ".$this->arrayToString($this->offset, ',');
    }
}
