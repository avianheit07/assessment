<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class BaseQuery
{
    protected $perPage = 15;
    protected $page    = 1;

    protected $filters;
    protected $model;
    protected $query;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function applyFilters();
    abstract public function query();

    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    public function get($fields = '*')
    {
        return $this->query->get($fields);
    }

    public function paginate()
    {
        return $this->query->paginate($this->getLimit(), ['*'], 'page', $this->getPage());
    }

    public function getLimit()
    {
        return $this->filters['limit'] ?? $this->perPage;
    }

    public function getPage()
    {
        return $this->filters['page'] ?? $this->page;
    }

    public function select($fields)
    {
        $this->query->select($fields);

        return $this;
    }

    public function getValue($key)
    {
        return $this->filters[$key] ?? null;
    }
    /**
     * V2 for get value but using laravel Arr helper class
     *
     * @param [type] $key
     * @return mixed
     */
    public function getFilterValue($key)
    {
        return Arr::get($this->filters, $key, null);
    }

    public function with($param)
    {
        $this->query->with($param);

        return $this;
    }

    protected function keyExistsAndValid($key)
    {
        return isset($this->filters[$key]) && $this->filters[$key] != '';
    }
}