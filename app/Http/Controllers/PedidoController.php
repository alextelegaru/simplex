<?php





namespace App\Http\Controllers;
USE Illuminate\Support\Carbon;
use App\producto;
use App\menu;
use App\pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Mail;
use \ForceUTF8\Encoding;
use League\CommonMark\Block\Element\Document;
use Pedidos;

class PedidoController extends Controller
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



public function getPedidos(){







        $pedidos=pedido::all();

        return response()->json($pedidos);






}




public function getCoste($id){


$pedido=pedido::find($id);
        return response()->json($pedido->precio);
}









public function cobrar(Request $request,$id){


    $pedido=pedido::where('_id' , '=' ,$id)->first();
$pedido->estado=null;
$pedido->save();
    return response()->json(['success'=>'Pedido Cobrado ' ]);

}





    public function index()
    {





        /*
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


        return view("pedido.pedidos");



    }



/*
    public function search(Request $request) {
        $text = $request->input('text');
        $tipo = $request->input('tipo');

        $productos = producto::where('tipo',$tipo)->get(['nombre']);
        $datos = $this->getNames($productos);
        sort($datos);
        return response()->json($datos);
       // return view("text", compact("x"));
    }
*/



    public function show($fecha)
    {
/*
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



    return view("menu.crearmenu", compact("menu",'fecha'));*/









    }






    public function imprimir($id,$pago,$cambio,$nombre){

        $fecha = Carbon::now();
            $pedido=pedido::where('_id' , '=' ,$id)->first();


       // $pdf = \PDF::loadView('imprimir',compact('pedido'));
        //redirect( $pdf->download('imprimir.pdf')) ;


/*
        $pdf =\PDF::loadView('imprimir', compact('post'));

        $path = public_path('app/public');
        $fileName =  'hola' . '.' . 'pdf' ;
        $pdf->save($path . '/' . $fileName);
        return $pdf->download($fileName);*/
        $pdf = \PDF::loadView('imprimir', compact('pedido','pago','cambio','nombre','fecha'));

       return  $pdf->download('imprimir.pdf');
        //return response()->json(["success"=>$pdf->download('invoice.pdf')]);
    }










public function confirmar(Request $request,$id){



    $pedido = pedido::where('_id' , '=' ,$id)->first();
  $pedido->estado = true;
  $pedido->save();

    return response()->json("Pedido confirmado con exito.");
}



//public function modificar(Request $request,$fecha,$nombre) {

    public function modificar(Request $request,$id) {



        if( Auth::user()->rol=="admin" ||Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera" ){





        $hoy = Carbon::now();
    $hoy = $hoy->format('Y-m-d');

   // $pedido=pedido::where('fecha' , '=' ,$fecha)->where('nombre' , '=' ,$nombre)->first();
   $pedido=pedido::where('_id' , '=' ,$id)->first();
   $menu=menu::where('fecha' , '=' ,$hoy)->first();





   if($pedido!=null){

    if($menu!=null){



        $menu=menu::where('fecha',$hoy)->get();

        $primeros=$menu[0]->primeros;
        $segundos=$menu[0]->segundos;
        $postres=$menu[0]->postres;
        $bebidas=$menu[0]->bebidas;
        $precio=$menu[0]->precio;
        $fecha=$menu[0]->fecha;



       // $pedido=pedido::where('nMesa' , '=' ,$mesa)->where('nombre' , '=' ,$nombre)->first();
        $productos=Producto::all();


        $limite=count($productos);

        $productosId=[];
        $productosNombre=[];
        $productosPrecio=[];




        for($i=0;$i<$limite;$i++){

                    $productosNombre[]=$productos[$i]['nombre'];
                    $productosId[]=$productos[$i]['id'];
                    $productosPrecio[]=$productos[$i]['precio'];
        }













                return view("pedido.modificarPedido",compact('pedido','primeros','segundos','postres','precio','fecha','bebidas','productosId','productosNombre','productosPrecio'));














   }

return view('errorMenu');

}

return view('errorPedido');

}
return view('home');

}









    public function actualizar(Request $request,$id)
    {

       // $hoy = $request->fecha;

       // $pedido=pedido::where('fecha' , '=' ,$request->fecha)->where('nMesa' , '=' ,$request->mesa)->where('nombre' , '=' ,$request->nombre)->first();

      // $pedido=pedido::where('fecha' , '=' ,$request->fecha)->where('nombre' , '=' ,$request->nombre)->first();
      $pedido=pedido::where('_id' , '=' ,$id)->first();


    $datosPedido=$request->pedido;

$limite=count($datosPedido);
$error=null;
for( $i=0;$i<$limite;$i++){

        if (strpos($datosPedido[$i], 'vacio') !== false) {
            $error="1 Menu incompleto.";
        }

        if (strpos($datosPedido[$i], 'Vacio') !== false) {
            $error="2 Pedido vacio.";
        }



}

if($request->nombre==null || $this->soloLetras($request->nombre)==false){
    $error="3 Nombre incorrecto";
}



if($request->mesa==null ){
    $error="4 NºMesa incorrecto";
}




if($request->email!=null){

    if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
        $error="5 Correo incorrecto";
      }

}






if($error==null){





    $datosPedidoLimpios=[];
    $productos=[];
    for($i=0;$i<count($datosPedido);$i++){
        if (strpos($datosPedido[$i], 'Menu') !== false) {
            $dfdf="";
        }else{
            if (strpos($datosPedido[$i], 'Producto:') !== false){

                $productos[]=  trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Producto:'))),". €");

            }else{

                if (strpos($datosPedido[$i], 'Primero:') !== false){
                    $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Primero:'))),". €");


                }else{

                    if (strpos($datosPedido[$i], 'Segundo:') !== false){
                        $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Segundo:'))),". €");


                    }else{

                        if (strpos($datosPedido[$i], 'Postre:') !== false){
                            $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Postre:'))),". €");


                        }else{
                            if (strpos($datosPedido[$i], 'Bebida:') !== false){
                                $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Bebida:'))),". €");


                            }


                        }

                    }












                }









            }






        }
    }

//$pedido=new Pedido;

$pedido->nombre=$request->nombre;
$pedido->correo=$request->email;
$pedido->nMesa=$request->mesa;
$pedido->menu=$datosPedidoLimpios;
$pedido->productos=$productos;
$pedido->precio=$request->precio;
$pedido->estado=false;


$pedido->save();

$error="Pedido actualizado.";

    return response()->json(['success'=>$error]);










}else{
    return response()->json(['success'=>$error]);
}















    }








    public function create(Request $request)
    {

       if( Auth::user()->rol=="admin" ||Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera" ){


        $hoy = Carbon::now();
$hoy = $hoy->format('Y-m-d');


if (menu::where('fecha','=',$hoy)->exists()) {

    $menu=menu::where('fecha',$hoy)->get();

    $primeros=$menu[0]->primeros;
    $segundos=$menu[0]->segundos;
    $postres=$menu[0]->postres;
    $bebidas=$menu[0]->bebidas;
    $precio=$menu[0]->precio;
    $fecha=$menu[0]->fecha;


    $productos=Producto::all();


    $limite=count($productos);

    $productosId=[];
    $productosNombre=[];
    $productosPrecio=[];




    for($i=0;$i<$limite;$i++){

                $productosNombre[]=$productos[$i]['nombre'];
                $productosId[]=$productos[$i]['id'];
                $productosPrecio[]=$productos[$i]['precio'];
    }


            return view("pedido.crearpedido",compact('menu','primeros','segundos','postres','precio','fecha','bebidas','productosId','productosNombre','productosPrecio'));
 }




        return view('errorMenu');










       }else{
        return view('home');
       }



    }





    function soloLetras( $string ) {
        return preg_match( '/[a-zA-Z]/', $string );
    }





