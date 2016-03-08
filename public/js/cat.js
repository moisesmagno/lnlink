$(document).ready(function() {

	var l_eln;
	var token = $('input[name="_token"]').val();
	
	$.post('/listaELNcat',{_token:token}, function(data) {	  	

	  	l_eln = jQuery.parseJSON(data);
	  
	 	 $('#input_catalogo_autocomplete').devbridgeAutocomplete({
		 	lookup: l_eln,
		 	minChars: 2,
	 	
	 	});
	});	
	

	$('.select_esp_auto_load').change(function(event) {

		var esplab = $('.select_esp_lab_load option:selected').val(),
		sublab = $('.select_esp_sub_load option:selected').val(),
		espcli = $('.select_esp_cli_load option:selected').val(),
		amostra = $('.select_esp_amostra_load option:selected').val();

		if ($(this).hasClass('select_esp_lab_load')) {

			var esplab = $('.select_esp_lab_load option:selected').val();
			$.post('/catalogo/sublab',{_token:token,esplab:esplab}, function(data) {	 		  
			$('.select_esp_sub_load').html(data);			
			});

			sublab = '';
		}		

		$.post('/buscaELN',{_token:token,esplab:esplab,sublab:sublab,espcli:espcli,amostra:amostra}, function(data) {	  	

			 l_eln = jQuery.parseJSON(data);			 
			  
			 $('#input_catalogo_autocomplete').devbridgeAutocomplete({
			 	lookup: l_eln,
			 	minChars: 2,
			 	
			 });
		});
	});


	$('.form_buscador_catalogo').submit(function(event) {
		event.preventDefault();

		var	esplab = $('.select_esp_lab_load option:selected').val(),
		sublab = $('.select_esp_sub_load option:selected').val(),
		espcli = $('.select_esp_cli_load option:selected').val(),
		amostra = $('.select_esp_amostra_load option:selected').val(),
		texto = $('.input_buscador_catalogo').val();

		if ((esplab == '') &&  (sublab == '') && (espcli == '') && (amostra == '') && (amostra == '') && (texto.trim() == '')) {

			exibirMensagem('.alerta_msg_campos');
			

		}else{

			$('.envFiltrosCat').animate({'height': '1px'}, 'slow');	
			$('.flecha_abre_fecha_catalogo').css({transform: 'rotate(180deg)'});
			$('.flecha_abre_fecha_catalogo').addClass('clicado');
			$('.flecha_abre_fecha_catalogo').css('background', '#0590c0');
			

			$.post('/catalogo/consulta',{_token:token,esplab:esplab,sublab:sublab,espcli:espcli,amostra:amostra,texto:texto}, function(data) {	  	
				$('.resultados_busca_catalogo').empty();
				$('.resultados_busca_catalogo').html(data);
				$('.add_exame_lista_click').bind('click', addExameLista);
			});

			if (!(esplab == '') &&  !(sublab == '') && !(espcli == '') && !(amostra == '') ) {
				$('.btn_filtro_lateral').hide();
			}else{
				$('.btn_filtro_lateral').show();
			}
			

			if (esplab == '') {
				$('.env_especialidade_esplab').show();
				$('.cont_especialidade_sublab').empty();
			}else{
				$('.env_especialidade_esplab').hide();
				$('.cont_especialidade_sublab').empty();
				$.post('/catalogo/filtro-sublab',{_token:token,esplab:esplab}, function(data) {									 
					$('.cont_especialidade_sublab').html(data);
					$('.f_sublab').bind('change',filtrarResultados);
				});
			}

			if (sublab == '') {
				$('.env_especialidade_sublab').show();
			}else{
				$('.env_especialidade_sublab').hide();
			}

			if (espcli == '') {
				$('.env_especialidade_espcli').show();
			}else{
				$('.env_especialidade_espcli').hide();
			}

			if (amostra == '') {
				$('.env_especialidade_amostra').show();
			}else{
				$('.env_especialidade_amostra').hide();
			}

			$('.f_esplab').unbind('change',filtrarResultados);
			$('.f_espcli').unbind('change',filtrarResultados);
			$('.f_amostra').unbind('change',filtrarResultados);

			$('.f_esplab').bind('change',filtrarResultados);
			$('.f_espcli').bind('change',filtrarResultados);
			$('.f_amostra').bind('change',filtrarResultados);

			$('.catalogo_filtro_esp_click').prop('checked', false);	
		}	

	});


	function filtrarResultados(){

		var f_esplab = new Array(),
		f_sublab = new Array(),
		f_espcli = new Array(),
		f_amostra = new Array();

		if ($(this).hasClass('f_esplab')) {
			var upesplab = $(this).val();

			if ($(this).prop('checked')) {
				$.post('/catalogo/filtro-sublab-div', {_token:token,esplab:upesplab}, function(data, textStatus, xhr) {
					$('.cont_especialidade_sublab').append(data);
					$('.f_sublab').bind('change',filtrarResultados);			
				});	
			}else{				
				$('div[data-sublabdiv="'+upesplab+'"]').remove();
			}
		}		

		if ($('.f_esplab:checked').length > 0) {
			var i = 0;
			$('.f_esplab:checked').each(function() {
				f_esplab[i] = $(this).val();
				i++;
			});
		}

		if ($('.f_sublab:checked').length > 0) {
			var i = 0;
			$('.f_sublab:checked').each(function() {
				f_sublab[i] = $(this).val();
				i++;
			});
		}

		if ($('.f_espcli:checked').length > 0) {
			var i = 0;
			$('.f_espcli:checked').each(function() {
				f_espcli[i] = $(this).val();
				i++;
			});
		}

		if ($('.f_amostra:checked').length > 0) {
			var i = 0;
			$('.f_amostra:checked').each(function() {
				f_amostra[i] = $(this).val();
				i++;
			});
		}

		$('.linha_resultado_catalogo').hide();
		$('.linha_resultado_catalogo').each(function() {

			var esp = $(this).attr('data-esp'),
			esplabFound = false,
			espcliFound = false,
			sublabFound = false,
			amostraFound = false;

			if (f_esplab.length > 0) {
				for (var i = 0; i < f_esplab.length; i++) {
					if (esp.indexOf(f_esplab[i]) >= 0) {
						esplabFound = true;
					}						
				}
			}else{
				esplabFound = true;
			}

			if (f_amostra.length > 0) {
				for (var i = 0; i < f_amostra.length; i++) {
					if (esp.indexOf(f_amostra[i]) >= 0) {
						amostraFound = true;
					}						
				}
			}else{
				amostraFound = true;
			}

			if (f_espcli.length > 0) {
				for (var i = 0; i < f_espcli.length; i++) {
					if (esp.indexOf(f_espcli[i]) >= 0) {
						espcliFound = true;
					}						
				}
			}else{
				espcliFound = true;
			}

			if (f_sublab.length > 0) {
				for (var i = 0; i < f_sublab.length; i++) {
					if (esp.indexOf(f_sublab[i]) >= 0) {
						sublabFound = true;
					}						
				}
			}else{
				sublabFound = true;
			}

			if (amostraFound == true && espcliFound == true && sublabFound == true && esplabFound == true) {
				$(this).show();
			}
		});
	}


	function addExameLista(event){
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
	}


	 function atualizarCountLista(){
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