<?php

namespace App;
use App\producto;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class menu extends Eloquent
{




    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'primeros','segundos','postres','bebidas','precio','fecha'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'primeros'=> 'array',
        'segundos'=> 'array',
        'postres'=> 'array',
        'bebidas'=> 'array',
    ];
}





