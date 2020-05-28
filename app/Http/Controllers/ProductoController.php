<?php

namespace App\Http\Controllers;

use App\producto;
use Illuminate\Http\Request;
use Illuminate\Routing\SortedMiddleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Iterator\SortableIterator;

class ProductoController extends Controller
{


    public function index()
    {
        $productos=Producto::all();


$limite=count($productos);

$primeros=[];

$segundos=[];
$postres=[];
$bebidas=[];


$primerosIds=[];
$segundosIds=[];
$postresIds=[];
$bebidasIds=[];




for($i=0;$i<$limite;$i++){


    if($productos[$i]['tipo']=='primero'){
            $primeros[]=$productos[$i]['nombre'];
            $primerosIds[]=$productos[$i]['id'];
}
if($productos[$i]['tipo']=='segundo'){
            $segundos[]=$productos[$i]['nombre'];
            $segundosIds[]=$productos[$i]['id'];
}
if($productos[$i]['tipo']=='postre'){
            $postres[]=$productos[$i]['nombre'];
            $postresIds[]=$productos[$i]['id'];
}
if($productos[$i]['tipo']=='bebida'){
            $bebidas[]=$productos[$i]['nombre'];
            $bebidasIds[]=$productos[$i]['id'];
}



}




        return view('producto.productos',compact('primeros','segundos','postres','bebidas','primerosIds','segundosIds','postresIds','bebidasIds'));
    }


    public function update(Request $request,$fecha)
    {


    }








    public function create(Request $request)
    {


    }


public function store(Request $request){

    $producto=new Producto();
    $producto->nombre=$request->nombre;
    $producto->tipo=$request->tipo;
    $producto->precio=$request->precio;
    $producto->save();

    $id=producto::where('nombre',$request->nombre)->get(['id']);
    $mensaje="Producto creado con exito:".$id.":".$request->nombre;

    return response()->json(['success'=>$mensaje]);


}


































    public function destroy($id)
    {
        $producto=producto::find($id);
        $nombre=$producto->nombre;
        $producto->delete();


        return response()->json(['success'=>"Producto eliminado con exito: ".$nombre]);



    }


}
