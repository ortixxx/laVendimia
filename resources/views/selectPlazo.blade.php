@extends('main')
@section('content')	
	@if(Session::get('danger'))
		<div class="alert alert-danger">
			{{Session::get('danger')}}
		</div>
	@endif
	<div class="panel panel-primary">
		<div class="panel-heading">Seleccion de plazo</div>
		<div class="panel-body">
			<div class="right">
				<label for="id">Clave: {{$ventas->count()+1}}</label>
			</div>
			<div class="table-responsive">
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Plazp</th>
						<th>Abonos Mensuales</th>
						<th>Total</th>
						<th>Ud. se ahorra</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<form>
					@forelse($plazos as $p)					
					<tr>
						<td>{{$p->meses}} ABONOS DE</td>
						<td>$ {{$totalFinal = number_format((($totalContado * (1 + (($tasa->first()->valor * $p->meses) /100)))/$p->meses), 2, '.', '')}}</td>
						<td>TOTAL A PAGAR $ {{$semi = $totalFinal * $p->meses}}</td>
						@if(number_format(($totalPlazo - $semi), 2, '.', '')<1)
						<td>SE AHORRA $ 0.00</td>
						@else
						<td>SE AHORRA $ {{number_format(($totalPlazo - $semi), 2, '.', '')}}</td>
						@endif
						<td>
							<input type="radio" name="radios" id="radio_{{$p->id_plazo}}" onclick="selectId({{$p->id_plazo}})"/>
						</td>												
					</tr>
					@empty
					@endforelse
				</form>
				</tbody>				
			</table>
			</div>
		</div>
	</div>
	<form action="{{url('/guardarVenta')}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
	<input type="hidden" name="radio" id="radio" value=""/>
	<input type="hidden" name="id_cliente" id="id_cliente" value=""/>
	<input type="hidden" name="totalContado" id="totalContado" value=""/>

	<!-- Faltan 2 inputs hidden para pasar lista y cantidad, asi poder borrar existencia -->
	<!-- Por alguna razon, al hacer  $('#lista').val({{$lista}}); javaScript solo manda el primer valor-->
	
	<div class="right">		
		<a class="btn btn-danger" onclick="exitAlert()">Cancelar</a>
		<input type="submit" class="btn btn-success" value="Guardar">
	</div>
	</form>
	<script>
		$('#id_cliente').val({{$id_cliente}});
		$('#totalContado').val({{$totalContado}});
		$('#radio').val(0);

		function selectId(id){
			$('#radio').val(id);
		}

		function exitAlert(){
			if(confirm('Desea salir de la pantalla actual?')) {
				window.location = "{{ url('/ventas')}}";
				return true;
			} else {
				if(window.event) {
					window.event.returnValue = false;
		      	} else {
		      		e.preventDefault();
		      	}
		      	return false;
		    }
		}
	</script>
@stop