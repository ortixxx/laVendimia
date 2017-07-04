@extends('main')
@section('content')
	@if(Session::get('pass'))
		<div class="alert alert-success">
			{{Session::get('pass')}}
		</div>
	@endif
	<div class="col-md-5">
		<h3>Ventas Activas</h3>
	</div>
	<div class="right">
		<a href="{{ url('/nuevaVenta')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Nueva Venta</span></a>
	</div>
	
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Folio Venta</th>
				<th>Clave Cliente</th>
				<th class="name">Nombre</th>
				<th>Total</th>
				<th>Fecha</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>
				@forelse($venta as $v)
				<tr>
					<td>{{$num=$v->id_venta}}</td>
					<td>{{$v->id_cliente}}</td>
					<td>{{$v->nombre}}</td>
					<td>$ {{$v->total}}</td>
					<td>{{$v->fecha}}</td>
					@if($v->estatus==0)
						<td>Adeudo</td>
					@else
						<td>Pagado</td>
					@endif
				</tr>
				@empty
				@endforelse
		</tbody>
	</table>
@stop