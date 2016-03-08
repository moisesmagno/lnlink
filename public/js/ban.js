jQuery(document).ready(function($) {

	function abreOlhoBandeja(event) {
		if($(this).hasClass('olho_bandeja_clicado')){
			$(this).removeClass('olho_bandeja_clicado');
			$(this).parent().parent().parent().find('.exames_vinculados_paciente_bandeja').slideUp('fast');	
			$('.btn_pacientes_exames').removeClass('btn_pacientes_exames_clicado');
		}else{
			$(this).addClass('olho_bandeja_clicado');
			$(this).parent().parent().parent().find('.exames_vinculados_paciente_bandeja').slideDown('fast');	

			if ($('.olho_bandeja_clicado').length == $('.env_linha_paciente_exames_bandeja').length) {
				$('.btn_pacientes_exames').addClass('btn_pacientes_exames_clicado');
			};
		}
	};

	token = $('input[name="_token"]').val();
	
	$.post('/bandeja/listar-pedidos',{_token:token}, function(data, textStatus, xhr) {
		$('.env_header_pacientes_exames').empty();
  		$('.env_header_pacientes_exames').html(data);
  		$('.img_olho_bandeja').bind('click',abreOlhoBandeja);
  		$('.img_x_bandeja').bind('click',excluirPedido);
  		$('.btn_pacientes_exames').bind('click',abreTodosBandeja);
  		$('.apagar_pedidos_bandeja_click').bind('click',excluirPedidos);
  		atualizarCountPacExam();       		
	 });

	function excluirPedido(event) {
		event.preventDefault();
		var r = confirm($('.alert_excluir_pedido').text());

		if (r == true) {
			var pedido = $(this).parent().find('input[name="petCod"]').val();	
			$.post('/bandeja/excluir-pedido',{_token:token,pedido:pedido}, function(data, textStatus, xhr){
				atualizarPedidos();
			}); 	
		}
	}	


	function atualizarCountPacExam(){
		var countPac = 0,
		countExam = 0;
		$('.total_exame_bandeja').each(function() {
			var aux = $(this).text();
			countPac++;
			countExam = countExam + parseInt(aux);
		});
		$('.count_exam').text(countExam);
		$('.count_pac').text(countPac);
	}


	function atualizarPedidos(){
		$.post('/bandeja/listar-pedidos',{_token:token}, function(data, textStatus, xhr) {
			$('.env_header_pacientes_exames').empty();
      		$('.env_header_pacientes_exames').html(data);
      		$('.img_olho_bandeja').bind('click',abreOlhoBandeja);
      		$('.img_x_bandeja').bind('click',excluirPedido);
      		$('.btn_pacientes_exames').bind('click',abreTodosBandeja);
      		$('.apagar_pedidos_bandeja_click').bind('click',excluirPedidos);
      		atualizarCountPacExam();     
      		atualizarCountPedido();  		
	 	});
	}	


	// Abre e fecha exames vinculados	
	function abreTodosBandeja(event){
		if($(this).hasClass('btn_pacientes_exames_clicado')){
			$(this).removeClass('btn_pacientes_exames_clicado');
			$('.img_olho_bandeja').removeClass('olho_bandeja_clicado');
			$('.exames_vinculados_paciente_bandeja').slideUp('fast');

		}else{
			$(this).addClass('btn_pacientes_exames_clicado');
			$('.img_olho_bandeja').addClass('olho_bandeja_clicado');
			$('.exames_vinculados_paciente_bandeja').slideDown('fast');	
		}
	};

	
	// Exclui todos os pedidos
	function excluirPedidos(event) {
		event.preventDefault();
		var r = confirm($('.alert_excluir_todos_pedidos').text());

		if (r == true) {
			$.post('/bandeja/excluir-pedidos',{_token:token}, function(data, textStatus, xhr){
			atualizarPedidos();
			});
		}   	
	}


	function atualizarCountPedido()
	{
		$.post('/bandeja/atualizar-count' ,{_token:token},function(data, textStatus, xhr) {
			$('.top_count_pet').empty();	
			$('.top_count_pet').text(data);			
		});
	}  


	//Enviar os pedidos desde a bandeja de pedidos.
	$(document).delegate('.btn_enviar_pedidos_bandeja', 'click', function(event) {
		event.preventDefault();
	 	$.post('/bandeja/enviar-pedidos',{_token:token}, function(data, textStatus, xhr) {
	 		if (data == '1') {
	 			atualizarPedidos();
	 			exibirMensagem('.alerta_msg_enviados');
	 		}else{
	 			exibirMensagem('.alerta_msg_falha_envio');
	 		}
	 	});
	});


	function exibirMensagem(alerta) {
		$(alerta).show();
	    $('.modal_mensagens').fadeIn('fast');
		$('.telaoscura_mensagens').fadeIn('fast');
	}  

});