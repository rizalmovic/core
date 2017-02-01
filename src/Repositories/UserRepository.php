<?php

namespace Rizalmovic\Core\Repositories;

use Illuminate\Support\MessageBag;
use Rizalmovic\Core\Contracts\UserInterface;
use Rizalmovic\Core\Entities\User;
use Hash;
use Auth;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * @return array | null
     */
    public function current()
    {
        if($user = Auth::user()){
            return $user->toArray();
        }

        return null;
    }

    /**
     * @param $username
     * @return bool
     */
    public function findByUsername($username)
    {
        if($user = $this->model->where('username', $username)->first()) {
            return $user->toArray();
        }

        else return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public function findByEmail($email)
    {
        if($user = $this->model->where('email', $email)->first()) {
            return $user->toArray();
        }

        else return false;
    }


    public function updatePassword($user, $data)
    {
        if( Hash::check($data['password'], $user->getAuthPassword()) ) {
            if( $data['password_new'] == $data['password_new_confirmation']) {
                $user->password = Hash::make($data['password_new']);
                return $user->save();
            } else {
                return new MessageBag('Password & password confirmation is not matched.');
            }
        } else {
            return new MessageBag('Password not matched.');
        }
    }
}
