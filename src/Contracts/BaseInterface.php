<?php

namespace Rizalmovic\Core\Contracts;

interface BaseInterface
{
    public function find($id);

    public function add($data);

    public function update($data, $id);

    public function delete($id);

    public function orderBy($field, $type);

    public function with($relation);

    public function limit($number);

    public function paginate();

    public function all();
}
