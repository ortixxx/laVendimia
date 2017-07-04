<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\articulo;
use DB;

class articulosController extends Controller
{
    public function nuevoArticulo(){
    	$numero = $articulo = articulo::all();
    	return view('nuevoArticulo', compact('numero'));
    }

    public function guardar(Request $data){
    	$descripcion = $data->input('descripcion');
    	$modelo = $data->input('modelo');
    	$precio = $data->input('precio');
    	$existencia = $data->input('existencia');

	    $nuevo = new articulo;
	    $nuevo->descripcion=$descripcion;
	    $nuevo->modelo=$modelo;
	    $nuevo->precio=$precio;
	    $nuevo->existencia=$existencia;
	    $nuevo->save();

	    return Redirect::to('articulos')->with('pass', $pass="Bien Hecho. El Articulo ha sido registrado correctamente");
    }

    public function editar($id){
    	$articulo = DB::table('articulo')
    		->where('id_articulo', '=', $id)
    		->get();

        return view('editarArticulo', compact('articulo'));
    }

    public function guardarEdicion($id, Request $data){    	
        DB::table('articulo')
        ->where('id_articulo', '=', $id)
        ->update(['descripcion' => $data->input('descripcion'),
                  'modelo' => $data->input('modelo'),
                  'precio' => $data->input('precio'),
                  'existencia' => $data->input('existencia')]);

        return Redirect::to('articulos')->with('pass', $pass="Bien Hecho. El articulo ha sido editado correctamente");
    }
}
