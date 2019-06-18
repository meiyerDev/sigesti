$(document).ready(function() {
	var path = window.location.pathname
	var id = path.substring(20)
	$.ajax({
		method : 'get',
		url : 'http://127.0.0.1:8000/report/'+id,
		data : $.param({ id: id })
	})
	.done((success) => {
		console.log(success.article)
		if (success.article.report.request) {
			if (success.article.report.request == 'Correo') {
				$('#correo').prop('checked',true)
			}else if(success.article.report.request == 'Vocal') {
				$('#vocal').prop('checked',true)
			}else if(success.article.report.request == 'Telefonica') {
				$('#telefonica').prop('checked',true)
			}else if(success.article.report.request == 'Escrita') {
				$('#escrita').prop('checked',true)
			}
		}

		if (success.article.report.internet) {
			if (success.article.report.internet == 'Instalacion') {
				$('#ins-inter').prop('checked',true)
			}else if (success.article.report.internet == 'Configuracion') {
				$('#con-inter').prop('checked',true)
			}else if (success.article.report.internet == 'Monitoreo') {
				$('#mon-inter').prop('checked',true)
			}
		}

		if (success.article.report.users) {
			if (success.article.report.users == 'Instalacion') {
				$('#ins-user').prop('checked',true)
			}else if (success.article.report.users == 'Configuracion') {
				$('#con-user').prop('checked',true)
			}else if (success.article.report.users == 'Monitoreo') {
				$('#mon-user').prop('checked',true)
			}
		}

		if (success.article.report.cartucho) {
			if (success.article.report.cartucho == 'Mantenimiento') {
				$('#ins-manteni').prop('checked',true)
			}else if (success.article.report.cartucho == 'Recarga') {
				$('#ins-rec').prop('checked',true)
			}
		}

		if (success.article.report.maintenance == 'Preventivo') {
			$('#preventivo').prop('checked',true)
		}else if(success.article.report.maintenance == 'Correctivo'){
			$('#correctivo').prop('checked',true)
		}
		window.print()
		window.close()
	})
})