public function store(Request $request){
    $hoy = Carbon::now();
    $hoy = $hoy->format('Y-m-d');


    $datosPedido=$request->pedido;

$limite=count($datosPedido);
$error=null;
for( $i=0;$i<$limite;$i++){

        if (strpos($datosPedido[$i], 'vacio') !== false) {
            $error="1 Menu incompleto.";
        }

        if (strpos($datosPedido[$i], 'Vacio') !== false) {
            $error="2 Pedido vacio.";
        }



}

if($request->nombre==null || $this->soloLetras($request->nombre)==false){
    $error="3 Nombre incorrecto";
}



if($request->mesa==null ){
    $error="4 NºMesa incorrecto";
}




if($request->email!=null){

    if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
        $error="5 Correo incorrecto";
      }

}






if($error==null){





    $datosPedidoLimpios=[];
    $productos=[];
    for($i=0;$i<count($datosPedido);$i++){
        if (strpos($datosPedido[$i], 'Menu') !== false) {
            $dfdf="";
        }else{
            if (strpos($datosPedido[$i], 'Producto:') !== false){

                $productos[]=  trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Producto:'))),". €");

            }else{

                if (strpos($datosPedido[$i], 'Primero:') !== false){
                    $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Primero:'))),". €");


                }else{

                    if (strpos($datosPedido[$i], 'Segundo:') !== false){
                        $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Segundo:'))),". €");


                    }else{

                        if (strpos($datosPedido[$i], 'Postre:') !== false){
                            $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Postre:'))),". €");


                        }else{
                            if (strpos($datosPedido[$i], 'Bebida:') !== false){
                                $datosPedidoLimpios[]=trim(preg_replace('/[0-9]+/', '',substr($datosPedido[$i],strlen('Bebida:'))),". €");


                            }


                        }

                    }












                }









            }






        }
    }

$pedido=new Pedido;
$pedido->nombre=$request->nombre;
$pedido->correo=$request->email;
$pedido->nMesa=$request->mesa;
$pedido->menu=$datosPedidoLimpios;
$pedido->productos=$productos;
$pedido->precio=$request->precio;
$pedido->estado=false;
$pedido->fecha=$hoy;

$pedido->save();

$error="Pedido realizado";

    return response()->json(['success'=>$error]);










}else{
    return response()->json(['success'=>$error]);
}









}








    public function precio(Request $request)
    {

        $producto=producto::where('nombre','=',$request->id)->get();

       $producto=producto::find($producto[0]->id);
       $precio=$producto->precio;

        return response()->json(['success'=>$precio]);
    }




    public function destroy($id)
    {
        $pedido=pedido::find($id);
       // $pedido->delete();

        return response()->json(['success'=>"Pedido eliminado con exito."]);



    }


}
