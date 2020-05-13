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








    public function create(Request $request)
    {




        return view('nuevousuario');
       // return view('juegos.create');
    }






    public function store(Request $request)
    {
       // $datosFormulario=$request->all();


      // return $request->all();
/*
       if($request->hasFile('image')){
           $datosFormulario['image']=$request->file('image')->store('img','public');
       }

*/


       //juegos::insert($datosFormulario);

       //return response()->json($datosFormulario);

/*
$reglas = [
    'nombre' => 'bail|required|unique:juegos|max:40',
    'anio' => 'bail|required|numeric|min:1850|max:2100',
    'precio' => 'bail|required|numeric|min:0',
    'tipo_id' => 'bail|required',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'descripcion'=>'bail|required|min:10',
];
*//*
$mensajes = [
    'nombre.required' => 'El nombre es obligatorio',
    'unique' => 'Ya existe :attribute ',
    'nombre.max' => 'El nombre no puede superar los 40 caracteres',
    'anio.required' => 'El año de producción es obligatorio',
    'anio.min' => 'El año de producción debe ser posterior a 1850',
    'anio.max' => 'El año de producción debe ser anterior a 2100',
    'precio.required' => 'El coste de producción es obligatorio',
    'precio.min' => 'El coste de producción debe ser mayor que 0',
    'image.required' => 'La imagen es obligatoria',
    'image' => 'El archivo no es un tipo de imagen válido',
    'descripcion.required' => 'La descripcion es obligatoria',
    'descripcion.min' => 'La descripccion debe superar los 10 carateres.',
];
*/
/*$this->validate($request, $reglas, $mensajes);
*/
//return $request->all();

$user = new User;

$user->name = $request->name;

$user->email= $request->email;
$user->rol = $request->rol;
$user->password = \Hash::make($request->password);




// Juego::create($datosFormulario);





// Obtiene el nombre de la real de la imagen
//$juego->imagen = $request->imagen->getClientOriginalName();

//$nombre = $image->getClientOriginalName();


// Almacena el archivo en storage/app/public con el nombre $juego->imagen
//$request->file('imagen')->move('public',$nombre);
//$juego->image = $request->image->getClientOriginalName();

//$request->file('image')->storeAs('/public_html/storage/app/public/',$juego->image);

$user->save();






// Almacena el archivo en storage/app/public con el nombre $peli->imagen










//return view('juegos.index', compact('juegos'));

//alert()->success('Videojuego agregado con exito!',
//$juego->nombre)->persistent('Cerrar');

return back()->with('exito', 'Videojuego agregado con exito!');


    }






























    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        //$user->delete();


        Session::flash('success', 'Usuario eliminado con exito!');
        return Redirect::to('usuarios');
    }


}
