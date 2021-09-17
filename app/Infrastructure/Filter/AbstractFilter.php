<?php

namespace App\Infrastructure\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array $relations
     */
    protected $relations;

    /**
     * Filter constructor.
     *
     * @param Request $request
     * @param array $relations
     */
    public function __construct(Request $request, array $relations = [])
    {
        $this->request   = $request;
        $this->relations = $relations;
    }

    /**
     * @param array $relations
     */
    public function setRelations(array $relations): void
    {
        $this->relations = $relations;
    }

    /**
     * apply the filters
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $name => $value) {
            if (method_exists($this, $name)) {
                $value = is_array($value) ? $value : trim($value);
                $value ? $this->$name($value) : $this->$name();
            }
        }

        return $builder;
    }
}
