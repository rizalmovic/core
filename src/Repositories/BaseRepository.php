<?php

namespace Rizalmovic\Core\Repositories;

use Illuminate\Contracts\Support\MessageBag;
use Rizalmovic\Core\Contracts\BaseInterface;
use App;

class BaseRepository implements BaseInterface
{
    public $model;
    protected $start;

    public function __construct()
    {
        if(config('app.debug')){
            $this->start = microtime(true);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function find($id)
    {
        if($result = $this->model->find($id))
        {
            return $result->toArray();
        }

        return false;
    }

    /**
     * @param $data
     * @return boolean | \Illuminate\Support\MessageBag
     */
    public function add($data)
    {
        if(!isset($data['password']) || !$data['password']) {
            $data['password'] = \Hash::make(str_random(8));
        }

        $query = new $this->model($data);

        if($query->save()) {
            return $query->toArray();
        }

        return $query->getErrors();
    }

    /**
     * @param $data
     * @param $id
     * @return bool | \Illuminate\Support\MessageBag
     */
    public function update($data, $id)
    {

        if($row = $this->model->find($id)) {

            if($row->update($data)) {
                return $row->toArray();
            }

            return $row->getErrors();

        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if($row = $this->model->find($id))
        {
            return $row->delete();
        }

        return false;
    }

    /**
     * @param $field
     * @param $type
     * @return $this
     */
    public function orderBy($field, $type)
    {
        $this->model = $this->model->orderBy($field, $type);
        return $this;
    }

    /**
     * @param $relation
     * @return $this
     */
    public function with($relation)
    {
        if(is_array($relation)) {
            foreach($relation as $r) {
                $this->model = $this->model->with($r);
            }
        } else {
            $this->model = $this->model->with($relation);
        }

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function limit($number)
    {
        $this->model = $this->model->take($number);
        return $this;
    }

    /**
     * @return array
     */
    public function paginate()
    {
        return $this->paginate()->toArray();
    }

    /**
     * @return array
     */
    public function all()
    {
        if($result = $this->model->get())
        {
            return $result->toArray();
        }

        return [];
    }
}
