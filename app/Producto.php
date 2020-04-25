<?php

namespace App;

use Illuminate\Support\Collection as Collection;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class Producto extends Eloquent
{
    protected $fillable = [
        'name', 'email'
    ];
}
