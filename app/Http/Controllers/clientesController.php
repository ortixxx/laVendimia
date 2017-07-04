<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\cliente;
use DB;

class clientesController extends Controller
{
    public function nuevoCliente(){
    	$numero = $cliente = cliente::all();
    	return view('nuevoCliente', compact('numero'));
    }

    public function guardar(Request $data){
    	$nombre = $data->input('nombre');
    	$a_paterno = $data->input('a_paterno');
    	$a_materno = $data->input('a_materno');
    	$rfc = $data->input('rfc');

    	//Validar RFC y ya validado, cuestionar si existe

	    $nuevo = new cliente;
	    $nuevo->nombre=$nombre;
	    $nuevo->a_paterno=$a_paterno;
	    $nuevo->a_materno=$a_materno;
	    $nuevo->rfc=$rfc;
	    $nuevo->save();

	    return Redirect::to('clientes')->with('pass', $pass="Bien Hecho. El cliente ha sido registrado correctamente");
    }

    public function editar($id){
    	$cliente = DB::table('cliente')
    		->where('id_cliente', '=', $id)
    		->get();

        return view('editarCliente', compact('cliente'));
    }
    
    public function guardarEdicion($id, Request $data){
    	//Validar RFC
    	
        DB::table('cliente')
        ->where('id_cliente', '=', $id)
        ->update(['nombre' => $data->input('nombre'),
                  'a_paterno' => $data->input('a_paterno'),
                  'a_materno' => $data->input('a_materno'),
                  'rfc' => $data->input('rfc')]);

        return Redirect::to('clientes')->with('pass', $pass="Bien Hecho. El cliente ha sido editado correctamente");
    }
}
