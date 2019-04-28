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
	$('#department-up').change(function () {
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
			url : 'http://127.0.0.1:8000/report/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})

		.done((success) => {
			console.log(success.article)
			document.getElementById('modify').action='http://127.0.0.1:8000/report/'+id
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
		var row = $(this).parent().parent()
		var td  = row.children()

		var id = td[9].innerHTML
		document.getElementById('delete-r').action='http://127.0.0.1:8000/report/'+id
		document.getElementById('delete-r').name='destroy'+id
	}),

	$('.expert-report').click(function () {
		var row = $(this).parent().parent()
		var td = row.children()
		var id = td[9].innerHTML
		// var expert = td[7].innerHTML
		$('#add-expert').attr('action', 'http://127.0.0.1:8000/report/'+id)
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
			url : 'http://127.0.0.1:8000/expert/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})
		.done((success) => {
			console.log(success.expert)
			$('#reporteTecnico').attr('action', 'http://127.0.0.1:8000/expert/'+id)
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
			url : 'http://127.0.0.1:8000/expert/'+cedula,
			// dataType: 'text',
			data : $.param({ cedula: cedula })
		})
		.done((success) => {
			console.log(success.expert)
			document.getElementById('modify').action='http://127.0.0.1:8000'+window.location.pathname+'/'+cedula
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
		document.getElementById('delete').action='http://127.0.0.1:8000/expert/'+id
		document.getElementById('delete').name='destroy'+id
	}),

	$('.edit-department').click(function() {
		var row = $(this).parent().parent()
		var td  = row.children()
		var id = td[4].innerHTML

		$.ajax({
			method : 'get',
			url : 'http://127.0.0.1:8000/department/'+id+'/edit',
			// dataType: 'text',
			data : $.param({ id: id })
		})

		.done((success) => {
			console.log(success.department)
			document.getElementById('modify').action='http://127.0.0.1:8000/department/'+id
			$('#department').val(success.department.department)
		})

		.fail((error) => {
			console.log(error)
		})
	}),
	$('.delete-department').click(function () {
		var row = $(this).parent().parent()
		var td  = row.children()

		var id = td[0].innerHTML
		document.getElementById('delete').action='http://127.0.0.1:8000/department/'+id
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
	})

})



