<?php

namespace Rizalmovic\Core\Entities;

use Esensi\Model\Model;
use Esensi\Model\Contracts\ValidatingModelInterface;

class Setting extends Model implements ValidatingModelInterface
{
    protected $fillable = [
        'name', 'slug', 'value'
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

}