<?php

namespace Rizalmovic\Core\Entities;

use Illuminate\Notifications\Notifiable;
use Rizalmovic\Core\Entities\Role;
use Rizalmovic\Stores\Entities\Store;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Esensi\Model\Model;
use Esensi\Model\Contracts\ValidatingModelInterface;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    ValidatingModelInterface
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    protected $rules = [
        'name' => [ 'required'],
        'username' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
        'email' => [ 'min:3', 'email', 'required', 'unique' ],
    ];

    protected $rulesets = [

        'creating' => [
            'name' => [ 'required'],
            'username' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
            'email' => [ 'min:3', 'email', 'required', 'unique' ]
        ],

        'updating' => [
            'name' => [ 'required'],
            'username' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
            'email' => [ 'min:3', 'email', 'required', 'unique' ]
        ],
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $relationships = [
        'roles' => ['belongsToMany', Role::class, 'user_roles'],
        'store' => ['hasOne', Store::class, 'owner_id']
    ];

    public function isAdmin()
    {
        $isAdmin = false;

        foreach($this->roles as $role) {
            if($role->slug == 'admin') {
                $isAdmin = true;
                break;
            }
        }

        return $isAdmin;
    }

    public function hasRole($slug)
    {
        $hasRole = false;

        foreach($this->roles as $role) {
            if($role->slug == $slug) {
                $hasRole = true;
                break;
            }
        }

        return $hasRole;
    }

    public function hasAnyRole($slugs = array())
    {
        $hasRole = false;

        foreach($this->roles as $role) {
            if(in_array($role->slug, $slugs)) {
                $hasRole = true;
                break;
            }
        }

        return $hasRole;
    }
}
