{{-- MODAL-DELETE --}}
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDeleteLabel">¿Está seguro que desea eliminar este registro?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Si elimina el Registro no podra recuperarlo mas adelante</p>
			</div>
			<div class="modal-footer">
				<form action="" id="delete-r" method="POST">
					{{csrf_field()}}
					{{method_field('delete')}}
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button name="boton" class="btn btn-primary">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- /MODAL-DELETE --}}
{{-- MODAL-MODIFY --}}
<div class="modal fade" id="modalModify" tabindex="-1" role="dialog" aria-labelledby="modalModifyLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalModifyLabel">Modificar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<button class="active">Responsable</button><button class="active">Equipo</button>
				<div id="persona">
					<form action="" id="modify" method="POST">
						{{csrf_field()}}
						{{method_field('PATCH')}}
						<label for="identity">Cedula:</label>
						<input type="number" class="form-control" name="identity" id="identity" disabled="" placeholder="Cedula">
						<label for="first_name">Nombre:</label>
						<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nombre">
						<label for="last_name">Apellido:</label>
						<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido">
						<label for="phone">Telefono:</label>
						<input type="number" class="form-control" name="phone" id="phone" placeholder="Telefono">
					</div>
					{{-- articulo --}}
					<div id="articulo" style="display: none;">

						<label for="type">Tipo de Articulo:</label>
						<input type="text" class="form-control" id="type" disabled="">
						<div id="article">
							<label for="serial">Serial:</label>
							<input type="text" class="form-control" name="serial" disabled="" id="serial">
							<label for="model">Modelo:</label>
							<input type="text" class="form-control" name="model" id="model">
							<label for="brand">Marca:</label>
							<input type="text" class="form-control" name="brand" id="brand">
							<label for="observation">Observacion:</label>
							<input type="text" class="form-control" name="observation" id="observation">
							<div id="monitor-up" style="display:none;">
								<label for="inche">Pulgadas:</label>
								<input type="text" class="form-control" name="inche" id="inche">
							</div><br>
							<label for="department">Departamento:</label>
							<select name="department" id="department-up">
								<option value="" >Seleccione</option>
								@forelse($departments as $departamento)
								<option value="{{$departamento->id}}">{{$departamento->department}}</option>
								@empty
								@endforelse
								<option value="nuevo">Nuevo</option>
							</select>
							<input type="text" class="form-control" name="departmento" id="new_departmento" style="display: none;" placeholder="Ingrese Departamento">
						</div>
						{{-- Monitor --}}
						{{-- CPU --}}
						<div id="cpu-up" style="display: none;">
							<input type="hidden" class="form-control" name="cpu" id="cpu" disabled="" value="active">
							<label for="ram">Memoria Ram:</label>
							<input type="number" class="form-control" name="ram" id="ram">
							<label for="processor">Procesador:</label>
							<input type="number" class="form-control" name="processor" id="processor">
							<label for="so">S.O.:</label>
							<select name="so">
								<option value="" id="so">Seleccione</option>
								<option value="Windows">Windows</option>
								<option value="Linux">Linux</option>
								<option value="Mac">Mac</option>
							</select>
							<label for="memory_video">Memoria Video:</label>
							<input type="number" class="form-control" name="memory_video" id="memory_video">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="modify_report" value="Persona" id="boton-editar">Modificar</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
{{-- /MODAL-MODIFY --}}

