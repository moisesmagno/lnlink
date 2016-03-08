$(document).ready(function() {
	
	var token = $('input[name="_token"]').val();

	$('.valor_referencia_click').click(function(event) {
		alert($('.input_hidden_valor_referencia').val());
	});


	$('.add_exame_lista_click').click(function(event) {
		event.preventDefault();

		var cod = $(this).children('.cod_exame_catalogo_resultado').val();

		$.post('/catalogo/add-exame',{_token:token,cod:cod} , function(data, textStatus, xhr) {
			if (data == '0') {
				exibirMensagem('.alerta_msg_falha');
			}
			if (data == '1') {
				atualizarCountLista();
				exibirMensagem('.alerta_msg_adicionado');
			}
			if (data == '2') {
				exibirMensagem('.alerta_msg_ja_adicionado');
			}
		});
	});

	 function atualizarCountLista()
  	{
	    $.post('/lista/atualizar-count' ,{_token:token},function(data, textStatus, xhr) {
	      $('.top_count_list').empty();  
	      $('.top_count_list').text(data);     
	    });
  	}  

  	function exibirMensagem(alerta) {
		$(alerta).show();
	    $('.modal_mensagens').fadeIn('fast');
		$('.telaoscura_mensagens').fadeIn('fast');
	}  

});