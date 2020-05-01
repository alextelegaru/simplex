<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Session;
use Redirect;
class UserController extends Controller
{
    public function index()
    {
        $usuarios=User::all();

        return view("usuarios", compact("usuarios"));
    }
    public function show($id)
    {

       // $usuario=User::where('name', '2')->get();;
        $usuario=User::find($id);
        return view("usuario", compact("usuario"));
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->rol = $request->rol;
        if($request->password !=''){
            $user->password = \Hash::make($request->password);
        }



        $user->save();
        return Redirect::to('usuarios/'.$id);
    }






    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        //$user->delete();


        Session::flash('message', 'Usuario eliminado con exito!');
        return Redirect::to('usuarios');
    }


}
