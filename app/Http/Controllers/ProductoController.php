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





        if( Auth::user() ){


            if( Auth::user()->rol=="admin" ||Auth::user()->rol=="cocinero" ||Auth::user()->rol=="cocinera" ){






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




        }
        return redirect()->back();














    }


    public function update(Request $request,$fecha)
    {


    }




    function quitar_tildes($cadena) {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
        }











    public function actualizar(Request $request,$id)
    {

$precio=$request->precio;
$nombre=$this->quitar_tildes($request->nombre);
        if($precio!=null && $nombre!=null){



            if (ctype_alpha(str_replace(' ', '', $nombre)) === true) {

                if(is_numeric($precio))
                {
                    $producto=producto::find($id);
                    $producto->nombre=$nombre;
                    $producto->precio=$precio;
            $producto->save();
            return response()->json(['success'=>"Producto actualizado con exito."]);

                }else{
                    return response()->json(['success'=>"Campo precio incorrecto."]);
                }



             }else{
                return response()->json(['success'=>"Campo nombre incorrecto."]);
             }























        }else{
            return response()->json(['success'=>"Campos requeridos"]);
        }








    }

public function getPrecio($id){

    $precio=producto::where('_id','=',$id)->get(['precio']);

    return response()->json($precio[0]->precio);

}


public function getNombre($id){

    $precio=producto::where('_id','=',$id)->get(['nombre']);

    return response()->json($precio[0]->nombre);

}

    public function create(Request $request)
    {


    }





public function store(Request $request){



    //$producto=producto::where('nombre',$request->nombre)->get(['id']);







if(($request->precio!=null  || $request->precio=="") && $request->nombre!=null){

    $testcase=$request->nombre;
    $testcase = str_replace(" ","",$testcase);

    if (ctype_alpha($testcase)) {

        if(is_numeric($request->precio) )
        {


            $producto=producto::where('nombre' , 'like' ,$request->nombre)->first();
            if($producto==null){




                    $producto=new Producto();
                    $producto->nombre=$request->nombre;
                    $producto->tipo=$request->tipo;
                    $producto->precio=$request->precio;
                    $producto->save();

                    $id=producto::where('nombre',$request->nombre)->get(['id']);
                    $mensaje="Producto creado con exito:".$id.":".$request->nombre;

                    return response()->json(['success'=>$mensaje]);






                }else{
                    return response()->json(['success'=>"El nombre  del producto ya existe"]);

                }














        }else{
    return response()->json(['success'=>"Error precio incorrecto"]);
}









    }else{
        return response()->json(['success'=>"Error nombre incorrecto"]);

    }






}else{
    return response()->json(['success'=>"Campos Obligatorios"]);
}





















}


































    public function destroy($id)
    {
        $producto=producto::find($id);
        $nombre=$producto->nombre;
        $producto->delete();


        return response()->json(['success'=>"Producto eliminado con exito: ".$nombre]);



    }


}
