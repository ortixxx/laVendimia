<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\cliente;
use App\articulo;
use App\venta;

class indexController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function ventas(){
        $venta = DB::table('venta AS v')
            ->join('cliente AS c', 'c.id_cliente', '=', 'v.id_cliente')
            ->select('v.id_venta', 'v.id_cliente', 'v.total', 'v.fecha', 'v.estatus', 'c.nombre')
            ->get();

    	return view('ventas', compact('venta'));
    }

    public function clientes(){
        $cliente = cliente::all();
        return view('clientes', compact('cliente'));
    }

    public function articulos(){
        $articulo = articulo::all();
    	return view('articulos', compact('articulo'));
    }

    public function configuracion(){
    	return view('configuracion');
    }

    public function error(){
        return view('404');
    }
}
