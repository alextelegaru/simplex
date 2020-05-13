<?php





namespace App\Http\Controllers;
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
    {
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
        $menu->fecha="12";
$menu->save();



        return view("test", compact("menu"));



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




    public function show($id)
    {

       // $usuario=User::where('name', '2')->get();;

    }









    public function update(Request $request, $id)
    {






//













    }








    public function create(Request $request)
    {





       // return view('juegos.create');
    }


public function store(Request $request){
    $bebidas=producto::where('tipo','bebida')->get(['nombre']);
    $menu=new menu();
    $menu->primeros=$request->primeros;
    $menu->segundos=$request->segundos;
    $menu->postres=$request->postres;
    $menu->bebidas=$this->getNames($bebidas);
    $menu->precio=$request->precio;
    $menu->fecha=$request->fecha;
$menu->save();


    return response()->json(['success'=>'Menu creado.']);
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
