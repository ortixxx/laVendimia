@extends('main')
@section('content')	
	@if(Session::get('danger'))
	<div class="alert alert-danger">
		{{Session::get('danger')}}
	</div>
	@endif
	<form action="{{url('/continuarVenta')}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
	<div class="panel panel-primary">
		<div class="panel-heading">Registro de Ventas</div>
		<div class="panel-body">
			<div class="right">
				<label for="id">Clave: {{$ventas->count()+1}}</label>
			</div>
			<br>
			<div class="col-md-1 down_1">
				<span class="label label-primary">Cliente</span>
			</div>
			<div class="col-md-2">
				<select name="clientes" id="clientes" class="bigger" required>
					<option value="0" disabled selected>Seleccionar</option>
					@forelse($cliente as $c)
						<option value='{"id":{{$c->id_cliente}}, "rfc":"{{$c->rfc}}"}'>{{$c->id_cliente}} - {{$c->nombre}} {{$c->a_paterno}} {{$c->a_mateno}}</option>
					@empty
					@endforelse
	    		</select>
	    		<input type="hidden" name="id_cliente" id="id_cliente" value=""/>
	    		<script>
			    $(function() {
			        $('#clientes').select2();
			        $('#clientes').on('change', function() {
			            $('#value').val(this.value);
			            var obj = JSON.parse(this.value);
			            $('#rfc').val("RFC: "+obj.rfc);
			            $('#id_cliente').val(obj.id);
			        })
			    });
			    </script>
						
			</div>
			<div class="col-md-4">
				<input class="name_2" type="text" id="rfc" disabled>
			</div>
			<br>
			<br>
			<br>
			<div class="col-md-1 down">
				<span class="label label-primary">Articulo</span>
			</div>
			<div class="col-md-2">					
					<select name="articulo" id="articulo" class="bigger">
					<option value="0" disabled selected>Seleccionar</option>
						@forelse($articulo as $a)
							<option value='{"id":{{$a->id_articulo}}, "des":"{{$a->descripcion}}", "modelo":"{{$a->modelo}}", "precio":{{$a->precio}}, "existencia":{{$a->existencia}} }'>{{$a->descripcion}}</option>
						@empty
						@endforelse
					</select>
					<script>
				    $(function() {
				        $('#articulo').select2();
				    });
				    </script>			
			</div>
			<div class="col-md-1 down">
				<a href="#" id="mas" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<div class="col-md-12">
				<hr>
				<table class="table table-hover" id="cuenta">
					<thead>
						<tr>
							<th>Descripcion Articulo</th>
							<th>Modelo</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Importe</th>
						</tr>
					</thead>
					<tbody>						
						<tr>							
						</tr>
					</tbody>
				</table>				
				<hr>
				<div class="col-md-2 col-md-offset-8">
					<span class="label label-primary right">Enganche</span>
				</div>
				<div class="col-md-1">
					<input type="text" id="enganche" class="cent" disabled>
				</div>
				<br>
				<br>
				<div class="col-md-2 col-md-offset-8">
					<span class="label label-primary right">Bonificacion Enganche</span>
				</div>
				<div class="col-md-1">
					<input type="text" id="bonificacion" class="cent" disabled>
				</div>
				<br>
				<br>
				<div class="col-md-2 col-md-offset-8">
					<span class="label label-primary right">Total</span>
					<input type="hidden" name="totalContado" id="totalContado" value=""/>
					<input type="hidden" name="totalPlazo" id="totalPlazo" value=""/>
				</div>
				<div class="col-md-1">
					<input type="text" id="total" class="cent" disabled>
				</div>
			</div>			
		</div>
	</div>	
	<div class="right">		
		<a class="btn btn-danger" onclick="exitAlert()">Cancelar</a>
		<input type="hidden" name="lista" id="lista" value=""/>
		<input type="hidden" name="cant" id="cant" value=""/>
		<input type="submit" class="btn btn-success" value="Siguiente" onclick="lists()">
	</div>
	</form>
	<script>
		var rowCount = 0;
		var lista = [];
		var id = [];
		var cant = [];
		var enganche = 0;
		var bonificacion = 0;

		$('#mas').on('click', function() {
			var obj = JSON.parse(articulo.value);

			if(obj.id!=null){
				var html = '';
				var precio = obj.precio * (1 + (({{$tasa->first()->valor}} * {{$plazo}}) /100));
			    precio = Number(precio).toFixed(2);  
				html += '<tr><td>' + obj.des + '</td><td>' + obj.modelo + '</td><td><input id="number_' + rowCount + '" class="tiny" type="number" min="1" max="' + obj.existencia+ '" value="1" onclick="incrementValue(' + rowCount + ')" onkeypress="incrementValue(' + rowCount + ')"></td><td><input type="text" id="precio_' + rowCount + '" class="cent" value="' + precio + '" disabled></td><td><input type="text" id="importe_' + rowCount + '" class="cent" value="' + precio + '" disabled></td></tr>';

					//Borrar elemento lista.splice(row, 1);
					//Genera conflictos con el rowCount, se debe recrear toda la tabla para evitar problemas de identificacion
					    	
				rowCount++;
				lista.push(articulo.value);
				cant.push(1);
				id.push(obj.id);
				$('#cuenta tbody tr').last().after(html);

				totalFunction();
			}
		});

		function incrementValue(row){
			var value = parseInt(document.getElementById('number_'+row).value, 10);
			cant[row] = value;
			var precio = parseFloat(document.getElementById('precio_'+row).value, 10);
			value = isNaN(value) ? 0 : value;
			value = precio * value;
			value = Number(value).toFixed(2);			
			document.getElementById('importe_'+row).value = value;
			totalFunction();
		}

		function totalFunction(){
			var total = 0;
			var contado = 0;

			for (var i = 0; i < lista.length ; i++) {
				var obj = JSON.parse(lista[i]);
				var precio = obj.precio * (1 + (({{$tasa->first()->valor}} * {{$plazo}}) /100));
			    var value = parseInt(document.getElementById('number_'+i).value, 10);
			    precio = precio * value;
			    contado += obj.precio * value;
			    total += precio;
			}
			
			$('#totalContado').val(Number(contado).toFixed(2));

			enganche = ({{$enganche->first()->valor}}/100) * total;
			document.getElementById('enganche').value = Number(enganche).toFixed(2);

			bonificacion = enganche * (({{$tasa->first()->valor}} * {{$plazo}})/100);
			document.getElementById('bonificacion').value = Number(bonificacion).toFixed(2);

			$('#totalPlazo').val(Number(total).toFixed(2));

			total = total - enganche - bonificacion;
			document.getElementById('total').value = Number(total).toFixed(2);			
		}

		function lists(){
			$('#lista').val(id);
			$('#cant').val(cant);
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