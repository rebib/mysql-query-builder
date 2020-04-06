<?php

namespace Rebib\Database\QueryBuilder\Builder\Query;

use Rebib\Database\QueryBuilder\Builder\Builder;

class GroupQueryBuilder extends Builder {

    /**
     *
     * @var array
     */
    private $groups = [];

    /**
     *
     * @param array $groups
     * @param bool $force
     * @return GroupQueryBuilder
     */
    public function setFields(array $groups, bool $force = false): GroupQueryBuilder
    {
        if ($force === true) {
            $this->groups = $groups;
        } else {
            foreach ($groups as $group) {
                $this->addGroup($group);
            }
        }
        return $this;
    }

    /**
     * @param string $group
     * @return GroupQueryBuilder
     */
    public function addGroup(string $group): GroupQueryBuilder
    {
        if (!in_array($group, $this->groups)) {
            $this->groups[] = $group;
        }
        return $this;
    }

    public function buildQuery(): string
    {
        if (!$this->groups) {
            return '';
        }
        return 'GROUP BY ' . $this->array2String($this->groups, ',');
    }

}
