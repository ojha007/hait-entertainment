<?php

namespace App\Abstracts;


use App\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{

    protected $model;

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        $record = $this->getById($id);
        $record->update($attributes);
        return $record;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNext(int $id)
    {
        return $this->model
            ->where('id', '>', $id)
            ->orderBy('id', 'ASC')
            ->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPrevious(int $id)
    {
        return $this->model
            ->where('id', '<', $id)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $oldAttributes
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate(array $oldAttributes, array $attributes)
    {
        return $this->model->updateOrcreate($oldAttributes, $attributes);
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getWith($id, ...$with)
    {
        return $this->model->with(...$with)->findOrFail($id);
    }

    public function findOneWhere($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function bulkCreate(array $attributes)
    {
        return $this->model->insert($attributes);
    }


}
