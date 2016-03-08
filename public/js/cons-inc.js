$(document).ready(function() {
		
	var token = $('input[name="_token"]').val();

	$('.form_tipos_incidencias').submit(function(event) {
		event.preventDefault();


		var inc = $('select[name="tipoIncidencia"] option:selected').val();
		
		if (inc == '1' || inc == '2') {
			$.post('/consulta/incidencias-nous', {_token:token,tipo:inc}, function(data, textStatus, xhr) {
				$('.resultados_incidencias_target').html(data);
				$('.linha_incidencia').bind('click',abrirLinhaIncidencia);
				$('.btn_ocultar_conteudo_incidencias').bind('click',fecharLinhaIncidencia);
			});
		}else{

		}
	});


	function abrirLinhaIncidencia (event) {
		event.preventDefault();
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');			
			$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideUp();
		}else{
			$(this).addClass('clicado');
			$(this).parents('.env_linha_conteudo').find('textarea[name="descricao"]').val('');	
			$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideDown();
		}
	}

	
	function fecharLinhaIncidencia (event) {
		$(this).parents('.env_linha_conteudo').find('.linha_incidencia').removeClass('clicado');
		$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideUp();
	}	

	$(document).delegate('.form_conteudo_incidencias', 'submit', function(event) {
		event.preventDefault();
		var desc = $(this).find('textarea[name="descricao"]').val(),
		exam = $(this).find('input[name="hiddenpet"]').val(),
		pet = $(this).find('input[name="hiddenexam"]').val(),
		textarea =  $(this).find('textarea[name="descricao"]');

		if ($.trim(desc) == '' ) {
			exibirMensagem('.alerta_msg_comentario_vazio');
		}else{
			$.post('/consulta/incidencias-comentario', {_token:token,desc:desc,exam:exam,pet:pet}, function(data, textStatus, xhr) {
				if (data == '1') {
					exibirMensagem('.alerta_msg_enviado_comentario');
					textarea.val('');				
				}else{
					exibirMensagem('.alerta_msg_erro_comentario');
				}
			});
		}

		
	});


	//Exibir modal de mensagens de alertas, erros e sucesso.
	function exibirMensagem(alerta) {
	$(alerta).show();
    $('.modal_mensagens').fadeIn('fast');
	$('.telaoscura_mensagens').fadeIn('fast');

	}    


});