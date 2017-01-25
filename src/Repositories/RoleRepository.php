<?php

namespace Rizalmovic\Core\Repositories;

use Rizalmovic\Core\Contracts\RoleInterface;
use Rizalmovic\Core\Entities\Role;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function __construct(Role $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}