@extends('main')
@section('content')
	@if(Session::get('pass'))
	<div class="alert alert-success">
		{{Session::get('pass')}}
	</div>
	@endif
	<div class="col-md-5">
		<h3>Articulos Registrados</h3>
	</div>
	<div class="right">
		<a href="{{ url('/nuevoArticulo') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Nuevo Articulo</span></a>
	</div>
	
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Clave Articulo</th>
				<th class="name_2">Descripcion</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
				@forelse($articulo as $a)
				<tr>
					<td>{{$num=$a->id_articulo}}</td>
					<td>{{$a->descripcion}}</td>
					<td>
						<a href="{{url('/editarArticulo')}}/{{$num}}" class="btn btn-success btn-s"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
					</td>
				</tr>
				@empty
				@endforelse
		</tbody>
	</table>
@stop