<?php

namespace App\Queries;

use App\Models\Journal;

class ReportQuery extends BaseQuery
{
    protected $requestFilter = [
        'date' => [
            'field' => 'date',
            'filter' => 'between'
        ],
        'store_id' => [
            'field' => 'store_id',
            'filter' => '='
        ],
        'limit' => [
            'field' => 'limit',
            'filter' => '='
        ]
    ];


    public function __construct(Journal $model)
    {
        parent::__construct($model);
    }

    public function applyFilters()
    {
        foreach( $this->requestFilter as $key => $item) {
            if ($filterValue = $this->getValue($key)) {
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