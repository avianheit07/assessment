<?php

namespace App\Repositories;

use App\Services\Google\CloudStorage;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
	protected $model;

	public function getByIdentity($value, $slug, $with = [],  $select = ['*'])
    {
        return $this->model->where($slug, $value)
            ->with($with)
            ->first($select);
    }

    public function getById( $id, $with = [] )
	{
		$query = $this->getModel();

		if (!empty($with) && is_array($with)) {
			$query = $query->with($with);
		}

		return $this->model = $query->find($id);
	}

	public function getAll($with = [], $select = '*')
	{
		return $this->model->query()
			->with($with)
			->select($select)
			->get();
	}

	public function countAll()
	{
		return $this->model->count();
	}

	public function fill( $data )
	{
		$this->model->fill( $data );
		return $this;
	}

	public function firstOrNew( $data =[] )
	{
		$result = $this->model->firstOrNew( $data );
		$result->save();
		return $result;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
