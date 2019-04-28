<div class="row">
	<div class="col">
		<div class="card">
			<p class="text-center mt-4">
				<img src="{{ asset('img/tecnico.jpg') }}" class="img-fluid px-5" style="height: 95px">
			</p>
			<div class="card-body text-center">
				<h5 class="card-title">Técnicos</h5>
				<p class="card-text lead">{{ $experts->count() }}</p>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card">
			<p class="text-center mt-4">
				<img src="{{ asset('img/50051906_372831636613246_595322552155373568_n.jpg') }}" class="img-fluid px-5" style="height: 95px">
			</p>
			<div class="card-body text-center">
				<h5 class="card-title text-dark">Articulos</h5>
				<p class="card-text lead text-dark">{{ $article_count }}</p>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card">
			<p class="text-center mt-4">
				<i class="fas fa-building fa-7x"></i>
			</p>
			<div class="card-body text-center">
				<h5 class="card-title">Departamentos</h5>
				<p class="card-text lead">{{ $departments->count() }}</p>
			</div>
		</div>
	</div>
</div>
