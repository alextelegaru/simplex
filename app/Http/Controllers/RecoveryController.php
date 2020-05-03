<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Mail;
use Illuminate\Support\Str;
use Hash;

class RecoveryController extends Controller
{


    public function sendEmail($user,$contraseña){
        $mensaje="hola";
        $to_name =$user[0]['name'];
        $to_email = $user[0]['email'];
        $mensaje="Hola ".$user[0]['name']." su nueva contraseña es:  ";
        $mensaje2=$contraseña;
        $data = array("mensaje" => $mensaje,"mensaje2" => $mensaje2);
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject('Recuperación Cuenta Simplex');$message->from($to_email,"Simplex");});

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
