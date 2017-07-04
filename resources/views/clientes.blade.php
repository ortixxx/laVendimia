@extends('main')
@section('content')
	@if(Session::get('pass'))
	<div class="alert alert-success">
		{{Session::get('pass')}}
	</div>
	@endif
	<div class="col-md-5">
		<h3>Clientes Registrados</h3>
	</div>
	<div class="right">
		<a href="{{ url('/nuevoCliente') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Nuevo Cliente</span></a>
	</div>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Clave Cliente</th>
				<th class="name_2">Nombre</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
				@forelse($cliente as $c)
				<tr>
					<td>{{$num=$c->id_cliente}}</td>
					<td>{{$c->nombre}} {{$c->a_paterno}} {{$c->a_materno}}</td>
					<td>
						<a href="{{url('/editarCliente')}}/{{$num}}" class="btn btn-success btn-s"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
					</td>
				</tr>
				@empty
				@endforelse
		</tbody>
	</table>	
@stop