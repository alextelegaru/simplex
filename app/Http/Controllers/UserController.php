<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios=User::all();

        return view("usuarios", compact("usuarios"));
    }
}
