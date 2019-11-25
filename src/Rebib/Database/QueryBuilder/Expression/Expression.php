<?php
namespace Rebib\Database\QueryBuilder\Expression;
abstract class Expression
{
      /**
     *
     * @var array
     */
    protected $expression = [];

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->expression = [];
    }

}
