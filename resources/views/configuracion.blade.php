@extends('main')
@section('content')
@if(Session::get('pass'))
	<div class="alert alert-success">
		{{Session::get('pass')}}
	</div>
	@endif
	@if(Session::get('danger'))
	<div class="alert alert-danger">
		{{Session::get('danger')}}
	</div>
	@endif
	<form action="{{url('/guardarConfiguracion')}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
	<div class="panel panel-primary">
		<div class="panel-heading">Configuracion General</div>
		<div class="panel-body">
			<div class="col-md-4">
				<div class="form-group">
					<label for="tasa">Tasa financiamiento</label>
					<input type="number" min="0.0" max="999999999999.99" step="0.1" lang="en-US" class="form-control" name="tasa">
				</div>

				<div class="form-group">
					<label for="enganche">% Enganche</label>
					<input type="number" min="0" max="100" class="form-control" name="enganche">
				</div>

				<div class="form-group">
					<label for="plazo">Plazo Maximo</label>
					<input type="number" min="0" max="120" class="form-control" name="plazo">
				</div>
			</div>
		</div>
	</div>	
	<div class="right">
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</div>
	</form>
@stop