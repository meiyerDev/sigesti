@include('layouts.header')
@include('layouts.navbar')

<br>
<div class="container mt-5 pt-5">

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

	<div class="row my-5">
		<div class="col">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h4>Departamentos</h4>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						<i class="fas fa-plus mr-2"></i>Agregar
					</button>
				</div>
				<div class="card-body">

					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th>Nro</th>
								<th>DEPARTAMENTO</th>
								<th>DIRECTOR</th>
								<th>TELEFONO</th>
								<th>CREADO</th>
								<th>ACCION</th>
							</tr>
						</thead>
						<tbody>
							@forelse($departments as $departamento)
							<tr>
								<td>{{ $departamento->id }}</td>
								<td>{{ $departamento->department }}</td>
								<td>{{ $departamento->firstname_director }} {{ $departamento->lastname_director }}</td>
								<td>{{ $departamento->phone }}</td>
								<td>{{ $departamento->created_at }}</td>
								<td>
									<!-- Abre un modal con el input y sus datos precargados para ser editado -->
									<button type="button" class="btn btn-warning btn-sm edit-department" data-toggle="modal" data-target="#editmodal" data-id="{{ $departamento->id }}">
										<i class="fas fa-edit"></i>
									</button>
									<!-- Debe abrir un modal para confirmar que se desea eliminar -->
									<button type="button" class="btn btn-danger btn-sm delete-department" data-toggle="modal" data-target="#delmodal" data-id="{{ $departamento->id }}">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
							@empty
							<div class="alert alert-warning p-0">
								<h4 class="text-center my-4">No existen datos registrados</h4>
							</div>
							@endforelse
						</tbody>
					</table>

					<div class="d-flex justify-content-center mt-5">
						{{ $departments->links() }}
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

<!-- Modal eliminar -->
<div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar departamento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" id="delete" method="post">
				@csrf
				@method('DELETE')
				<div class="modal-body">
					<p class="lead text-center">¿Seguro que desea eliminar éste departamento?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar departamento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('department.store') }}" method="POST">
				<div class="modal-body">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="department">Departamento:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-building"></i></div>
							<input type="text" class="form-control" autofocus name="department" value="{{old('department')}}" placeholder="Ingrese Departamento">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Nombre del Director:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-user"></i></div>
							<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="firstname_director" value="{{old('firstname_director')}}" placeholder="Ingrese Nombre del Director de Departamento">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Apellido del Director:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-user"></i></div>
							<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="lastname_director" value="{{old('lastname_director')}}" placeholder="Ingrese Apellido del Director de Departamento">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Teléfono de Departamento:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-phone"></i></div>
							<input type="text" class="form-control"  name="phone" value="{{old('phone')}}" pattern="^[0-9]+" title="Ingrese solo numeros." placeholder="Ingrese numero de Teléfono del Departamento">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="sybmit" name="boton" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal editar -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar departamento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('department.store') }}" id="modify" method="POST">
				<div class="modal-body">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}

					<div class="form-group">
						<label for="department">Departamento:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-building"></i></div>
							<input type="text" class="form-control" name="department" id="department" placeholder="Ingrese Departamento" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Nombre del Director:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-user"></i></div>
							<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="firstname_director" id="primer" value="{{old('firstname_director')}}" placeholder="Ingrese Nombre del Director de Departamento">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Apellido del Director:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-user"></i></div>
							<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="lastname_director" id="segundo" value="{{old('lastname_director')}}" placeholder="Ingrese Apellido del Director de Departamento">
						</div>
					</div>
					<div class="form-group">
						<label for="department">Teléfono de Departamento:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fas fa-phone"></i></div>
							<input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" pattern="^[0-9]+" title="Ingrese solo numeros." placeholder="Ingrese numero de Teléfono del Departamento">
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" name="boton" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Editar</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	@include('layouts.footer')