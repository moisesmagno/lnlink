$(document).ready(function() {

	var token = $('input[name="_token"]').val();

	$('.atualizar_lote_click').click(function(event) {
		$.get('/logistica/gerar-lote', function(data, textStatus, xhr) {			
			$('.input_numero_lote').val(data);
		});
		
	});

	$('.atualizar_requisicao_click').click(function(event) {
		$.get('/logistica/gerar-lote', function(data, textStatus, xhr) {			
			$('.input_numero_requisicao ').val(data);
		});
	});

	$('.form_envio_material_logistica').submit(function(event) {
		event.preventDefault();
		var lote = $('input[name="numeroLote"]').val(),
		data = $('input[name="envioMaterialFisico"]').val(),
		envio = '',
		error = false;

		$('.linha_envio_material').each(function() {
			var refCaixa = $(this).find('input[name="referenciaCaixa"]').val(),
			qtdVol = $(this).find('input[name="qtdeVolumes"]').val(),
			tamanho = $(this).find('select[name="tamanhoCx"] option:selected').val(),
			conservacao = $(this).find('select[name="conservacaoAmostra"] option:selected').val(),
			temperatura = $(this).find('input[name="temperaturaSaida"]').val(),
			qtdAmt = $(this).find('input[name="quantidadeAmostras"]').val();

			if ($.trim(refCaixa) == '' || $.trim(qtdVol) == '' || $.trim(tamanho) == '' || $.trim(conservacao) == '' || $.trim(temperatura) == '' || $.trim(qtdAmt) == '' || $.trim(data) == '' || $.trim(lote) == '') {
				error = true;
			}

			envio = envio + lote+'#'+data+'#'+refCaixa+'#'+qtdVol+'#'+tamanho+'#'+conservacao+'#'+temperatura+'#'+qtdAmt+'^';
		});

		if (error) {
			exibirMensagem('.alerta_msg_preencher_campos');
		}else{
			$.post('/logistica/enviar-material', {_token:token,envio:envio}, function(data, textStatus, xhr) {
				if (data == '1') {					
					exibirMensagem('.alerta_msg_enviada');	
					$('input[name="numeroLote"]').val('');
					var x = $('.linha_envio_material').detach();			
					x.first().find('input[name="referenciaCaixa"]').val('');
					x.first().find('input[name="qtdeVolumes"]').val('');
					x.first().find('.tamanho_env_mat select').find('option[value=""]').attr("selected",true);
					x.first().find('.conservacao_env_mat select').find('option[value=""]').attr("selected",true);
					x.first().find('input[name="temperaturaSaida"]').val('');
					x.first().find('input[name="quantidadeAmostras"]').val('');		
					x.first().appendTo('.env_linha_envio_material');					

				}else{
					exibirMensagem('.alerta_msg_erro_envio');
				}
			});
		}	
	});


	$('.form_solicitar_material').submit(function(event) {
		event.preventDefault();
		var lote = $('input[name="numeroRequisicao"]').val(),
		data = $('input[name="dataSolicitacao"]').val(),
		envio = '';
		error = false;

		$('.linha_solicitacao_material').each(function() {
			var nomeMaterial = $(this).find('select[name="nomeMaterial"] option:selected').val(),
			qtdSol = $(this).find('input[name="qtdeSolicitacao"]').val(),
			unit = $(this).find('select[name="utilizacaoSolicitacao"] option:selected').val(),
			total = $(this).find('input[name="totalSolicitacao"]').val();

			if ($.trim(nomeMaterial) == '' || $.trim(qtdSol) == '' || $.trim(unit) == '' || $.trim(total) == '' || $.trim(data) == '' || $.trim(lote) == '') {
				error = true;
			}

			envio = envio + lote+'#'+data+'#'+nomeMaterial+'#'+qtdSol+'#'+unit+'#'+total+'^';
		});

		if (error) {
			exibirMensagem('.alerta_msg_preencher_campos');
		}else{

			$.post('/logistica/solicitar-material', {_token:token,envio:envio}, function(data, textStatus, xhr) {
				if (data == '1') {					
					exibirMensagem('.alerta_msg_enviada_requisicao');	
					$('input[name="numeroRequisicao"]').val('');
					var x = $('.linha_solicitacao_material').detach();			
					x.first().find('.nome_material select').find('option[value=""]').attr("selected",true);
					x.first().find('.utilizacao_solicitacao select').find('option[value=""]').attr("selected",true);
					x.first().find('input[name="qtdeSolicitacao"]').val('');
					x.first().find('input[name="totalSolicitacao"]').val('');		
					x.first().appendTo('.env_linha_solicitacao_material');					

				}else{
					exibirMensagem('.alerta_msg_erro_envio');
				}
			});
		}	
	});


	function exibirMensagem(alerta) {
		$(alerta).show();
	    $('.modal_mensagens').fadeIn('fast');
		$('.telaoscura_mensagens').fadeIn('fast');
	} 

});