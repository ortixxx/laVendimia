<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\cliente;
use App\articulo;
use App\venta;
use App\regla;
use App\plazo;

class ventasController extends Controller
{
    public function nuevaVenta(){
    	$cliente = cliente::all();
    	$articulo = DB::table('articulo')
    		->where('existencia', '>', 0)
    		->get();
    	$ventas = venta::all();
    	$tasa = DB::table('regla')
    		->where('id_regla', '=', 1)
    		->get();
    	$enganche = DB::table('regla')
    		->where('id_regla', '=', 2)
    		->get();
    	$plazoMax = DB::table('plazo')
    		->orderBy('meses', 'desc')
	        ->take(1)
	        ->get();

	    $plazo = $plazoMax->first()->meses;

    	return view('nuevaVenta', compact('cliente', 'articulo', 'ventas', 'tasa', 'enganche', 'plazo'));
    }

    public function continuar(Request $data){
    	if($data->totalPlazo == 0)
    		return Redirect::to('nuevaVenta')->with('danger', $pass="Los datos ingresados no son correctos, favor de verificar");

    	$ventas = venta::all();
    	$id_cliente = $data->id_cliente;
    	$totalContado = $data->totalContado;
    	$totalPlazo = $data->totalPlazo;
    	$tasa = DB::table('regla')
    		->where('id_regla', '=', 1)
    		->get();
    	$plazos =  DB::table('plazo')
    		->orderBy('meses', 'asc')    		
	        ->get();

    	return view('selectPlazo', compact('ventas', 'id_cliente', 'totalContado', 'totalPlazo', 'tasa', 'plazos'));
    }

    public function guardar(Request $data){
    	if($data->radio==0)
    		return Redirect::to('nuevaVenta')->with('danger', $pass="Debe seleccionar un plazo para realizar el pago de su compra");

    	$plazo = DB::table('plazo')
    		->where('id_plazo', '=', $data->radio)	
	        ->get()
	        ->first();

	    $tasa = DB::table('regla')
    		->where('id_regla', '=', 1)
    		->get()
    		->first();

    	$totalContado = $data->input('totalContado');

	    $total = $totalContado * (1 + (($tasa->valor * $plazo->meses) /100));
	    $id_cliente = $data->input('id_cliente');

	    $nuevo = new venta;
	    $nuevo->id_cliente=$id_cliente;
	    $nuevo->total=$total;
	    $nuevo->fecha=date('Y-m-d H:i:s');
	    $nuevo->save();

	    return Redirect::to('ventas')->with('pass', $pass="Bien Hecho, Tu venta ha sido registrada correctamente");
    }
}
