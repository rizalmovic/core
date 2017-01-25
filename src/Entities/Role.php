<?php

namespace Rizalmovic\Core\Entities;

use Esensi\Model\Model;
use Esensi\Model\Contracts\ValidatingModelInterface;
use Rizalmovic\Core\Entities\User;

class Role extends Model implements ValidatingModelInterface
{
    protected $fillable = [
        'name', 'slug'
    ];

    protected $rules = [
        'name' => [ 'required'],
        'slug' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
    ];

    protected $rulesets = [

        'creating' => [
            'name' => [ 'required'],
            'slug' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
        ],

        'updating' => [
            'name' => [ 'required'],
            'slug' => [ 'min:3', 'alpha_dash', 'required', 'unique' ],
        ],
    ];

    protected $relationships = [
        'users' => ['belongsToMany', User::class, 'user_roles']
    ];

}