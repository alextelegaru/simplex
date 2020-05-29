<?php





namespace App\Http\Controllers;
USE Illuminate\Support\Carbon;

use App\menu;
use App\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Mail;
use \ForceUTF8\Encoding;
class MenuController extends Controller
{












public function getNames($bruto){
    unset($x);
    $x=array();
    foreach ($bruto as $ele) {
        //$x[]=$ele['nombre'];
        //$x[]= iconv(mb_detect_encoding($ele['nombre'], mb_detect_order(), true), "UTF-8", $ele['nombre']);
        //$x[]= mb_convert_encoding($ele['nombre'], "UTF-8", "ISO-8859-1");
       // $x[]= iconv('UTF-8', 'UTF-8//IGNORE',$ele['nombre']);
        //$x[]=  iconv('UTF-8', 'UTF-8//TRANSLIT', $ele['nombre']); // or even
        //$x[]=  iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $ele['nombre']);




        $x[] = str_replace("\u00f3", "ó", $ele['nombre']);


    }
    return $x;

}


    public function index()
    {/*
        $primeros=producto::where('tipo','primero')->get(['nombre']);
        $segundos=producto::where('tipo','segundo')->get(['nombre']);
        $postres=producto::where('tipo','postre')->get(['nombre']);
        $bebidas=producto::where('tipo','bebida')->get(['nombre']);



        $menu=new menu();

        $menu->primeros=$this->getNames($primeros);
        $menu->segundos=$this->getNames($segundos);
        $menu->postres=$this->getNames($postres);
        $menu->bebidas=$this->getNames($bebidas);
        $menu->precio="12";
        $menu->fecha="12";*/
//$menu->save();


/*


$testigo=0;

      if (menu::where('fecha','=',$request->fecha)->exists()) {


        $menuAnterior = menu::where('fecha','=',$request->fecha )->get();
        $menuAnterior=menu::find($menuAnterior[0]->id);
        $menuAnterior->delete();
        $testigo=1;
     }




*/

$hoy = Carbon::now();
$hoy = $hoy->format('Y-m-d');




if (menu::where('fecha','=',$hoy)->exists()) {

    return redirect('menu/'.$hoy);
 }




        return view("menu.crearmenu",compact('hoy'));



    }




    public function search(Request $request) {
        $text = $request->input('text');
        $tipo = $request->input('tipo');

        $productos = producto::where('tipo',$tipo)->get(['nombre']);
        $datos = $this->getNames($productos);
        sort($datos);
        return response()->json($datos);
       // return view("text", compact("x"));
    }




    public function show($fecha)
    {

$fecha=$fecha;

if (menu::where('fecha','=',$fecha)->exists()) {

    $menu=menu::where('fecha',$fecha)->get();

    $primeros=$menu[0]->primeros;
    $segundos=$menu[0]->segundos;
    $postres=$menu[0]->postres;
    $precio=$menu[0]->precio;
    $fecha=$menu[0]->fecha;
            return view("menu.editarmenu",compact('menu','primeros','segundos','postres','precio','fecha'));

 }else{



    return view("menu.crearmenu", compact("menu",'fecha'));

 }







    }




public function edit($fecha) {


    return response()->json("HOLA");
}









    public function update(Request $request,$fecha)
    {
        //$menu=menu::where('fecha','=',$request->fecha)->get();








        $validator = \Validator::make($request->all(), [
            'precio' => 'bail|required|numeric',

        ]);






        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }






        $menu = menu::where('fecha' , '=' ,$request->fecha)->first();
       // $menu->estado = true;



        //$menuAnterior = menu::where('fecha','=',$request->fecha )->get();
        //$menuAnterior = menu::find($menuAnterior[0]->id);
        //$menuAnterior->delete();

        $bebidas=producto::where('tipo','bebida')->get(['nombre']);
        //$menu=new menu();
        $menu->primeros=$request->primeros;
        $menu->segundos=$request->segundos;
        $menu->postres=$request->postres;
        $menu->bebidas=$this->getNames($bebidas);
        $menu->precio=$request->precio;
        $menu->fecha=$request->fecha;
        $menu->save();











        return response()->json(['success'=>'Menu Modificado con exito']);
































       // $menu= menu::find($fecha);
       // $menu->precio=$request->precio;
       // $menu = menu::where('fecha',$request->fecha)->get();
       // $menu->delete();


/*

        $bebidas=producto::where('tipo','bebida')->get(['nombre']);
        $menu=new menu();
        $menu->primeros=$request->primeros;
        $menu->segundos=$request->segundos;
        $menu->postres=$request->postres;
        $menu->bebidas=$this->getNames($bebidas);

        $menu->fecha=$request->fecha;*/
       // $menu->save();






/*

        $menu = menu::where('fecha' , '=' , $fecha);
  $menu->precio = $request->precio;
  $menu->save();*/

      //  $menu->delete();

       // $menu=new Menu();
//$menu->primeros=$request->primeros;
//$menu->save();


return response()->json(['success'=>"Actualizado con exito"]);




//













    }








    public function create(Request $request)
    {



        return view("menu.crearmenu");


    }


public function store(Request $request){









    if($request->precio !=0 && $request->precio != null && is_numeric($request->precio)){


$testigo=0;

      if (menu::where('fecha','=',$request->fecha)->exists()) {


        $menuAnterior = menu::where('fecha','=',$request->fecha )->get();
        $menuAnterior=menu::find($menuAnterior[0]->id);
        $menuAnterior->delete();
        $testigo=1;
     }




    $bebidas=producto::where('tipo','bebida')->get(['nombre']);
    $menu=new menu();
    $menu->primeros=$request->primeros;
    $menu->segundos=$request->segundos;
    $menu->postres=$request->postres;
    $menu->bebidas=$this->getNames($bebidas);
    $menu->precio=$request->precio;
    $menu->fecha=$request->fecha;
$menu->save();

if($testigo==0)
{
    return response()->json(['success'=>'Creado con exito']);
}return response()->json(['success'=>'Editado con exito']);



    }





        return response()->json(['success'=>'Introduzca un precio valido.']);











}



    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();

        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }






























    public function destroy($id)
    {
        // delete

        //$user->delete();



    }


}
