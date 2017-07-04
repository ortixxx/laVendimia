<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\plazo;
use App\regla;
use DB;

class configuracionController extends Controller
{
    public function guardar(Request $data){
    	$tasa = $data->input('tasa');
    	$enganche = $data->input('enganche');
    	$plazo = $data->input('plazo');

		if($tasa==null && $enganche==null && $plazo==null)
    		return Redirect::to('configuracion')->with('danger', $pass="No existen datos que modificar");

    	if($tasa!=null){
	    	$cambiaTasa = regla::find(1);
	        $cambiaTasa->valor=$tasa;
	        $cambiaTasa->save();
    	}
    	
    	if($enganche!=null){
    		$cambiaEnganche = regla::find(2);
	        $cambiaEnganche->valor=$enganche;
	        $cambiaEnganche->save();
    	}

    	if($plazo!=null){
    		$test = DB::table('plazo')
    			->where('meses', '=', $plazo)
            	->get();

            if($test->count()==0){
    			$nuevo = new plazo;
	        	$nuevo->meses=$plazo;
	        	$nuevo->save();
	        }else{
	        	return Redirect::to('configuracion')->with('danger', $pass="Plazo existente");
	        }	        
    	}
    	return Redirect::to('configuracion')->with('pass', $pass="Bien Hecho. La configuración ha sido registrada");
    }
}
