<?php

namespace Rebib\Database\QueryBuilder\Builder\Query;

use Rebib\Database\QueryBuilder\Builder\Builder;

class FieldsQueryBuilder extends Builder {

    /**
     *
     * @var array
     */
    private $fields = [];

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
        return $this->array2String($this->fields, ',');
    }

}
