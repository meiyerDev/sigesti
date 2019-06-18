@include('layouts.header')
@include('layouts.navbar')

<div class="container my-5 pt-5">

	<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modalReportLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" >
					<h5 class="modal-title" id="modalReportLabel">Reporte Tecnico</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="reporteTecnico" method="POST">
					<div class="modal-body">
						{{csrf_field()}}
						{{method_field('PATCH')}}
						<input type="hidden" name="confirmed" value="1">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="maintenance">Tipo de Mantenimiento</label>
									<select name="maintenance" class="form-control" id="maintenance">
										<option value="">Seleccione</option>
										<option value="Preventivo">Preventivo</option>
										<option value="Correctivo">Correctivo</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="internet">Internet</label>
									<select name="internet" class="form-control" id="inter">
										<option value="">Seleccione</option>
										<option value="Instalacion">Instalacion</option>
										<option value="Configuracion">Configuracion</option>
										<option value="Monitoreo">Monitoreo</option>
									</select>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col">
								<div class="form-group">
									<label for="users">Users</label>
									<select name="users" class="form-control" id="usuarios">
										<option value="">Seleccione</option>
										<option value="Instalacion">Instalacion</option>
										<option value="Configuracion">Configuracion</option>
										<option value="Monitoreo">Monitoreo</option>
									</select>
								</div>
							</div>
							<div class="col" id="cart">
								<div class="form-group">
									<label for="cartucho">Cartuchos:</label>
									<select name="cartucho" class="form-control" id="cartucho">
										<option value="">Seleccione</option>
										<option value="Recarga">Recarga</option>
										<option value="Mantenimiento">Mantenimiento</option>
									</select>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col">
								<div class="form-group">
									<label for="description">Descripción del trabajo realizado:</label>
									<textarea name="description" id="description" class="form-control" cols="30" rows="4"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="boton" class="btn btn-primary" value="reporteTecnico">Guardar</button>
					</form>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	@if( session('succes') )
	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
		<i class="fas fa-check mr-2"></i>{{ session('succes') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if($errors->any())
	@foreach($errors->all() as $error)
	<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
		<i class="fas fa-info mr-2"></i> {{ $error }} 
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endforeach
	@endif

	<div class="row my-5">
		<div class="col">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h4>Solicitudes</h4>
				</div>
				<div class="card-body">
					<table class="table table-sm table-hover table-responsive">
						<caption>Listado de Equipos Asignados.</caption>
						<thead class="thead">
							<tr>
								<th scope="col">NRO</th>
								<th scope="col">TIPO</th>
								<th scope="col">MODELO</th>
								<th scope="col">MARCA</th>
								<th scope="col">SERIAL</th>
								<th scope="col">RESPONSABLE</th>
								<th scope="col">TELEFONO</th>
								<th scope="col">OBSERVACION</th>
								<th class="text-center" scope="col">ACCION</th>
							</tr>
						</thead>
						<tbody>
							@forelse($experts->request as $experto)
							<tr>
								<th scope="row">{{$i++}}</th>
								<td>{{$experto->article->type}}</td>
								<td>{{$experto->article->model}}</td>
								<td>{{ $experto->article->brand }}</td>
								<td>{{ $experto->article->serial }}</td>

								<td>{{ $experto->responsable->person->first_name }} {{ $experto->responsable->person->last_name }}</td>
								
								<td>@if($experto->responsable->person->phone){{$experto->responsable->person->phone}} @else No posee @endif</td>

								<td>{{$experto->observation}}</td>
								
								<td>
									<button class="btn btn-warning btn-sm reportar" data-toggle="modal" data-target="#modalReport" title="Reportar">
										<i class="fas fa-edit"></i>
									</button>
									<button class="btn btn-primary btn-sm" title="Reporte PDF" onclick="window.open('/report/reportarPDF/{{ $experto->article->id }}','reportar')">
										<i class="fas fa-file-pdf"></i>
									</button>
								</td>
								<td style="visibility: collapse;">{{$experto->id}}</td>
							</tr>
							@empty
							<h2>No tiene Equipos Asignados.</h2>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>

		@include('layouts.footer')