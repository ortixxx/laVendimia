@extends('main')
@section('content')
	<form action="{{url('/guardarArticulo')}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
	<div class="panel panel-primary">
		<div class="panel-heading">Registro de Articulos</div>
		<div class="panel-body">
			<div class="right">
				<label for="id">Clave: {{$numero->count()+1}}</label>
			</div>
			<br>
			<div class="col-md-4">
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" class="form-control" name="descripcion" maxlength="200" required>
				</div>

				<div class="form-group">
					<label for="modelo">Modelo</label>
					<input type="text" class="form-control" name="modelo" maxlength="50">
				</div>

				<div class="form-group">
					<label for="precio">Precio</label>
					<input type="number" min="0.0" step="0.1" max="999999999999.99" lang="en-US" class="form-control" name="precio" required>
				</div>

				<div class="form-group">
					<label for="existencia">Existencia</label>
					<input type="number" min="0" max="999999999999" class="form-control" name="existencia" required>
				</div>
			</div>
		</div>
	</div>	
	<div class="right">
		<a href="{{url('/articulos')}}" class="btn btn-danger">Cancelar</a>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</div>
	</form>
@stop