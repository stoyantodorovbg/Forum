<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $builder;
    protected $filters = [];

    /**
     * ThreadFilters constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        $this->getFilters()
            ->filter(function ($filter) {
                return method_exists($this, $filter);
            })
            ->each(function ($filter, $value) {
                $this->$filter($value);
            });

        return $this->builder = $builder;
    }

    /**
     * @return static
     */
    public function getFilters()
    {
        return collect($this->request->only($this->filters))->flip();
    }
}