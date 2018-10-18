<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Simular;
use Illuminate\Support\Facades\Redirect;
use manantial\Http\Requests\SimularFormRequest;
use DB;

class SimuladorController extends Controller
{
    public function __construct(){
      
    }
    public function index(Request $request)
    {
      $simulacros = DB::select("select * from simulador");
      return view('simulador.gestionar.index', ["simulacros" => $simulacros]);
      /*if($request){
        $query = trim($request->get('searchText'));
        $simulacros = DB::table('simulador')->where('cuotas','LIKE','%'.$query.'%');
        return view('simulador.gestionar.index', ["simulador" => $simulacros, "searchText" => $query]);
      }*/
    }

    public function crear()
    {
      return view("simulador.gestionar.create");
    }
    public function almacenar(SimularFormRequest $request)
    {
      $simulador = new Simular();
      $simulador->montoMin = $request->get('montoMin');
      $simulador->save();//Guarda el objeto en la base de datos
      return Redirect::to('simulador/gestionar');
    }
    public function mostrar($id)
    {
      return view("simulador.gestionar.mostrar", ["simulador" => Simular::findOrFail($id)]);
    }
    public function editar($id)
    {
      return view("simulador.gestionar.editar", ["simulador" => Simular::findOrFail($id)]);
    }
    public function actualizar(SimularFormRequest $request, $id){
      $simulador = Simular::findOrFail($id);
      $simulador->montoMin=$request->get('montoMin');
      $simulador->montoMax=$request->get('descripcion');
      $simulador->update();
      return Redirect::to('simulador/gestionar');
    }
    public function eliminar($id)
    {
      $simulador = Simular::findOrFail($id);
    }
    /*public function calcularPrestamo(){
      $monto = Input::get('monto');
      $cuotas = Input::get('inputCuotas');
      $mesGracia = Input::get('checkMesDeGracia');

      return view('Simular', ['monto' => $monto, 'cuotas' => $cuotas, 'mesGracia' => $mesGracia]);
    }*/
}
