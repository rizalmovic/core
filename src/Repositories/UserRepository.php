<?php

namespace Rizalmovic\Core\Repositories;

use Rizalmovic\Core\Contracts\UserInterface;
use Rizalmovic\Core\Entities\User;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function findByUsername($username)
    {
        return $this->response( $this->model->where('username', $username)->first() );
    }

    public function findByEmail($email)
    {
        return $this->response( $this->model->where('email',$email)->first() );
    }
}