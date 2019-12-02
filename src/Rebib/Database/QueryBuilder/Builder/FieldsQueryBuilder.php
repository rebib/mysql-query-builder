<?php

namespace Rebib\Database\QueryBuilder\Builder;

use Rebib\Database\QueryBuilder\Expression\ColumnExpression;

class FieldsQueryBuilder extends Builder
{
    /**
     *
     * @var array
     */
    private $fields = [];

    /**
     *
     * @param ColumnExpression $expression
     * @param bool $force
     * @return FieldsQueryBuilder
     */
    public function setExpression(ColumnExpression $expression,
                                  bool $force = false): FieldsQueryBuilder
    {
        return $this->setFields($expression->toArray(), $force);
    }

    /**
     *
     * @param array $fields
     * @param bool $force
     * @return FieldsQueryBuilder
     */
    public function setFields(array $fields, bool $force = false): FieldsQueryBuilder
    {
        if ($force === true) {
            $this->fields = $fields;
        } else {
            foreach ($fields as $field) {
                $this->addField($field);
            }
        }
        return $this;
    }

    /**
     * @param string $field
     * @return FieldsQueryBuilder
     */
    public function addField(string $field): FieldsQueryBuilder
    {
        if (!in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
        return $this;
    }

    public function buildQuery(): string
    {
        if (!$this->fields) {
            $this->fields = ['*'];
        }
        return $this->arrayToString($this->fields, ',');
    }
}
