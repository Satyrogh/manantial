@extends ('layouts.admin')
@section ('contenido')
  <h3>Creación de un préstamo con cuotas, monto mínimo, monto máximo, gasto notarial, cantidad de cuotas y tasa de interés mensual</h3>
  <div class="row">
  	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
  		<h3>Listado de Préstamos <a href="prestamo/crear">Nuevo</a></h3>
  		@include('simulador.gestionar.search')
  	</div>
  </div>
  <div class="row">
  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  		<div class="table-responsive">
  			<table class="table table-striped table-bordered table-condensed table-hover">
  				<thead>
  					<th>Id</th>
  					<th>Tasa de interéss</th>
  					<th>Cuotas</th>
  					<th>Monto Mínimo</th>
  					<th>Monto Máximo</th>
  					<th>Notario</th>
  					<th>Opciones</th>
  				</thead>
  				@foreach ($simulacros as $simulacion)
  				<tr>
  					<td>{{ $simulacion->id }}</td>
  					<td>{{ $simulacion->tasa }}</td>
  					<td>{{ $simulacion->cuotas }}</td>
  					<td>{{ $simulacion->montoMin }}</td>
  					<td>{{ $simulacion->montoMax }}</td>
  					<td>{{ $simulacion->notario }}</td>
  					<td>
  						<a href=""><button class="btn btn-info">Editar</button></a>
  						<a href=""><button class="btn btn-danger">Eliminar</button></a>
  					</td>
  				</tr>
  				@endforeach
  			</table>
  		</div>
  		
  	</div>
  </div>
@endsection
@section ('titulo')
  <h2>Agrega un préstamo</h2>
@endsection