$(() => {

	$(document).ready(function() {
		path = window.location.pathname
		if (path == '/report') {
			$('body').style
			$('#report').attr('class','nav-item active')
		}else if (path == '/expert') {
			$('#expert').attr('class','nav-item active')
		}else if (path == '/assignments'){
			$('#assignment').attr('class','nav-item active')
		}
	}),

	$('#respon').change(function () {
		if ($(this).val() == 'nuevo') {
			$('#nuevo-respon').show()
		}else{
			$('#nuevo-respon').hide()
		}
		if (isNaN($(this).val()) || $('#respon').val() == "") {
			$('#div_tipo').hide()
			$('#article').hide()
		}
	}),
	$('#departamento').change(function () {
		if($(this).val() == 'nuevo'){
			$('#nue_departmento').show()
		}else{
			$('#nue_departmento').hide()
		}
	}),
	$('#tipo').change(function () {
		if ($(this).val() == 'Monitor-Desktop') {
			$('#monitor').show()
			$('#cpu').show()
			$('#article-cpu').show()
		}else if ($(this).val() == 'Monitor'){
			$('#monitor').show()
			$('#cpu').hide()
			$('#article-cpu').hide()
		}else if ($(this).val() == 'Cpu'){
			$('#cpu').show()
			$('#monitor').hide()
			$('#article-cpu').hide()
		}else{
			$('#monitor').hide()
			$('#cpu').hide()
			$('#article-cpu').hide()
		}
		if ($(this).val() == 'Otro') {
			$('#name_otro').show()
		}else{
			$('#name_otro').hide()
		}
		if($(this).val() == 'Cartucho') {
			$('#cartridge').show()
		}else{
			$('#cartridge').hide()
		}
	}),
	$('#department').change(function () {
		if ($(this).val() == 'nuevo') {
			$('#new_departmento').show()
		}else{
			$('#new_departmento').hide()
		}
	}),

	$('.follow').click(function() {
		if ($('#div_tipo').is(':hidden') && $('#article').is(':hidden')) {
			$('#nuevo-respon').hide()
			$('#div_tipo').show()
		}else if ($('#div_tipo').is(':visible') && $('#article').is(':hidden')) {
			$('#article').show()
			$('#follow').hide()
			$('#boton').show()
		}
	}),
	$('#back').click(function() {
		if ($('#article').is(':visible')) {
			$('#article').hide()
			$('#div_tipo').show()
			$('#boton').hide()
			$('#follow').show()
		}else if ($('#div_tipo').is(':visible')) {
			$('#div_tipo').hide()
			if ($('#respon').val() == 'nuevo') {
				$('#nuevo-respon').show()
			}
		}
	}),

	$('.edit-report').click(function() {
		var row = $(this).parent().parent()
		var td  = row.children()
		var id = td[9].innerHTML
		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/report/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})

		.done((success) => {
			console.log(success.article)
			document.getElementById('modify').action='http://'+location.host+'/report/'+id
			// RESPONSABLE
			$('#identity').val(success.respon.identity)
			$('#first_name').val(success.respon.first_name)
			$('#last_name').val(success.respon.last_name)
			$('#phone').val(success.respon.phone)
			// ARTICULO
			$('#type').val(success.article.type)
			$('#model').val(success.article.model)
			$('#brand').val(success.article.brand)
			$('#serial').val(success.article.serial)
			$('#department-up').val(success.article.department_id)
			$('#observation').val(success.article.observation)

			// IF MONITOR
			if (success.article.monitor) {
				$('#inche').val(success.article.monitor.inche)
				$('#monitor-up').show()
			}else{
				$('#inche').val("")
				$('#monitor-up').hide()
			}

			if (success.article.cpu) {
				//alert('tes')
				$('#ram').val(success.article.cpu.ram)
				$('#processor').val(success.article.cpu.processor)
				$('#so').val(success.article.cpu.so)
				$('#memory_video').val(success.article.cpu.memory_video)
				$('#cpu-up').show()
				$('#cpu').prop('disabled',false);
			}else{
				$('#ram').val("")
				$('#processor').val("")
				$('#so').val("")
				$('#memory_video').val("")
				$('#cpu-up').hide()
			}
		})

		.fail((error) => {
			console.log(error)
		})
	}),

	$('.delete-report').click(function () {
		document.getElementById('delete-r').action='http://'+location.host+'/'+$(this).data("url")+'/'+$(this).data("id")
		document.getElementById('delete-r').name='destroy'+$(this).data("id")
	}),
	// $('#delete-r').submit(function(e) {
	// 	e.preventDefault()
	// 	var id  = $(this).attr('name').substring(7)
	// 	var token = $('input[name="_token"]').data("token")
	// 	$.ajax({
	// 		method: 'get',
	// 		url : '/report/'+id,
	// 		Type: 'DELETE',
	// 		dataType: 'JSON',
	// 		data : { "id": id, "_method":'DELETE',"_token":token },
	// 		success:function(succ) {
	// 			console.log(succ)
	// 		}
	// 	})

	// })

	$('.expert-report').click(function () {
		var row = $(this).parent().parent()
		var td = row.children()
		var id = td[9].innerHTML
		alert(id)

		// var expert = td[7].innerHTML
		$('#add-expert').attr('action', 'http://'+location.host+'/report/'+id)
	}),
	$('#expert').change(function () {
		if ($(this).val() == 'nuevo') {
			$('#nuevo-expert').show()
		}else{
			$('#nuevo-expert').hide()
		}
	}),

	/* REPORTE TECNICO */
	$('.reportar').click(function() {
		var row = $(this).parent().parent()
		var td  = row.children()
		var id = td[9].innerHTML

		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/expert/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})
		.done((success) => {
			console.log(success.expert)
			$('#reporteTecnico').attr('action', 'http://'+location.host+'/expert/'+id)
			$('#maintenance').val(success.expert.maintenance)
			$('#inter').val(success.expert.internet)
			$('#usuarios').val(success.expert.users)
			$('#cartucho').val(success.expert.cartucho)

			if (success.expert.description) {
				$('#description').text(success.expert.description)
			}
		})

		.fail((error) => {
			console.log(error)
		})
	}),
	/* /REPORTE TECNICO */

	$('.edit-person').click(function() {
		var row = $(this).parent().parent()
		var td  = row.children()
		var cedula = td[1].innerHTML

		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/expert/'+cedula,
			// dataType: 'text',
			data : $.param({ cedula: cedula })
		})
		.done((success) => {
			console.log(success.expert)
			document.getElementById('modify').action='http://'+location.host+''+window.location.pathname+'/'+cedula
			$('#cedula').val(success.expert.identity)
			$('#nombre').val(success.expert.first_name)
			$('#apellido').val(success.expert.last_name)
			$('#telefono').val(success.expert.phone)
		})

		.fail((error) => {
			console.log(error)
		})
	}),
	$('.delete-person').click(function () {
		var row = $(this).parent().parent()
		var td  = row.children()

		var id = td[7].innerHTML
		document.getElementById('delete').action='http://'+location.host+'/expert/'+id
		document.getElementById('delete').name='destroy'+id
	}),

	$('.edit-department').click(function() {
		var id = $(this).data("id")


		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/department/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})

		.done((success) => {
			console.log(success.department)
			document.getElementById('modify').action='http://'+location.host+'/department/'+id
			$('#department').val(success.department.department)
			$('#primer').val(success.department.firstname_director)
			$('#segundo').val(success.department.lastname_director)
			$('#phone').val(success.department.phone)
		})

		.fail((error) => {
			console.log(error)
		})
	}),
	$('.delete-department').click(function () {
		var id = $(this).data("id")
		document.getElementById('delete').action='http://'+location.host+'/department/'+id
		document.getElementById('delete').name='destroy'+id
	}),
	$('.active').click(function () {
		$('#persona').toggle();
		$('#articulo').toggle();
		if ($('#persona').is(':visible')) {
			$('#boton-editar').val('Persona')

		}else{
			$('#boton-editar').val('Articulo')
		}
	}),
	$('.btnInf').click(function() {
		var id = $(this).data('id')

		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/cod/'+id,
			// dataType: 'text',
			data : $.param({ id: id })
		})
		.done((success)=>{
			$('#bodyInfo').html(success.qr)
			$('#titleInfo').html('Tipo:'+success.a.type+' Modelo:'+success.a.model+' Marca:'+success.a.brand)
			$('#downInfo').val(success.a.id)
		})
		.fail((error)=>{
			console.log(error)
		})
	}),
	$('.btnRequested').click(function() {
		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/inventory/'+$(this).data('id'),
			// dataType: 'text',
			data : $.param({ id: $(this).data('id') })
		})
		.done((success)=>{
			console.log(success)
			$('#titleRe').html('Tipo:'+success.type+' Modelo:'+success.model+' Marca:'+success.brand)
			$('#article').val(success.id)
		})
		.fail((error)=>{
			console.log(error)
		})
	}),
	$('#butSearch').click(function() {
		if ($('#inputSearch').val() == '') {
			$('#error').html('<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"id="error">\
				<i class="fas fa-info mr-2"></i>¡HA OCURRIDO UN ERROR, POR FAVOR INGRESE EL UN DATO EN EL CAMPO DE BUSQUEDA!\
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
				<span aria-hidden="true">&times;</span>\
				</button>\
				</div>')
		}else{
			$.ajax({
				method : 'get',
				url : 'http://'+location.host+'/requested/'+$('#inputSearch').val(),
				// dataType: 'text',
				data : $.param({ id: $(this).data('id') })
			})
			.done((success)=>{
				if (success.a != null) {
					if (success.r == null) {
						$('#modalNuevo').modal('show')
						$('#titleRe').html('Tipo:'+success.a.type+' Modelo:'+success.a.model+' Marca:'+success.a.brand)
						$('#article').val(success.a.id)
					}else{
						$('#titleReq').html('Tipo:'+success.a.type+' Modelo:'+success.a.model+' Marca:'+success.a.brand)
						$('#bodyInfoReques').html('<h4>Tipo:'+success.a.type+' | Modelo:'+success.a.model+' | Marca:'+success.a.brand+'</h4>\
							<br><p>Tipo de Solicitud: '+success.r.request+'</p>\
							<p>observación: '+success.a.observation+'</p>')
						$('#modalInfoRequested').modal('show')
					}
				}else{
					$('#error').html('<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"id="error">\
						<i class="fas fa-info mr-2"></i>¡HA OCURRIDO UN ERROR CON SU BUSQUEDA, POR FAVOR VERIFIQUE EL SERIAL INGRESADO!\
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
						<span aria-hidden="true">&times;</span>\
						</button>\
						</div>')
				}
			})
			.fail((error)=>{
				console.log(error)
			})
		}
	}),
	$('.btnEditArt').click(function() {
		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/inventory/'+$(this).data('id'),
			// dataType: 'text',
			data : $.param({ id: $(this).data('id') })
		})
		.done((success)=>{
			document.getElementById('formEditar').action='http://'+location.host+'/inventory/'+$(this).data('id')
			$('#typeU').val(success.type)
			$('#modelU').val(success.model)
			$('#brandU').val(success.brand)
			$('#serialU').val(success.serial)
		})
		.fail((error)=>{
			console.log(error)
		})
	}),
	$('.btnAsig').click(function () {
		$.ajax({
			method : 'get',
			url : 'http://'+location.host+'/inventory/'+$(this).data('id'),
			// dataType: 'text',
			data : $.param({ id: $(this).data('id') })
		})
		.done((success)=>{
			document.getElementById('asignarDepart').action='http://'+location.host+'/inventory/asigDepart/'+$(this).data('id')
			$('#titleAS').html('Tipo: '+success.type+' | Modelo :'+success.model+' | Marca :'+success.brand)
			$('#articleID').val(success.id)
		})
		.fail((error)=>{
			console.log(error)
		})
	})
	$('#butSearchPerson').click(function () {
		if ($('#inputSearch').val() == '') {
			$('#error').html('<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"id="error">\
				<i class="fas fa-info mr-2"></i>¡HA OCURRIDO UN ERROR, POR FAVOR INGRESE EL UN DATO EN EL CAMPO DE BUSQUEDA!\
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
				<span aria-hidden="true">&times;</span>\
				</button>\
				</div>')
		}else{
			$.ajax({
				method : 'get',
				url : 'http://'+location.host+'/expert/busExpert/'+$('#inputSearch').val(),
				// dataType: 'text',
				data : $.param({ id: $(this).data('id') })
			})
			.done((success)=>{
				console.log(success)
				if (success.expert != null) {
					$('#bodyInfoReques').html('<h4>Nombre:'+success.expert.first_name+' | Apellido:'+success.expert.last_name+'</h4>\
						<br><p>Cédula: '+success.expert.identity+'</p>\
						<p>Teléfono: '+success.expert.phone+'</p>\
						<p>Usuario: '+success.user.user+'</p>\
						<p>Creado: '+success.expert.expert.created_at+'</p>')
					$('#modalInfoPerson').modal('show')
				}else{
					$('#error').html('<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"id="error">\
						<i class="fas fa-info mr-2"></i>¡HA OCURRIDO UN ERROR CON SU BUSQUEDA, POR FAVOR VERIFIQUE LA CÉDULA INGRESADA!\
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
						<span aria-hidden="true">&times;</span>\
						</button>\
						</div>')
				}
			})
			.fail((error)=>{
				console.log(error)
			})
		}
	}),
	$('#downInfo').click(function () {
		var pw = window.open('', 'QrCode Info', 'height=400,width=600');
		pw.document.write('<head></head><body>');
		pw.document.write($('#QrInf').html());
		pw.document.write('</body>');
		pw.print();
		pw.close();
	})
})
