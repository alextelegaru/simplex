<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Mail;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Auth;
class RecoveryController extends Controller
{



public function index(){
    if( Auth::user() ){



             return view("contactanos");





     }
     return redirect()->back();

}





    public function sendEmail($user,$contraseña){
        $mensaje="hola";
        $to_name =$user[0]['name'];
        $to_email = $user[0]['email'];
        $mensaje="Hola ".$user[0]['name']." su nueva contraseña es:  ";
        $mensaje2=$contraseña;
        $data = array("mensaje" => $mensaje,"mensaje2" => $mensaje2);
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject('Recuperación Cuenta Simplex');$message->from($to_email,"Simplex");});

    }



    public function soporte(Request $request)
    {
        $correo=Auth::user()->email;

        $mensaje=$request->mensaje;
        $to_name =$request->mensaje;
        $to_email ="simplexsimplextest@gmail.com";
        $nombre=$request->nombre;
        $rol=$request->rol;

        $mensaje=$request->mensaje;
        $data = array("nombre" => $nombre,"rol" => $rol,"mensaje" => $mensaje,"correo"=>$correo);
        Mail::send('emails.soporte', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject('Incidencia Simplex');$message->from($to_email,"Simplex");});

        return response()->json(['success'=>"Incidencia enviada con exito al admin." ]);


    }




    public function recovery(Request $request)
    {
        $user = User::where('email',$request->email)->get();

        if(isset($user[0]['name'])){
           $contraseña=Str::random(8);
            $user[0]['password']=Hash::make($contraseña);
            $user[0]->save();
            $this->sendEmail($user,$contraseña);
            Session::flash('success', 'Se la ha enviado un correo con la nueva contraseña.');
        }else{

            Session::flash('reject', 'No hay ninguna cuenta asociada al correo.');
        }




        return Redirect::to('password/reset');



    }








}
