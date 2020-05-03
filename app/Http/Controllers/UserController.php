<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Mail;

class UserController extends Controller
{
    public function index()
    {
        $usuarios=User::all();

        if(Auth::user()->rol=='admin'){
            $rol='admin';
            return view("usuarios", compact("usuarios"));

        }
        return view("error");
    }









    public function show($id)
    {

       // $usuario=User::where('name', '2')->get();;
        $usuario=User::find($id);
$rol="";
        if(Auth::user()->rol=='admin'){
            $rol='admin';


        }


        return view("usuario", compact("usuario","rol"));
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













        return Redirect::to('usuario/'.$id);
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
