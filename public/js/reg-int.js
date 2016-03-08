$(document).ready(function() {
	
	token = $('input[name="_token"]').val();

	$.post('/registro/integracao/integrados-hoje',{_token:token}, function(data, textStatus, xhr) {
		$('.arquivos_integrados_hoje_alvo').empty();
		$('.arquivos_integrados_hoje_alvo').html(data);
	});

	$('.form_busca_arquivos_integrados').submit(function(event) {
		event.preventDefault();
		var dtInicial = $('.form_busca_arquivos_integrados  input[name="dataInicial"]').val(),
		dtFinal = $('.form_busca_arquivos_integrados  input[name="dataFinal"]').val();

		$.post('/registro/integracao/integrados-data',{_token:token,dtInicial:dtInicial,dtFinal:dtFinal}, function(data, textStatus, xhr) {
			$('.resultado_busca_registros_integrados_alvo').empty();
			$('.resultado_busca_registros_integrados_alvo').html(data);
		});
	});

});