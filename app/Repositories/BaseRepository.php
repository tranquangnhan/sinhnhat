<?php

namespace App\Repositories;

use app\Repositories\BaseRepositoryInterface;

abstract class BaseRepository
//  implements BaseRepositoryInterface
{
    /**
     * The attributes prefix for each model.
     * 
     * @var string
     */
    protected string $prefix;

    /**
     * Init model
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected \Illuminate\Database\Eloquent\Model $_model;

    /**
     * BaseRepository constructor.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * 
     * @return class
     */
    public function getModel()
    {
        $className = $this->prefix;
        $dir = "App\\Models\\$className";
        $class = new $dir;
        return $class;
    }

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = $this->getModel();
    }

    /**
     * Get All
     * 
     * @return
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * Get one
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Create
     * 
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Update
     * 
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

}