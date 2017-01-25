<?php

namespace Rizalmovic\Core\Repositories;

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

    public function find($id)
    {
        return $this->response($this->model->find($id));
    }

    public function add($data)
    {
        if(!isset($data['password']) || !$data['password']) {
            $data['password'] = \Hash::make(str_random(8));
        }

        $query = new $this->model($data);

        if($query->save()) {
            return $this->response($query);
        } else {
            return $this->response(false, $query->getErrors());
        }
    }

    public function update($data, $id)
    {
        $row = $this->model->find($id);
        if($row) {
            return $this->response( $row->update($data) );
        } else {
            return $this->response( false );
        }
    }

    public function delete($id)
    {
        $row = $this->model->find($id);

        if($row) {
            return $this->response( $row->delete() );
        } else {
            return $this->response( false );
        }
    }

    public function orderBy($field, $type)
    {
        $this->model = $this->model->orderBy($field, $type);
        return $this;
    }

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

    public function limit($number)
    {
        $this->model = $this->model->take($number);
        return $this;
    }

    public function paginate()
    {
        return $this->response( $this->model->paginate() );
    }

    public function all()
    {
        return $this->response( $this->model->get() );
    }

    public function response($data, $message = '')
    {
        $format = [
            'status' => 'OK',
            'result' => null,
            'message' => null
        ];

        if($this->start){
            $format['execution_time'] = microtime(true) - $this->start;
        }

        if($message){
            $format['message'] = $message;
        }

        $format['result'] = (is_object($data)) ? $data->toArray() : $data;

        return $format;
    }
}