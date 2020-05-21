<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class pedido extends Eloquent
{




    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nMesa','estado','productos','fecha','nombre','correo','precio','menu',
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
        'precio' => 'float',
        'menu'=> 'array',
        'productos'=> 'array',
    ];
}
