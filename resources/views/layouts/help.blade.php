
<div class="modal fade" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="modalHelpLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHelpLabel">Seleccione un Problema</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<span class="text-secondary">Riesgo bajo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span class="text-warning">Riesgo medio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span class="text-danger">Riesgo alto</span>
				</div>
				<button class="btn btn-warning ml-4 mt-3 col-11" data-toggle="modal" data-target="#modalNoEncender">¿El Equipo no quiere encender?</button><br>
				<button class="btn btn-danger ml-4 mt-3 col-11" data-toggle="modal" data-target="#modalReinicia">¿El Equipo se reinicia?</button><br>
				<button class="btn btn-secondary ml-4 mt-3 col-11" data-toggle="modal" data-target="#modalNoInternet">¿No tiene acceso a Internet?</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<!-- NO QUIERE ENCENDER -->
<div class="modal fade" id="modalNoEncender" tabindex="-1" role="dialog" aria-labelledby="modalNoEncender" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalNoEncender">El Equipo no Enciende</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p>- Verifique si el <span class="text-danger">cable de corriente</span> esta conectado al <span class="text-danger">toma corriente</span>.</p>
				<p>- Verifique si el <span class="text-danger">regulador</span> de corriente esta <span class="text-danger">Encendido</span>.</p>
				<p class="text-warning">NOTA: "Si aun el equipo no enciende contacte al equipo de informática."</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- EL EQUIPO SE REINICIA -->
<div class="modal fade" id="modalReinicia" tabindex="-1" role="dialog" aria-labelledby="modalReinicia" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalReinicia">El Equipo se reinicia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p class="text-warning">CONTACTE INMEDIATAMENTE UN TÉCNICO DEL DEPARTAMENTO DE INFORMÁTICA PARA SU PREVIA REVISIÓN Y SOLVENTAR LAS POSIBLES FALLAS.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- NO TIENE ACCESSO A INTERNET -->
<div class="modal fade" id="modalNoInternet" tabindex="-1" role="dialog" aria-labelledby="modalNoInternet" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalNoInternet">El Equipo se reinicia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p>Revise si el <span class="text-warning">cable de red</span> está conectado al equipo</p>
				<p class="text-warning">NOTA: "Si aún no posee acceso a internet contacte aun técnico para solventar el problema.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>