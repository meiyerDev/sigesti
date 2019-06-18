@include('layouts.header')
@include('layouts.navbar')

<br>

<div class="container my-5 pt-5">

	@include('layouts.info')

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
	<div id="error">
		
	</div>
	{{-- TABLA DE DATOS --}}
	<div class="card mt-5">
		<div class="card-header d-flex justify-content-between">
			<h4>Técnicos</h4>
			<div class="input-group col-md-8 col-lg-4">
				<div class="input-group-prepend" id="butaddon">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoTecnico">
						<i class="fas fa-plus mr-2"></i>Nuevo
					</button>
					<button class="btn btn-primary" id="butSearchPerson" type="button"><i class="fas fa-plus mr-2"></i>Buscar</button>
				</div>
				<input type="text" class="form-control " placeholder="Ingrese Cedula.." aria-label="Recipient's username" aria-describedby="butaddon" id="inputSearch">
			</div>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead class="thead">
					<tr>
						<th>Nro</th>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Teléfono</th>
						<th>Usuario</th>
						<th class="text-center">Acción</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse($experts as $experto)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $experto->person->identity }}</td>
						<td>{{ $experto->person->first_name }}</td>
						<td>{{ $experto->person->last_name }}</td>
						<td>@if($experto->person->phone){{ $experto->person->phone }} @else No posee @endif</td>
						<td>{{ $experto->user->user }}</td>
						<td class="text-center">
							<!-- Abre un modal con el input y sus datos precargados para ser editado -->
							<a href="#" class="edit-person btn btn-warning btn-sm" data-toggle="modal" data-target="#modalModifyTecnico">
								<i class="fas fa-edit"></i>
							</a>
							<!-- Debe abrir un modal para confirmar que se desea eliminar -->
							<a href="#" class="delete-person btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDeleteTecnico">
								<i class="fas fa-trash"></i>
							</a>

						</td>
						<td style="visibility: collapse;">{{ $experto->person->id }}</td>
					</tr>
					@empty
					<h2 class="my-3">No existen datos registrados</h2>
					@endforelse
				</tbody>
			</table>

		</div>
	</div>
	{{-- END-TABLA --}}

</div>

{{-- MODAL DE CREAR --}}
<div class="modal fade" id="modalNuevoTecnico" tabindex="-1" role="dialog" aria-labelledby="modalNuevoTecnicoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" >
				<h4 class="modal-title" id="modalNuevoTecnicoLabel">Registrar Técnico</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('expert.store') }}" method="POST">
				<div class="modal-body">
					{{ csrf_field() }}
					@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
						<i class="fas fa-info mr-2"></i>@foreach($errors->all() as $error) {{ $error }} @endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					<div class="form-row mb-3">
						<div class="col">
							<label for="identity">Cedula:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-id-card"></i></span>
								</div>
								<input type="number" class="form-control" maxlength="9" minlength="7" name="identity" value="{{old('identity')}}" id="identity" placeholder="Cedula">
							</div>
						</div>
					</div>

					<div class="form-row mb-3">
						<div class="col">
							<label for="first_name">Nombre:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" id="first_name" placeholder="Nombre" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
							</div>
						</div>
					</div>

					<div class="form-row mb-3">
						<div class="col">
							<label for="last_name">Apellido:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="Apellido" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-12 mb-2">
							<label for="user">Tipo de Usuario</label>
							<select value="{{old('user')}}" name="role" class="form-control form-control-lg">
								<option value="2">Técnico</option>
								<option value="3">Jefe Técnico</option>
							</select> 
						</div>
						<div class="col">
							{{--  <div class="form-row form-group{{ $errors->has('user') ? ' has-error' : '' }}"> --}}
								<label for="user">Usuario</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" value="{{old('user')}}" name="user" id="user" placeholder="Username" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col">
								<label for="user">Contraseña</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input id="password" type="password" class="form-control" placeholder="Contraseña" name="password">
								</div>
							</div>
						</div>

						{{-- <div class="form-row mb-3">
							<div class="col">
								<label for="password-confirm">Confirme contraseña</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input id="password-confirm" type="password" class="form-control" placeholder="Confirme Contraseña" name="password_confirmation" required>
								</div>
							</div>
						</div> --}}
						<div class="form-row mb-3">
							<div class="col">
								<label for="phone">Telefono:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="number" value="{{old('phone')}}" name="phone" id="phone" placeholder="Telefono" class="form-control" pattern="^[0-9]+" title="Ingrese solo numeros." maxlength="11">
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button name="boton" class="btn btn-primary btn-md">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{-- END-MODAL --}}

	{{-- MODAL DE EDITADO --}}
	<div class="modal fade" id="modalModifyTecnico" tabindex="-1" role="dialog" aria-labelledby="modalModifyTecnicoLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" >
					<h5 class="modal-title" id="modalModifyTecnicoLabel">Modificar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="modify" method="POST">
					<div class="modal-body">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}

						<div class="form-group">
							<label for="identity">Cedula:</label>
							<input class="form-control" type="number" name="identity" id="cedula" disabled>
						</div>
						<div class="form-group">
							<label for="first_name">Nombre:</label>
							<input class="form-control" type="text" name="first_name" id="nombre" placeholder="Nombre" pattern="^[a-zA-Záéíóúñ]+(?:\s?[a-zA-Záéíóúñ]\s?)+$">
						</div>
						<div class="form-group">
							<label for="last_name">Apellido:</label>
							<input class="form-control" type="text" name="last_name" id="apellido" placeholder="Apellido" pattern="^[a-zA-Záéíóúñ]+(?:\s?[a-zA-Záéíóúñ]\s?)+$">
						</div>
						<div class="form-group">
							<label for="phone">Telefono:</label>
							<input class="form-control" type="number" name="phone" id="telefono" placeholder="Telefono">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button name="boton" type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- MOdal de eliminar --}}
	<div class="modal fade" id="modalDeleteTecnico" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTecnicoLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" >
					<h5 class="modal-title" id="modalDeleteTecnicoLabel">¿Está seguro que desea eliminar éste técnico?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="POST" id="delete">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<div class="modal-body">
						<p class="lead text-center">Si elimina éste registro perderá todos sus datos sin poder recuperarlos.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="submit" name="boton" class="btn btn-danger">Eliminar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{-- END-MODAL --}}
	<div class="modal fade" id="modalInfoPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DE TÉCNICO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="bodyInfoReques">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
		</div>
	</div>

	@include('layouts.footer')