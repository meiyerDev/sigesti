<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-bottom">
	<a class="navbar-brand" href="{{ url('home') }}">
		<img width="55px" height="55px" src="{{ asset('img/alcaldia.jpg') }}">
		<span class="ml-1 lead text-nav" style="font-weight: bold;">SIGESTI - Alcaldía de Sucre</span>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			@guest
			<li class="nav-item">
				<a class="nav-link" href="{{ url('login') }}"><i class="fas fa-users mr-2"></i>Accerder</a>
			</li>
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ url('home') }}"><i class="fas fa-home mr-2"></i>Inicio</a>
			</li>
			@if(Auth::user()->hasRole('admin'))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('inventory.index') }}"><i class="fas fa-building mr-2"></i>Inventario</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('department.index') }}"><i class="fas fa-building mr-2"></i>Departamentos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('expert.index') }}"><i class="fas fa-users mr-2"></i>Técnicos</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-file-pdf mr-2"></i>Reportes
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">

					<a class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" target="_blank">Reportes Inventario</a>

					<div class="dropdown-menu" aria-labelledby="navbarDropdown">

						<a class="dropdown-item" href="{{ route('reporte.inventory','todos') }}" target="_blank">Todos</a>
						<a class="dropdown-item" href="{{ route('reporte.inventory','Monitor') }}" target="_blank">Monitor</a>
						<a class="dropdown-item" href="{{ route('reporte.inventory','Cpu') }}" target="_blank">Cpu</a>
						<a class="dropdown-item" href="{{ route('reporte.inventory','Laptop') }}" target="_blank">Laptop</a>
						<a class="dropdown-item" href="{{ route('reporte.inventory','Impresora') }}" target="_blank">Impresora</a>
						<a class="dropdown-item" href="{{ route('reporte.inventory','Otro') }}" target="_blank">Otro</a>
					</div>
					<a class="dropdown-item" href="{{ route('reporte.solicitud') }}" target="_blank">Reporte Solicitudes</a>
					
				</div>
			</li>
			@elseif(Auth::user()->hasRole('user'))
			<li class="nav-item">
				<a class="nav-link" href="{{ url('expert/assignments') }}"><i class="fas fa-building mr-2"></i>Asignaciones</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-file-pdf mr-2"></i>Reportes
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('reporte.repar',Auth::user()->id) }}" target="_blank">Reporte Reparaciones</a>
				<a class="dropdown-item" href="{{ route('reporte.solicitud') }}" target="_blank">Reporte Solicitudes</a>
				</div>
			</li>
			@elseif(Auth::user()->hasRole('boss'))
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-file-pdf mr-2"></i>Reportes
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">

					<a class="dropdown-item" href="{{ route('reporte.solicitud') }}" target="_blank">Reporte Solicitudes</a>
				</div>
			</li>
			@endif	
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user mr-2"></i>{{ Auth::user()->user }}
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('userPerfil.show',Auth::user()->id) }}">
						Perfil
					</a>
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Salir
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</li>
			@endguest
		</ul>
	</div>
</nav>