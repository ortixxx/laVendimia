@extends('main')
@section('content')	
	@if(Session::get('danger'))
	<div class="alert alert-danger">
		{{Session::get('danger')}}
	</div>
	@endif
	<form action="{{url('/guardarCliente')}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
	<div class="panel panel-primary">
		<div class="panel-heading">Registro de Clientes</div>
		<div class="panel-body">
			<div class="right">
				<label for="id">Clave: {{$numero->count()+1}}</label>
			</div>
			<br>
			<div class="col-md-4">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" name="nombre" maxlength="100" required>
				</div>

				<div class="form-group">
					<label for="a_paterno">Apellido Paterno</label>
					<input type="text" class="form-control" name="a_paterno" maxlength="50" required>
				</div>

				<div class="form-group">
					<label for="a_materno">Apellido Materno</label>
					<input type="text" class="form-control" name="a_materno" maxlength="50">
				</div>

				<div class="form-group">
					<label for="rfc">RFC</label>
					<input type="text" class="form-control" name="rfc" minlength="12" maxlength="13" id="rfcStr" onchange="validaRfc()" required>
				</div>
			</div>
		</div>
	</div>	
	<div class="right">
		<a class="btn btn-danger" onclick="exitAlert()">Cancelar</a>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</div>
	</form>
	<script>
		function validaRfc() {
			var rfcStr = document.getElementById('rfcStr').value;
			var strCorrecta;
			strCorrecta = rfcStr;	
			if (rfcStr.length == 12){
			var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
			}else{
			var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
			}
			var validRfc=new RegExp(valid);
			var matchArray=strCorrecta.match(validRfc);
			if (matchArray==null) {
				alert('Cadena incorrectas');

				return false;
			}
			else
			{
				alert('Cadena correcta:' + strCorrecta);
				return true;
			}	
		}

		function exitAlert(){
			if(confirm('Desea salir de la pantalla actual?')) {
				window.location = "{{ url('/clientes')}}";
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