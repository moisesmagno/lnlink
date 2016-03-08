$(document).ready(function() {

	$('.x_apaga_exame_selecionado').bind('click',function(event) {
		$(this).parent().remove();					
	});
	
	$('.abre_dependenecias_registro').bind('click',function(event) {
		$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
		$(this).hide();      	
	});
	$('.flecha_esconder_dependencias').bind('click',function(event) {
		$(this).parent('.env_cont_dependencias').slideUp('fast');
		$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
	});

	$('.rt_input_dep').bind('keyup', checkInputDep);
	$('.rt_radio_dep').bind('change', checkRadioDep);
	$('.rt_link_dep').bind('click', checkLinkDep);		   

	var l_eln,
	token = $('input[name="_token"]').val();	
	$('.grupos_da_lista_click').bind('click',addGrupoExames);
	$('.exluir_grupo_click').bind('click',excluirGrupo);
	$('.exame_lista_click').bind('click',addExameLista);     

	$.post('/registro/listar-pedidos',{_token:token}, function(data, textStatus, xhr) {
		$('.env_pacientes_add_registro_totalizadores_btn').empty();
		$('.env_pacientes_add_registro_totalizadores_btn').html(data);
		atualizarCountPacExam(); 
		$('.img_x_registro_pedidos').bind('click',excluirPedido);
		$('.img_lapis_registro_pedidos').bind('click',editarPedido);       		
	});

	$.post('/listaELNrg',{_token:token}, function(data) {	  	

		l_eln = jQuery.parseJSON(data);	 

		if ($('#input_autocomplete_registro_manual').length == 1) {
			$('#input_autocomplete_registro_manual').devbridgeAutocomplete({
				lookup: l_eln,
				minChars: 2,
				width: 1097,
				onSelect: function (suggestion) {	 	     		
					$('#input_autocomplete_registro_manual').val('');

					if ($('[data-cod="'+suggestion.data[0]+'"]').length ==0) {

						if (suggestion.data[4] == '') {
							switch(suggestion.data[2]) {
								case '3':	    		    	
								var nova = $('.modelo_exame_c').clone().first();
								nova.removeClass('modelo_exame_c');
								nova.addClass('env_exame_dependecias_add_registro');
								nova.find('.span_exame_val').text(suggestion.value);
								nova.find('.span_amostra_exame_val').text(suggestion.data[3]);
								nova.find('.uniq_cod_exam').attr('data-codnome', suggestion.value);
								nova.find('.uniq_cod_exam').attr('data-cod', suggestion.data[0]);
								nova.appendTo('.exames_selecionados');
								break;
								case '2':
								var nova = $('.modelo_exame_r').clone().first();
								nova.removeClass('modelo_exame_r');
								nova.addClass('env_exame_dependecias_add_registro');
								nova.find('.span_exame_val').text(suggestion.value);
								nova.find('.span_amostra_exame_val').text(suggestion.data[3]);
								nova.find('.uniq_cod_exam').attr('data-codnome', suggestion.value);
								nova.find('.uniq_cod_exam').attr('data-cod', suggestion.data[0]);
								nova.appendTo('.exames_selecionados');
								break; 
								case '1':
								 var nova = $('.modelo_exame_ta').clone().first();
								nova.removeClass('modelo_exame_ta');
								nova.addClass('env_exame_dependecias_add_registro');
								nova.find('.span_exame_val').text(suggestion.value);
								nova.find('.span_amostra_exame_val').text(suggestion.data[3]);
								nova.find('.uniq_cod_exam').attr('data-codnome', suggestion.value);
								nova.find('.uniq_cod_exam').attr('data-cod', suggestion.data[0]);
								nova.appendTo('.exames_selecionados');
								break;   	
							}
							$('.x_apaga_exame_selecionado').bind('click',function(event) {
								$(this).parent().remove();					
							});
							$('.abre_dependenecias_registro').bind('click',function(event) {
							$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
							$(this).hide();      	
							});
							$('.flecha_esconder_dependencias').bind('click',function(event) {
							$(this).parent('.env_cont_dependencias').slideUp('fast');
							$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
							});  

						}else{
							// suggestion.data[4] = suggestion.data[4]+';Arquivo|asdasd;Enviou|Radio;Arquivo|Input';
							var dep = suggestion.data[4].split(';');	 			
							var nova = $('.modelo_exame_vp').clone().first();
							nova.removeClass('modelo_exame_vp');
							nova.addClass('env_exame_dependecias_add_registro');
							nova.find('.span_exame_val').text(suggestion.value);
							nova.find('.span_amostra_exame_val').text(suggestion.data[3]);
							nova.find('.uniq_cod_exam').attr('data-codnome', suggestion.value);
							nova.find('.uniq_cod_exam').attr('data-cod', suggestion.data[0]);

							switch(suggestion.data[2]) {
								case '3':	    		    	
								nova.find('.uniq_cod_exam').attr('data-tip', 'c');
								break;
								case '2':
								nova.find('.uniq_cod_exam').attr('data-tip', 'r');
								break; 
								case '1':
								nova.find('.uniq_cod_exam').attr('data-tip', 'ta');
								break;   	
							}

							for (var i = 0; i < dep.length; i++) {
								var aux = dep[i].split('|');
								if (aux[1] == 'Input') {
									var str = aux[0].toLowerCase();
									if (str.slice(0,2) == 'vo') {
										nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"> ml</label>');
									}else{
										nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"></label>');
									}
								}else if (aux[1] == 'Radio') {
									nova.find('.form_dependencias_exame').append('<label class="radio_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+'<input type="radio" name="confirmacao'+i+'" value="1"class="rt_radio_dep">Sim<input type="radio" name="confirmacao'+i+'" value="0" class="rt_radio_dep">Não</label>');
								}else{
									nova.find('.form_dependencias_exame').append('<div class="env_bot_link_externo_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0"><a href="" class="rt_link_dep">'+aux[0]+'</a></div>')
								}
							};

							nova.appendTo('.exames_selecionados');
							$('.x_apaga_exame_selecionado').bind('click',function(event) {
								$(this).parent().remove();					
							});
							$('.abre_dependenecias_registro').bind('click',function(event) {
								$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
								$(this).hide();      	
							});
							$('.flecha_esconder_dependencias').bind('click',function(event) {
								$(this).parent('.env_cont_dependencias').slideUp('fast');
								$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
							});

							$('.rt_input_dep').bind('keyup', checkInputDep);		      	  
							$('.rt_radio_dep').bind('change', checkRadioDep);	
							$('.rt_link_dep').bind('click', checkLinkDep);		      	  
						}	 			 	
					};	
				}
			});
		}
	});

	//Limpar Campos
	function limparCampos(){
		$('.border-red-input').removeClass('border-red-input');
		$('.exames_selecionados').empty();
		$(':text').val('');
		$('select[name="sexo"]').val('0');
	}

	$('.btn_limpar_campos_paciente_registro_manual').click(function(event) {
		event.preventDefault();
		limparCampos();
	});	

	//Envio Formulario Registro
	$('.btn_add_paciente_registro_manual').click(function(event) {
		event.preventDefault();

		$('.msg_sucesso').hide();
		$('.msg_falhar').hide();
		$('.border-red-input').removeClass('border-red-input');

		var	nome = $('input[name="nome"]').val(),
		sobrenome = $('input[name="sobrenome"]').val(),
		dataNascimento = $('input[name="dataNascimento"]').val(),
		sexo = $('select[name="sexo"] option:selected').val(),
		referenciaInterna = $('input[name="referenciaInterna"]').val(),
		numeroEtiquetas = $('input[name="numeroEtiquetas"]').val(),
		nhc = '',
		medicoSolicitante = $('input[name="medicoSolicitante"]').val(),
		local = $('input[name="local"]').val(),
		exames = '';
		token = $('input[name="_token"]').val();

		if ($('input[name="nhc"]').length == 1) {
			nhc = $('input[name="nhc"]').val();
		}

		var bool_erro = false;

		if ($.trim(nome) == '') {
			bool_erro = true;
			$('input[name="nome"]').addClass('border-red-input');
		}
		if ($.trim(sobrenome) == '') {
			bool_erro = true;
			$('input[name="sobrenome"]').addClass('border-red-input');

		}
		if ($.trim(dataNascimento) == '') {
			bool_erro = true;
			$('input[name="dataNascimento"]').addClass('border-red-input');

		}
		if (sexo == '0') {
			bool_erro = true;
			$('select[name="sexo"]').addClass('border-red-input');

		}
		if (referenciaInterna == '') {
			bool_erro = true;
			$('input[name="referenciaInterna"]').addClass('border-red-input');
		}
		if (bool_erro) {
			exibirMensagem('.alerta_msg_campos');
		}else{
			if ($('.exame_add_vp_registro').length > 1) {
				exibirMensagem('.alerta_msg_dependencias');
			}else{	      
				$('.env_exame_dependecias_add_registro').each(function() {
					var cod = '',
					dep = '';

					cod = '^'+$(this).find('.uniq_cod_exam').attr('data-cod');

					if ($(this).find('.uniq_cod_exam').hasClass('isvp')) {

						$(this).find('.input_dependencias_exame').each(function() {      				
							dep = dep+'$'+$(this).attr('data-label') +'|'+ $(this).find('input[name="dependencia"]').val();
						});

						$(this).find('.radio_dependencias_exame').each(function() {      				
							dep = dep+'$'+$(this).attr('data-label') +'|'+ $(this).find('input:radio:checked').val();
						});

						cod = cod+dep;
					};
					exames = exames+cod;
				});  

				if ($.trim(exames) == ''){
					exibirMensagem('.alerta_msg_exames');
				}else {    	

					$.post('/registro/adicionar-paciente', {nome:nome,sobrenome:sobrenome,dataNascimento:dataNascimento,sexo:sexo,referenciaInterna:referenciaInterna,numeroEtiquetas:numeroEtiquetas,nhc:nhc,medicoSolicitante:medicoSolicitante,local:local,exames:exames,_token:token}, function(data, textStatus, xhr) {
						if (data == '1') {
							exibirMensagem('.alerta_msg_enviado');
							limparCampos();
							atualizarPets();
						}else{
							exibirMensagem('.alerta_msg_erro');
						}
						modoInsert();  
					});
				}
			}
		}
	}); 


	//Criar Grupo
	$('.form_criar_grupo_solicitacoes').submit(function(event) {
		event.preventDefault();

		$('.grupo_criado_falha').hide();
		$('.grupo_criado_sucesso').hide();

		var nome = $('input[name="nomeGrupo"]').val(),
		exames = '',
		nomesGrupos = '',
		token = $('input[name="_token"]').val();

		if (nome == '') {
			$('.grupo_criado_falha_vazio').show();
		}else{
			$('.env_exame_dependecias_add_registro').each(function() {
				var cod = '';     		
				cod = $(this).find('.uniq_cod_exam').attr('data-cod')+'#';      		
				exames = exames+cod;
			 }); 

			if (exames == '') {
				$('.grupo_criado_falha_exames').show();
			}else{				
				
				$('.grupo_solicitacoes .nomeGrupo').each(function() {
					nomesGrupos = nomesGrupos+$(this).text()+'#'; 
				});

				var arrayNomes = nomesGrupos.split('#');	
				
				if(arrayNomes.indexOf(nome.trim()) >= 0){
					$('.grupo_criado_falha_existe').show();
				}else{
					$.post('/registro/criar-grupo',{nome:nome.trim(),exames:exames,_token:token}, function(data, textStatus, xhr) {
						if (data == '0') {
							$('.grupo_criado_falha_erro').show();
						}else{
							$('.grupo_criado_sucesso').show();
							$('.grupo_solicitacoes').empty();
							$('.grupo_solicitacoes').html($('.txt_carregando_gru_lis').show());
							$('input[name="nomeGrupo"]').val('');
							atualizarGrupos();
						}
					});
				}			
			}
		}
	});

	
	function excluirGrupo(event){
		event.preventDefault();

		var r = confirm($('.alert_excluir_grupo').text());

		if (r == true) {
			var nome = $(this).parent().find('.grupos_da_lista_click').find('span').text(),
			token = $('input[name="_token"]').val();

			$.post('/registro/excluir-grupo',{nome:nome,_token:token}, function(data, textStatus, xhr) {		      		
				$('.grupo_solicitacoes').empty();
				$('.grupo_solicitacoes').html('Loading...');		      			
				atualizarGrupos();	    
			});
		}
	}

	//Adicionar Grupo aos exames
	function addGrupoExames(event) {
		event.preventDefault();			

		var exames = new Array(),
		exames_usados = new Array(),
		it = 0;

		$(this).parent().children('div').children('.exames_do_grupo').each(function() {
			exames[it] = $(this).text();			
			it++;
		});

		for (var i = 0; i < exames.length; i++) {
			var aux = exames[i];			
			exames_usados[i] = $('[data-findexam="'+aux+'"]').attr('data-info');
		};		

		for (var ie = 0; ie < exames_usados.length; ie++) {
			var eu = exames_usados[ie];
			value = '';
			data = new Array();

			aux = eu.split('#');

			value = aux[0];
			data[0] = aux[1];
			data[1] = aux[2];
			data[2] = aux[3];
			data[3] = aux[4];
			data[4] = aux[5];
			data[5] = aux[6];			

			if ($('[data-cod="'+data[0]+'"]').length ==0) {

				if (data[4] == '') {
					switch(data[2]) {
						case '3':	    		    	
						var nova = $('.modelo_exame_c').clone().first();
						nova.removeClass('modelo_exame_c');
						nova.addClass('env_exame_dependecias_add_registro');
						nova.find('.span_exame_val').text(value);
						nova.find('.span_amostra_exame_val').text(data[3]);
						nova.find('.uniq_cod_exam').attr('data-codnome', value);
						nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
						nova.appendTo('.exames_selecionados');
						break;
						case '2':
						var nova = $('.modelo_exame_r').clone().first();
						nova.removeClass('modelo_exame_r');
						nova.addClass('env_exame_dependecias_add_registro');
						nova.find('.span_exame_val').text(value);
						nova.find('.span_amostra_exame_val').text(data[3]);
						nova.find('.uniq_cod_exam').attr('data-codnome', value);
						nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
						nova.appendTo('.exames_selecionados');
						break; 
						case '1':
						 var nova = $('.modelo_exame_ta').clone().first();
						nova.removeClass('modelo_exame_ta');
						nova.addClass('env_exame_dependecias_add_registro');
						nova.find('.span_exame_val').text(value);
						nova.find('.span_amostra_exame_val').text(data[3]);
						nova.find('.uniq_cod_exam').attr('data-codnome', value);
						nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
						nova.appendTo('.exames_selecionados');
						break;   	
					}
					$('.x_apaga_exame_selecionado').bind('click',function(event) {
						$(this).parent().remove();					
					});
					$('.abre_dependenecias_registro').bind('click',function(event) {
					$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
					$(this).hide();      	
					});
					$('.flecha_esconder_dependencias').bind('click',function(event) {
					$(this).parent('.env_cont_dependencias').slideUp('fast');
					$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
					});  

				}else{
					//data[4] = data[4]+';Arquivo|asdasd;Enviou|Radio;Arquivo|Input';
					var dep = data[4].split(';');	 			
					var nova = $('.modelo_exame_vp').clone().first();
					 nova.removeClass('modelo_exame_vp');
					 nova.addClass('env_exame_dependecias_add_registro');
					 nova.find('.span_exame_val').text(value);
					 nova.find('.span_amostra_exame_val').text(data[3]);
					 nova.find('.uniq_cod_exam').attr('data-codnome', value);
					 nova.find('.uniq_cod_exam').attr('data-cod', data[0]);

					 switch(data[2]) {
						case '3':	    		    	
						nova.find('.uniq_cod_exam').attr('data-tip', 'c');
						break;
						case '2':
						nova.find('.uniq_cod_exam').attr('data-tip', 'r');
						break; 
						case '1':
						nova.find('.uniq_cod_exam').attr('data-tip', 'ta');
						break;   	
					}

					for (var i = 0; i < dep.length; i++) {
						var aux = dep[i].split('|');
						if (aux[1] == 'Input') {
							var str = aux[0].toLowerCase();
							if (str.slice(0,2) == 'vo') {
							nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"> ml</label>');

							}else{
							nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"></label>');
						}

						}else if (aux[1] == 'Radio') {
							nova.find('.form_dependencias_exame').append('<label class="radio_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+'<input type="radio" name="confirmacao'+i+'" value="1"class="rt_radio_dep">Sim<input type="radio" name="confirmacao'+i+'" value="0" class="rt_radio_dep">Não</label>');
						}else{
							nova.find('.form_dependencias_exame').append('<div class="env_bot_link_externo_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0"><a href="" class="rt_link_dep">'+aux[0]+'</a></div>')
						}
					};



					nova.appendTo('.exames_selecionados');
					$('.x_apaga_exame_selecionado').bind('click',function(event) {
						$(this).parent().remove();					
					});
					$('.abre_dependenecias_registro').bind('click',function(event) {
					$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
						$(this).hide();      	
						});
						$('.flecha_esconder_dependencias').bind('click',function(event) {
					$(this).parent('.env_cont_dependencias').slideUp('fast');
					$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
					});

					$('.rt_input_dep').bind('keyup', checkInputDep);
					$('.rt_radio_dep').bind('change', checkRadioDep);
					$('.rt_link_dep').bind('click', checkLinkDep);		      	  

				}
			}	 			 	
		};	
		
	};

	function checkInputDep(){			
		var auxInputDep = $(this).val();
		$(this).val($.trim(auxInputDep));		
		if ($(this).val() == '') {
		   $(this).parent().attr('data-vp', '0');
		}else{
		   $(this).parent().attr('data-vp', '1');
		}
		
		var bool_dep = false;
		$(this).parent().parent().find('.bool_dep_exam').each(function() {
			if ($(this).attr('data-vp') == '0') {					
				bool_dep = true;
			}
		});	

		if (bool_dep == false) {

			var aux = $(this).parents('.env_exame_dependecias_add_registro').find('.uniq_cod_exam').attr('data-tip');
			switch(aux) {
				case 'c':
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_c_registro');
					aux.text('C');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_c_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_c');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_c');			       		
				break;
				case 'r':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_r_registro');
					aux.text('R');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_r_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_r');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_r');
				break;
				case 'ta':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_ta_registro');
					aux.text('TA');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_ta_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_ta');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_ta');
				break;
			}    

		}else{

			var aux = $(this).parents('.env_exame_dependecias_add_registro').find('.uniq_cod_exam').attr('data-tip');
			switch(aux) {
				case 'c':			    	    
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_c_registro');
					aux.removeClass('tc_exames_add_c_registro');
					aux.addClass('tc_exames_add_vp_registro');
					aux.text('VP');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_c_registro');
					auxlabel.removeClass('exame_add_c_registro');
					auxlabel.addClass('exame_add_vp_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_c');
					auxlabel.removeClass('env_cont_dependencias_c');
					auxlabel.addClass('env_cont_dependencias_vp');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_c');
					auxlabel.removeClass('menu_bolinhas_c');
					auxlabel.addClass('menu_bolinhas_vp');			       		
				break;
				case 'r':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_r_registro');
					aux.removeClass('tc_exames_add_r_registro');
					aux.addClass('tc_exames_add_vp_registro');
					aux.text('VP');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_r_registro');
					auxlabel.removeClass('exame_add_r_registro');
					auxlabel.addClass('exame_add_vp_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_r');
					auxlabel.removeClass('env_cont_dependencias_r');
					auxlabel.addClass('env_cont_dependencias_vp');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_r');
					auxlabel.removeClass('menu_bolinhas_r');
					auxlabel.addClass('menu_bolinhas_vp');
				break;
				case 'ta':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_ta_registro');
					aux.removeClass('tc_exames_add_ta_registro');
					aux.addClass('tc_exames_add_vp_registro');
					aux.text('VP');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_ta_registro');
					auxlabel.removeClass('exame_add_ta_registro');
					auxlabel.addClass('exame_add_vp_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_ta');
					auxlabel.removeClass('env_cont_dependencias_ta');
					auxlabel.addClass('env_cont_dependencias_vp');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_ta');
					auxlabel.removeClass('menu_bolinhas_ta');
					auxlabel.addClass('menu_bolinhas_vp');
				break;
			}   
		}				
	};

	
	function checkRadioDep(){
		$(this).parent().attr('data-vp', '1');

		var bool_dep = false;
		$(this).parent().parent().find('.bool_dep_exam').each(function() {
			if ($(this).attr('data-vp') == '0') {
				bool_dep = true;
			}
		});	

		if (bool_dep == false) {

			var aux = $(this).parents('.env_exame_dependecias_add_registro').find('.uniq_cod_exam').attr('data-tip');
			switch(aux) {
				case 'c':
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_c_registro');
					aux.text('C');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_c_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_c');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_c');			       		
				break;
				case 'r':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_r_registro');
					aux.text('R');			    		

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_r_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_r');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_r');
				break;
				case 'ta':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_ta_registro');
					aux.text('TA');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_ta_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_ta');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_ta');
				break;
			}    
		}
	};
	

	function checkLinkDep(event){		
		event.preventDefault();
		$(this).parent().attr('data-vp', '1');

		var bool_dep = false;
		$(this).parent().parent().find('.bool_dep_exam').each(function() {
			if ($(this).attr('data-vp') == '0') {
				bool_dep = true;
			}
		});	

		if (bool_dep == false) {

			var aux = $(this).parents('.env_exame_dependecias_add_registro').find('.uniq_cod_exam').attr('data-tip');
			switch(aux) {
				case 'c':
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_c_registro');
					aux.text('C');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_c_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_c');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_c');			       		
				break;
				case 'r':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_r_registro');
					aux.text('R');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_r_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_r');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_r');
				break;
				case 'ta':	    		    	
					var aux,auxlabel,auxborder,auxmenu;
					aux = $(this).parents('.env_exame_dependecias_add_registro').find('.tc_exames_add_vp_registro');
					aux.removeClass('tc_exames_add_vp_registro');
					aux.addClass('tc_exames_add_ta_registro');
					aux.text('TA');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.exame_add_vp_registro');
					auxlabel.removeClass('exame_add_vp_registro');
					auxlabel.addClass('exame_add_ta_registro');

					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.env_cont_dependencias_vp');
					auxlabel.removeClass('env_cont_dependencias_vp');
					auxlabel.addClass('env_cont_dependencias_ta');
					
					auxlabel = $(this).parents('.env_exame_dependecias_add_registro').find('.menu_bolinhas_vp');
					auxlabel.removeClass('menu_bolinhas_vp');
					auxlabel.addClass('menu_bolinhas_ta');
				break;
			}    
		}
	};



	function atualizarGrupos(){
		$.post('/registro/listar-grupos',{_token:token}, function(data, textStatus, xhr) {
			$('.grupo_solicitacoes').empty();
			$('.grupo_solicitacoes').html(data);
			$('.grupos_da_lista_click').bind('click',addGrupoExames);
			$('.exluir_grupo_click').bind('click',excluirGrupo);
		});
	}

	
	function atualizarCountPacExam(){
		var countPac = 0,
		countExam = 0;
		$('.total_exames_registro').each(function() {
			var aux = $(this).text();
			countPac++;
			countExam = countExam + parseInt(aux);
		});
		$('.count_exam').text(countExam);
		$('.count_pac').text(countPac);
		$('.bandeja_count_bottom').text(countPac);

		if (countPac > 0) {
			$('.msg_pacientes_hidden').hide();
			$('.msg_com_pacientes').show();
		}else{
			$('.msg_pacientes_hidden').hide();
			$('.msg_sem_pacientes').show();
		}
	}


	function atualizarPets(){
		 $.post('/registro/listar-pedidos',{_token:token}, function(data, textStatus, xhr) {
			$('.env_pacientes_add_registro_totalizadores_btn').empty();
				$('.env_pacientes_add_registro_totalizadores_btn').html(data);
				atualizarCountPacExam();
				$('.img_x_registro_pedidos').bind('click',excluirPedido); 
				$('.img_lapis_registro_pedidos').bind('click',editarPedido);
				atualizarCountPedido();      		
		});
	}


	function addExameLista(event) {
		event.preventDefault();			

		var exame = $(this).find('input[name ="exameListaCod"]').val(),
		exame_usado = $('[data-findexam="'+exame+'"]').attr('data-info');
		
		var eu = exame_usado;
		value = '';
		data = new Array();

		aux = eu.split('#');

		value = aux[0];
		data[0] = aux[1];
		data[1] = aux[2];
		data[2] = aux[3];
		data[3] = aux[4];
		data[4] = aux[5];
		data[5] = aux[6];			

		if ($('[data-cod="'+data[0]+'"]').length ==0) {

			if (data[4] == '') {
				switch(data[2]) {
					case '3':	    		    	
					var nova = $('.modelo_exame_c').clone().first();
					nova.removeClass('modelo_exame_c');
					nova.addClass('env_exame_dependecias_add_registro');
					nova.find('.span_exame_val').text(value);
					nova.find('.span_amostra_exame_val').text(data[3]);
					nova.find('.uniq_cod_exam').attr('data-codnome', value);
					nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
					nova.appendTo('.exames_selecionados');
					break;
					case '2':
					var nova = $('.modelo_exame_r').clone().first();
					nova.removeClass('modelo_exame_r');
					nova.addClass('env_exame_dependecias_add_registro');
					nova.find('.span_exame_val').text(value);
					nova.find('.span_amostra_exame_val').text(data[3]);
					nova.find('.uniq_cod_exam').attr('data-codnome', value);
					nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
					nova.appendTo('.exames_selecionados');
					break; 
					case '1':
					 var nova = $('.modelo_exame_ta').clone().first();
					nova.removeClass('modelo_exame_ta');
					nova.addClass('env_exame_dependecias_add_registro');
					nova.find('.span_exame_val').text(value);
					nova.find('.span_amostra_exame_val').text(data[3]);
					nova.find('.uniq_cod_exam').attr('data-codnome', value);
					nova.find('.uniq_cod_exam').attr('data-cod', data[0]);
					nova.appendTo('.exames_selecionados');
					break;   	
				}
				$('.x_apaga_exame_selecionado').bind('click',function(event) {
					$(this).parent().remove();					
				});
				$('.abre_dependenecias_registro').bind('click',function(event) {
				$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
					$(this).hide();      	
					});
					$('.flecha_esconder_dependencias').bind('click',function(event) {
				$(this).parent('.env_cont_dependencias').slideUp('fast');
				$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
					});  

				}else{
					//data[4] = data[4]+';Arquivo|asdasd;Enviou|Radio;Arquivo|Input';
					var dep = data[4].split(';');	 			
					var nova = $('.modelo_exame_vp').clone().first();
				 nova.removeClass('modelo_exame_vp');
				 nova.addClass('env_exame_dependecias_add_registro');
				 nova.find('.span_exame_val').text(value);
				 nova.find('.span_amostra_exame_val').text(data[3]);
				 nova.find('.uniq_cod_exam').attr('data-codnome', value);
				 nova.find('.uniq_cod_exam').attr('data-cod', data[0]);

				switch(data[2]) {
					case '3':	    		    	
					nova.find('.uniq_cod_exam').attr('data-tip', 'c');
					break;
					case '2':
					nova.find('.uniq_cod_exam').attr('data-tip', 'r');
					break; 
					case '1':
					nova.find('.uniq_cod_exam').attr('data-tip', 'ta');
					break;   	
				}

				for (var i = 0; i < dep.length; i++) {
					var aux = dep[i].split('|');
					if (aux[1] == 'Input') {
						var str = aux[0].toLowerCase();
						if (str.slice(0,2) == 'vo') {
						nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"> ml</label>');
						}else{
						nova.find('.form_dependencias_exame').append('<label class="input_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+': <input type="text" name="dependencia" class="rt_input_dep"></label>');
						}
					}else if (aux[1] == 'Radio') {
						nova.find('.form_dependencias_exame').append('<label class="radio_dependencias_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0">'+aux[0]+'<input type="radio" name="confirmacao'+i+'" value="1"class="rt_radio_dep">Sim<input type="radio" name="confirmacao'+i+'" value="0" class="rt_radio_dep">Não</label>');
					}else{
						nova.find('.form_dependencias_exame').append('<div class="env_bot_link_externo_exame bool_dep_exam" data-label="'+aux[0]+'" data-vp="0"><a href="" class="rt_link_dep">'+aux[0]+'</a></div>')
					}
				};

				nova.appendTo('.exames_selecionados');
				$('.x_apaga_exame_selecionado').bind('click',function(event) {
					$(this).parent().remove();					
				});
				$('.abre_dependenecias_registro').bind('click',function(event) {
					$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
					$(this).hide();      	
				});
					$('.flecha_esconder_dependencias').bind('click',function(event) {
					$(this).parent('.env_cont_dependencias').slideUp('fast');
					$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
				});

				$('.rt_input_dep').bind('keyup', checkInputDep);
				$('.rt_radio_dep').bind('change', checkRadioDep);
				$('.rt_link_dep').bind('click', checkLinkDep);		      	  
			}
		}	 			 	
	};


	function excluirPedido(event) {
		event.preventDefault();
		var r = confirm($('.alert_excluir_pedido').text());

		if (r == true) {
			var pedido = $(this).parent().find('input[name="petCod"]').val();	
			$.post('/bandeja/excluir-pedido',{_token:token,pedido:pedido}, function(data, textStatus, xhr){
				limparCampos();
				modoInsert();
				atualizarPets();
			});	
		}	
	}



	//**********************************************************************************************
	//                                          Edição
	//**********************************************************************************************

	function editarPedido(event) {
		event.preventDefault();
		var pedido = $(this).parent().find('input[name="petCod"]').val();
		$(this).parent().parent().addClass('pedido_sendo_editado');
		$.post('/bandeja/editar-pedido',{_token:token,pedido:pedido}, function(data, textStatus, xhr){
			if (data != '0') {
				limparCampos();
				modoEdit();

				$('.exames_selecionados').html(data);

				var aux = $('input[name="editPet"]').val(),
				dataPet = '';

				dataPet = aux.split(',');

				$('input[name="nome"]').val(dataPet[1]);
				$('input[name="sobrenome"]').val(dataPet[2]);
				$('input[name="dataNascimento"]').val(dataPet[3]);
				$('select[name="sexo"] option[value="'+dataPet[4]+'"]').prop('selected', true);
			  
				$('input[name="referenciaInterna"]').val(dataPet[5]);
				$('input[name="numeroEtiquetas"]').val(dataPet[6]);
				if ($('input[name="nhc"]').length == 1) {
					$('input[name="nhc"]').val(dataPet[7]);
				}		      	
				$('input[name="medicoSolicitante"]').val(dataPet[8]);
				$('input[name="local"]').val(dataPet[9]);

				$('.x_apaga_exame_selecionado').bind('click',function(event) {
					$(this).parent().remove();					
				});
				$('.abre_dependenecias_registro').bind('click',function(event) {
				$(this).parent().find('.env_cont_dependencias').slideDown('fast');	      			
				$(this).hide();      	
				});
				$('.flecha_esconder_dependencias').bind('click',function(event) {
				$(this).parent('.env_cont_dependencias').slideUp('fast');
				$(this).parent().parent().find('.abre_dependenecias_registro').show();      	
				});

				$('.rt_input_dep').bind('keyup', checkInputDep);
				$('.rt_radio_dep').bind('change', checkRadioDep);
				$('.rt_link_dep').bind('click', checkLinkDep);
			}   
		});	
	}


	function modoEdit(){
		$('.div_form_registro_modo_insert').hide();
		$('.div_form_registro_modo_edit').show();
		$('input[name="numeroEtiquetas"]').prop('disabled',true);
		$('.btn_limpar_campos_paciente_registro_manual').unbind('click');
		$('.btn_limpar_campos_paciente_registro_manual').bind('click',function(event) {
			event.preventDefault();
			$.post('/bandeja/cancelar-alteracoes',{_token:token}, function(data, textStatus, xhr){
				modoInsert();
			});
			limparCampos();
			modoInsert();
		});
	}      


	function modoInsert(){
		$('.pedido_sendo_editado').removeClass('pedido_sendo_editado');
		$('.div_form_registro_modo_edit').hide();
		$('.div_form_registro_modo_insert').show();	
		$('input[name="numeroEtiquetas"]').prop('disabled',false);
		$('.btn_limpar_campos_paciente_registro_manual').unbind('click');
		$('.btn_limpar_campos_paciente_registro_manual').bind('click',function(event) {
			event.preventDefault();
			limparCampos();
		});	
	} 


	function atualizarCountPedido(){
		$.post('/bandeja/atualizar-count' ,{_token:token},function(data, textStatus, xhr) {
			$('.top_count_pet').empty();	
			$('.top_count_pet').text(data);			
		});
	}


	/*Mostra exames vinculados ao pacientes na bandeja do registro manual*/ 
	$(document).delegate('.img_olho_registro', 'click', function(event) {
		if($(this).hasClass('olho_bandeja_clicado')){
			$(this).removeClass('olho_bandeja_clicado');	
			$(this).parents('.linha_pacientes_adicionados_registro').find('.exames_vinculados_paciente_registro').slideUp('fast');
			$('.btn_pacientes_exames').removeClass('btn_pacientes_exames_clicado');
		}else{
			$(this).addClass('olho_bandeja_clicado');
			$(this).parents('.linha_pacientes_adicionados_registro').find('.exames_vinculados_paciente_registro').slideDown('fast');	
		}
	});
	/*Fim da mostra exames vinculados ao pacientes na bandeja do registro manual*/  

	function exibirMensagem(alerta) {
		$(alerta).show();
		$('.modal_mensagens').fadeIn('fast');
		$('.telaoscura_mensagens').fadeIn('fast');
	}  


	$('input[name="dataNascimento"]').inputmask("99/99/9999");  


	//Enviar os pedidos desde a bandeja do registro manual.
	$(document).delegate('.bt_enviar_pedidos', 'click', function(event) {
		event.preventDefault();
		$.post('/bandeja/enviar-pedidos',{_token:token}, function(data, textStatus, xhr) {
			if (data == '1') {
				limparCampos();
				modoInsert();
				atualizarPets();
				exibirMensagem('.alerta_msg_enviados');
			}else{
				exibirMensagem('.alerta_msg_falha_envio');
			}
		});
	});

});
