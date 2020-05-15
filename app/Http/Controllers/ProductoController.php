<?php

namespace App\Http\Controllers;

use App\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
$ids=[];

for($i=0;$i<$limite;$i++){


    if($productos[$i]['tipo']=='primero'){
            $primeros[]=$productos[$i]['nombre'];
}
if($productos[$i]['tipo']=='segundo'){
            $segundos[]=$productos[$i]['nombre'];
}
if($productos[$i]['tipo']=='postre'){
            $postres[]=$productos[$i]['nombre'];
}
if($productos[$i]['tipo']=='bebida'){
            $bebidas[]=$productos[$i]['nombre'];
}



            $ids[]=$productos[$i]['id'];





}




        return view('productos',compact('primeros','segundos','postres','ids','bebidas'));
    }


    public function update(Request $request,$fecha)
    {


    }








    public function create(Request $request)
    {


    }


public function store(Request $request){

}


































    public function destroy($id)
    {
        $producto=producto::find($id);
        //$producto->delete();

        return response()->json(['success'=>'Producto Eliminado con exito']);



    }


}
