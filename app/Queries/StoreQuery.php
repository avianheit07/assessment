<?php

namespace App\Queries;

use App\Models\Store;

class StoreQuery extends BaseQuery
{
    protected $requestFilter = [
        'user_id' => [
            'field'  => 'user_id',
            'filter' => '='
        ],
        'state'   => [
            'field'  => 'state',
            'filter' => 'like'
        ],
        'city'    => [
            'field'  => 'city',
            'filter' => 'like'
        ],
        'zipcode' => [
            'field'  => 'zipcode',
            'filter' => '='
        ],
    ];

    public function __construct(Store $model)
    {
        parent::__construct($model);
    }

    public function applyFilters()
    {
        foreach( $this->requestFilter as $key => $item) {
            if ($filterValue = $this->getValue($key)) {
                if ($key === 'user_id') {
                    $this->query->whereHas('users', function ($query) use ($filterValue) {
                        $query->where('user_id', $filterValue);
                    });
                } else {
                    $filterValue = $this->getValue($key);
                    $field       = $item['field'];
                    $filter      = $item['filter'];
                    $value       = ($filter === 'like') 
                        ? "%{$filterValue}%"
                        : $filterValue;

                    $this->query->where($field, $filter, $value);
                }
            }
        }
    }

    public function query($with = [])
    {
        $this->query = $this->model->query()
            ->with($with);

        if ($this->filters &&count($this->filters) > 0) {
            $this->applyFilters();
        }

        return $this;
    }
}