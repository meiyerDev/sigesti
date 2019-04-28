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
				<a class="nav-link" href="{{ route('department.index') }}"><i class="fas fa-building mr-2"></i>Departamentos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('expert.index') }}"><i class="fas fa-users mr-2"></i>Técnicos</a>
			</li>
			@elseif(Auth::user()->hasRole('user'))
			<li class="nav-item">
				<a class="nav-link" href="{{ url('expert/assignments') }}"><i class="fas fa-building mr-2"></i>Asignaciones</a>
			</li>
			@endif
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user mr-2"></i>{{ Auth::user()->user }}
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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