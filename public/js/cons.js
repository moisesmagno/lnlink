$(document).ready(function() {

	/* ******************************************************************************
	                       	    PAGINA DE RESULTADOS
	****************************************************************************** */

	function checkAll(event){
		if($(this).prop( "checked" )){
			$('.result_checkbox_ped').prop('checked', true);
		}else{
			$('.result_checkbox_ped').prop('checked', false);
		}
    };   	

	// Abre a opção de menus de cada linha de resultado.
	function exibirOpcoesResultado(event) {
		if($(this).hasClass('bt_op_resultados_clicado')){
			$(this).removeClass('bt_op_resultados_clicado');
			$(this).parents('.env_linha_conteudos').find('.conteudo_opcoes_resultados').slideUp();
			$('.linha_resultado').css({'border-botton': '2px solid rgba(0,0,0,0.1)'});
			$(this).parents('.opcoes_resultados').find('.op_azul_resultados_fx').show();
			$(this).parents('.opcoes_resultados').find('.op_branco_resultados_fx').hide();
		}else{
			$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideUp(250, function() {
			$(this).parents('.env_linha_conteudos').find('.olho_resultados_fx').removeClass('bt_gerais_resultados_clicado');
			});
			$('.op_branco_resultados_fx').addClass('bt_op_resultados_clicado');	
			$(this).parents('.opcoes_resultados').find('.op_azul_resultados_fx').hide();
			$(this).parents('.opcoes_resultados').find('.op_branco_resultados_fx').show();
			$('.linha_resultado').css({border: '0px'});
			$(this).parents('.env_linha_conteudos').find('.conteudo_opcoes_resultados').slideDown();

		}
	};// Fim da abertura da opção de menus de cada linha de resultado.

	// Abre os resultados do paciente em tela
	function exibirResultadosTela(event) {		
		if($(this).hasClass('bt_gerais_resultados_clicado')){
			$(this).removeClass('bt_gerais_resultados_clicado');	
			$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideUp();
		}else{
			$(this).addClass('bt_gerais_resultados_clicado');
			$(this).parents('.env_linha_conteudos').find('.conteudo_opcoes_resultados').slideUp(function() {
				$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideDown();				
			});
			$(this).parents('.opcoes_resultados').find('.op_azul_resultados_fx').show();
			$(this).parents('.opcoes_resultados').find('.op_branco_resultados_fx').hide();
		}
	};// Fim da abertura dos resultados do paciente em tela

	// Abre a continuação da linha de resultado
	function exibirRestanteResultado(event) {
		if($(this).hasClass('bt_gerais_resultados_clicado')){
			$(this).parents('.env_linha_conteudos').find('.olho_complemento_responsivo').removeClass('bt_gerais_resultados_clicado');
			$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideUp(function(){
				$(this).parents('.env_linha_conteudos').find('.complemento_resultado_responsivos').css({'margin-bottom': '0px'}).slideUp();	
			});
			$(this).removeClass('bt_gerais_resultados_clicado');
		}else{
			$(this).addClass('bt_gerais_resultados_clicado');
			$(this).parents('.env_linha_conteudos').find('.complemento_resultado_responsivos').css({'margin-bottom': '10px'}).slideDown();
		}
	};
	// Fim da abertura a continuação da linha de resultado

	//Abre os resultados com o olho dentro do complemento que continua a linha de resultado.
	function exibirResultadosResponsivo(event) {
		if($(this).hasClass('bt_gerais_resultados_clicado')){
			$(this).removeClass('bt_gerais_resultados_clicado');
			
			$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideUp(function(){
				$(this).parents('.env_linha_conteudos').find('.complemento_resultado_responsivos').css({'margin-bottom': '10px'});	
			});
		}else{
			$(this).addClass('bt_gerais_resultados_clicado');

			$(this).parents('.env_linha_conteudos').find('.complemento_resultado_responsivos').css({'margin-bottom': '0px'});
			$(this).parents('.env_linha_conteudos').find('.conteudo_resultados_pacientes_tela').slideDown();
		}
	};
	//Fecha os resultados com o olho dentro do complemento que continua a linha de resultado.


	// Abre e fehas as opções escolhidas
	$('#opcao_escolhida').change(function(event) {
		var arrayOpcoes = ["nomePaciente", "referenciaCliente", "referenciaNous", "nhc", "exame", "dtRegistro", "dtLiberacao", "urgencaSolicitada", "pedidoSeguimento", "selecione"];
	
		if($.inArray($(this).val(), arrayOpcoes) !== -1){
			
			$('.opFiltro').slideUp();

			var op = $(this).val();
			switch(op){
				case "nomePaciente":
					$('.form_opcao_busca_nome').slideDown();
					break;
				case "referenciaCliente":
					$('.form_opcao_busca_referencia_cliente').slideDown();
					break;
				case "referenciaNous":
					$('.form_opcao_busca_referencia_nous').slideDown();
					break;
				case "nhc":
					$('.form_opcao_busca_nhc').slideDown();
					break;
				case "exame":
					$('.form_opcao_busca_exame').slideDown();
					break;
				case "dtRegistro":
					$('.form_opcao_busca_data_registro').slideDown();
					break;
				case "dtLiberacao":
					$('.form_opcao_busca_data_liberacao').slideDown();
					break;
				case "urgencaSolicitada":
					$('.form_opcao_busca_urgencia_solicitada').slideDown();
					break;
				case "pedidoSeguimento":
					$('.form_opcao_busca_pedidos_seguidos').slideDown();
					break;	
				case "selecione":
					$('.texto_busca_resultados').slideDown();
					break;									
			}

			if($('.esconde_mostra_cx_opcoes').hasClass('clicado')){
				// alert('esconde_mostra_cx_opcoes clicado.');
				$('.esconde_mostra_cx_opcoes').removeClass('clicado');
				$('.env_opcoes_busca').slideUp(function(){
					$('.env_opcoes_busca').slideDown();
					$('.env_opcoes_busca').height('auto').fadeIn();
					$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(180deg)'});
				});	
			}

		}else{
			alert('Esta opção de busca não existe!');
		}
	});
	// fim da abertura e fehamento das opções escolhidas	
	
	// Minimiza e maximiza a caixa que envolve as opções de busca.
	$('.esconde_mostra_cx_opcoes').click(function(event) {

		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			$('.env_opcoes_busca').slideUp(function(){
				$('.env_opcoes_busca').slideDown();
				$('.env_opcoes_busca').height('auto').fadeIn();
				$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(180deg)'});
			});
		}else{
			$(this).addClass('clicado');
			$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
			$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});
		}
	});// Fim do envento que minimiza e maximiza a caixa que envolve as opções de busca.
	

	// Ordenar o os reultados de forma ascendente e descendente.
	function listaTabela(event) {					
		
		var resultado = $('.env_todas_linhas_resultados'),
		    linhas = $('.env_linha_conteudos'),
		    alvo = '',
		    alvo2 = '';
		
		if ($(this).hasClass('tt_paciente_resultado')) {
			alvo = '.pacientes_resultados';
			alvo2 = 'span';
		}else if($(this).hasClass('tt_dtRegistro_resultado')) {
			alvo = '.dt_registro_resultados';
			alvo2 = '.span-hidden';	
		}else if($(this).hasClass('tt_dtLiberacao_resultado')) {
			alvo = '.dt_liberacao_resultados';
			alvo2 = '.span-hidden';
		}else if($(this).hasClass('tt_referencia_resultado')) {
			alvo = '.referencias_resultados';
			alvo2 = 'span';					
		}else if($(this).hasClass('tt_pedido_nous_resultado')) {
			alvo = '.pedido_nous';
			alvo2 = 'span';				
		}else if($(this).hasClass('tt_status_resultado')) {	
			alvo = '.status_resultados';
			alvo2 = 'span';				
		}

		if ($(this).hasClass('listado-asc')) {

			linhas.sort(function(a,b){
				var an = $(a).find(alvo).find(alvo2).text(),
					bn = $(b).find(alvo).find(alvo2).text();

					an = an.toUpperCase();
					bn = bn.toUpperCase();

				if(an < bn) {
					return 1;
				}
				if(an > bn) {
					return -1;
				}
				return 0;
			});

			$(".tt-click").removeClass('listado-asc');	

		}else{

			linhas.sort(function(a,b){
				var an = $(a).find(alvo).find(alvo2).text(),
					bn = $(b).find(alvo).find(alvo2).text();
					an = an.toUpperCase();
					bn = bn.toUpperCase();

				if(an > bn) {
					return 1;
				}
				if(an < bn) {
					return -1;
				}
				return 0;
			});

			$(".tt-click").removeClass('listado-asc');		
			$(this).addClass('listado-asc');
		}

		linhas.appendTo(resultado);		
	};
	// Fim da ordenar o os reultados de forma ascendente e descendente.

	// Gerar planilhas Excel.
	function exportarExcel(event){
		var resultados = '',token = $('input[name="_token"]').val();

		if ($('.result_checkbox_ped:checked').length > 0) {

			$('.result_checkbox_ped:checked').each(function() {
				var aux = '';
				var linha = $(this).parent().parent().parent();			
				aux = aux + linha.children('.pacientes_resultados').children('span').text()+'#';
				aux = aux + linha.children('.dt_registro_resultados').children('span').first().text()+'#';
				aux = aux + linha.children('.dt_liberacao_resultados').children('span').first().text()+'#';
				aux = aux + linha.children('.referencias_resultados').children('span').text()+'#';
				aux = aux + linha.children('.pedido_nous').children('span').text()+'#';
				aux = aux + linha.children('.status_resultados').children('span').text();
				resultados = resultados + aux +'^';
			});

			$.post('/consulta/planilha',{resultados:resultados,_token:token}, function(data) {			
				window.location.assign("/consulta/dl-planilha/"+data);				
			});

		}else{
			exibirMensagem('.alerta_msg_selecionar');
		}
	};



	// Imprimir resultados.
	function imprimirResultados(event){

		var resultados = '',token = $('input[name="_token"]').val();

		if ($('.result_checkbox_ped:checked').length > 0) {
			$('.result_checkbox_ped:checked').each(function() {
				if ($(this).parent().parent().parent().children('.input_hidden_lib_p').val() == '2') {
					var aux = '';
					var linha = $(this).parent().parent().parent().parent();			
					aux = aux + linha.find('.pacientes_resultados').children('span').text()+'#';
					aux = aux + linha.find('.dt_registro_resultados').children('span').first().text()+'#';
					aux = aux + linha.find('.dt_liberacao_resultados').children('span').first().text()+'#';
					aux = aux + linha.find('.referencias_resultados').children('span').text()+'#';
					aux = aux + linha.find('.pedido_nous').children('span').text()+'#';
					aux = aux + linha.find('.status_resultados').children('span').text()+'#';
					aux = aux + linha.find('.conteudo_resultados_pacientes_tela').html();
					resultados = resultados + aux +'^';
				}
			});		

			$.post('/consulta/gerar-impressao',{pedidos:resultados,_token:token}, function(data) {				
					window.open("/consulta/print","_blank");						
			});
		}else{
			exibirMensagem('.alerta_msg_selecionar');
		}
	};

	
	//Download de arquivo de integração.
	function baixarArqInt(event){

		var pedidos = '',token = $('input[name="_token"]').val();

		if ($('.result_checkbox_ped:checked').length > 0) {

			$('.result_checkbox_ped:checked').each(function() {
				pedidos = pedidos+$(this).val()+',';
			});		
			$.post('/consulta/gerar-download',{pedidos:pedidos,_token:token}, function(data) {				
					window.location.assign("/consulta/download");						
			});
		}else{
			exibirMensagem('.alerta_msg_selecionar');
		}
	};


	//Gera PDFs
	function gerarPDFs(event){
		var pedidos = '',token = $('input[name="_token"]').val();

		if ($('.result_checkbox_ped:checked').length > 0) {
			$('.result_checkbox_ped:checked').each(function() {				
				pedidos = pedidos+$(this).val()+',';
			});
			$.post('/consulta/flashped',{pedidos:pedidos,_token:token}, function(data) {			
				window.open("/consulta/pdf","_blank");				
			});
		}else{
			exibirMensagem('.alerta_msg_selecionar');
		}
	};	

	//Gerar PDF
	function gerarPDF(event){
		var pedidos = '',token = $('input[name="_token"]').val();

		pedidos = $(this).parent().children('input').val();

		$.post('/consulta/flashped',{pedidos:pedidos,_token:token}, function(data) {			
			window.open("/consulta/pdf","_blank");				
		});
	
	};

	//ASSOCIAR MÉTODOS AOS OBJETOS JQUERY DA TABELA.
	function bindFunctions() {
		$('.tt-click').bind('click', listaTabela);
		$('.olho_resultados_fx').bind('click', exibirResultadosTela);
		$('.clicar_btn_opcoes').bind('click', exibirOpcoesResultado);
		$('.chama_modal_acompanhar_pedido').bind('click' ,exibirModalAcompanharPedido);
		$('.chama_modal_solicitar_urgencia').bind('click' ,exibirModalSolicitarUrgencia);
		$('.chama_modal_cancelar_totalmente_pedido').bind('click' ,exibirModalCancelarPedido);
		$('.chama_modal_cancelar_exame').bind('click' ,exibirModalCancelarExame);
		$('.chama_modal_incluir_exame').bind('click' ,exibirModalIncluirExame);
		$('.ver_restante_resultado').bind('click', exibirRestanteResultado);
		$('.olho_complemento_responsivo').bind('click', exibirResultadosResponsivo);
		$('.checkbox_ped').bind('click',checkAll);
		$('.exportar_excel').bind('click',exportarExcel);
		$('.imprimir_laudos').bind('click',gerarPDFs);
		$('.baixar_arquivo_click_con').bind('click',baixarArqInt);
		$('.imprimir_resultados').bind('click',imprimirResultados);
		$('.imprimir_laudo').bind('click',gerarPDF);
		};


	//Mostrar mais DataRegistro.
	function mostrarMaisDataRegistro(event) {	
		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});

			var param = $(this).attr('data-param');	
			param = param.split('#');

			var dtInicial = param[0],
			dtFinal = param[1],
			filtro = param[2],
			token = $('input[name="_token"]').val();		

			$('.env_botoes_resultados_conteudos').empty();

			$.post('/consulta/dt-registro',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'2000'} , function(data, textStatus, xhr) {
			
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
		});
	};		


	//Enviar formulário DataRegistro
	$('.form_opcao_busca_data_registro').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		
			var dtInicial = $('.form_opcao_busca_data_registro  input[name="dataInicial"]').val(),
			dtFinal = $('.form_opcao_busca_data_registro  input[name="dataFinal"]').val(),
			filtro = $('.form_opcao_busca_data_registro  select[name="tipoBusca"]').val(),
			token = $('input[name="_token"]').val();

			$('.env_botoes_resultados_conteudos').empty();

			$.post('/consulta/dt-registro',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
			
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
			$('.mostrar_mais_resultados').bind('click',mostrarMaisDataRegistro);
		});

	});	

	//Mostrar mais DataLiberacao
	function mostrarMaisDataLiberacao(event) {	
		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});

			var param = $(this).attr('data-param');	
			param = param.split('#');

			var dtInicial = param[0],
			dtFinal = param[1],
			filtro = param[2],
			token = $('input[name="_token"]').val();		

			$('.env_botoes_resultados_conteudos').empty();

			$.post('/consulta/dt-liberacao',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'2000'} , function(data, textStatus, xhr) {
			
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
			
		});
	};		


	//Enviar formulário DataLiberacao	
	$('.form_opcao_busca_data_liberacao').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

			var dtInicial = $('.form_opcao_busca_data_liberacao  input[name="dataInicial"]').val(),
			dtFinal = $('.form_opcao_busca_data_liberacao  input[name="dataFinal"]').val(),
			filtro = $('.form_opcao_busca_data_liberacao  select[name="tipoBusca"]').val(),
			token = $('input[name="_token"]').val();

			$('.env_botoes_resultados_conteudos').empty();

			$.post('/consulta/dt-liberacao',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
			
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
			$('.mostrar_mais_resultados').bind('click',mostrarMaisDataLiberacao);
		});

	});


	// Enviar Formulário Urgências	
	$('.form_opcao_busca_urgencia_solicitada').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_urgencia_solicitada  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_urgencia_solicitada  input[name="dataFinal"]').val(),
		filtro = $('.form_opcao_busca_urgencia_solicitada  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/urgencias',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
			
		});

	});


	// Enviar Formulário Pedidos Seguidos	
	$('.form_opcao_busca_pedidos_seguidos').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_pedidos_seguidos  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_pedidos_seguidos  input[name="dataFinal"]').val(),
		filtro = $('.form_opcao_busca_pedidos_seguidos  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/seguidos',{dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
			$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();			
		});
	});


	// Enviar Formulário Nome Paciente	
	$('.form_opcao_busca_nome').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_nome  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_nome  input[name="dataFinal"]').val(),
		nomePaciente = $('.form_opcao_busca_nome  input[name="NomePaciente"]').val(),
		filtro = $('.form_opcao_busca_nome  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/nome-paciente',{nomePaciente:nomePaciente,dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
		
		$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
		});
	});


	// Enviar Formulário NHC
	$('.form_opcao_busca_nhc').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_nhc  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_nhc  input[name="dataFinal"]').val(),
		nhc = $('.form_opcao_busca_nhc  input[name="nhc"]').val(),
		filtro = $('.form_opcao_busca_nhc  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/nhc',{nhc:nhc,dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
		
		$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
		});

	});


	// Enviar Formulário Referência Noûs	
	$('.form_opcao_busca_referencia_nous').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var pedidoNous = $('.form_opcao_busca_referencia_nous  input[name="pedidoNous"]').val(),		
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/ref-nous',{pedido:pedidoNous,_token:token} , function(data, textStatus, xhr) {

		$('.env_botoes_resultados_conteudos').html(data);
			bindFunctions();
		});

	});


	// Enviar Formulário Referencia Cliente	
	$('.form_opcao_busca_referencia_cliente').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_referencia_cliente  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_referencia_cliente  input[name="dataFinal"]').val(),
		referenciaCliente = $('.form_opcao_busca_referencia_cliente  input[name="referenciaCliente"]').val(),
		filtro = $('.form_opcao_busca_referencia_cliente  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();

		$.post('/consulta/ref-cliente',{referenciaCliente:referenciaCliente,dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
		
		$('.env_botoes_resultados_conteudos').html(data);
		bindFunctions();
		});

	});


	// Enviar Formulário Exame	
	$('.form_opcao_busca_exame').submit(function(event) {
		event.preventDefault();

		$('.esconde_mostra_cx_opcoes').addClass('clicado');
		$('.env_opcoes_busca').animate({height: '15px'}, 'slow');
		$('.seta_esconde_mostra_cx_opcoes').css({transform: 'rotate(0deg)'});		

		var dtInicial = $('.form_opcao_busca_exame  input[name="dataInicial"]').val(),
		dtFinal = $('.form_opcao_busca_exame  input[name="dataFinal"]').val(),
		exame = $('.form_opcao_busca_exame  input[name="Exame"]').val(),
		filtro = $('.form_opcao_busca_exame  select[name="tipoBusca"]').val(),
		token = $('input[name="_token"]').val();

		$('.env_botoes_resultados_conteudos').empty();	

		$.post('/consulta/exame',{exame:exame,dtInicial:dtInicial,dtFinal:dtFinal,filtro:filtro,_token:token,top:'1000'} , function(data, textStatus, xhr) {
		
		$('.env_botoes_resultados_conteudos').html(data);
		bindFunctions();
		});

	});



	
	//MODALS

	// Abre modal acompanhar pedido.
	function exibirModalAcompanharPedido(event) {	
		event.preventDefault();
		var pet = $(this).parent().parent().find('.result_checkbox_ped').val();
		$('.modal_acompanhar_pedido_hidden_cod').val(pet);
		$('.emailsAcompanharPedido').val($('input[name="userEmailSend"]').val()+',');	
		$('.telaoscura').fadeIn('slow');
		$('.modal_acompanhar_pedido').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	};


	// Abre modal solicitar urgência.
	function exibirModalSolicitarUrgencia(event) {
		event.preventDefault();
		var pet = $(this).parent().parent().find('.result_checkbox_ped').val(),
		token = $('input[name="_token"]').val();

		$('.modal_solicitar_urgencia_hidden_cod').val(pet);
		$('.justificativa_solicitar_urgencia').val('');	
		$('.env_conteudo_solicitar_urgencia').empty();
		$('input[name="escolhaSolicitacaoUrgencia"]').prop('checked',false);	
		$.post('/consulta/exames-solicitar-urgencia',{pedido:pet,_token:token} , function(data, textStatus, xhr) {
			$('.env_conteudo_solicitar_urgencia').html(data);	
		});			
		$('.telaoscura').fadeIn('slow');
		$('.modal_solicitar_urgencia').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	};


	//Pedido completo solicitar urgencia
	$('input[name="escolhaSolicitacaoUrgencia"]').change(function(event) {
		if($(this).prop( "checked" )){
			$('.env_conteudo_solicitar_urgencia input').prop('checked', true).attr("disabled", true);
		}else{
			$('.env_conteudo_solicitar_urgencia input').prop('checked', false).removeAttr("disabled");
		}
	});


	// Abre modal cancelar totalmente o pedido.
	function exibirModalCancelarPedido(event) {
		event.preventDefault();	
		var pet = $(this).parent().parent().find('.result_checkbox_ped').val();
		$('.modal_cancelar_pedido_hidden_cod').val(pet);
		$('.justificativa_cancelar').val('');		
		$('.telaoscura').fadeIn('slow');
		$('.modal_cancelarTotalPeido').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	};


	// Abre modal cancelar exames.
	function exibirModalCancelarExame(event) {
		event.preventDefault();	
		var pet = $(this).parent().parent().find('.result_checkbox_ped').val(),
		token = $('input[name="_token"]').val();
		
		$('.modal_excluir_exame_hidden_cod').val(pet);
		$('.justificativa_excluir_exames').val('');
			
		$('.env_exames_vinculados_excluirExames').empty();	
		$.post('/consulta/exames-excluir-exames',{pedido:pet,_token:token} , function(data, textStatus, xhr) {
				$('.env_exames_vinculados_excluirExames').html(data);	
		});			
		$('.telaoscura').fadeIn('slow');
		$('.modal_excluirExame').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	};


	// Abre modal incluir exames.
	function exibirModalIncluirExame(event) {	
		event.preventDefault();	
		var pet = $(this).parent().parent().find('.result_checkbox_ped').val();
		$('.modal_add_exame_hidden_cod').val(pet);
		$('.env_exame_escolhidos_adicaoExame').empty();
		$('.telaoscura').fadeIn('slow');
		$('.modal_add_exame').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	};


	// Função que fecha o modal Resultados
	function fecharModalResultado(){
		$('.modal_janela_pg_resultados').fadeOut('slow');
		$('.telaoscura').fadeOut('slow');
		$('html, body').removeAttr('style');
	}
	$('.fechar_modal_pg_resultado').bind('click', fecharModalResultado);		


	//Fechar modal depois de mostrar alerta de mensagens.
	function fecharModalResultadoAlerta(){
		$('.modal_janela_pg_resultados').fadeOut('fast');
		$('.telaoscura').fadeOut('fast');
		$('html, body').removeAttr('style');
	}

	//Enviar Modal Incluir Exame
	$('.form_add_email_add_exames').submit(function(event) {
		event.preventDefault();
		var pet = $('.modal_add_exame_hidden_cod').val(),
		exames = '',
		token = $('input[name="_token"]').val();

		$('.linha_exame_modalAddExames').each(function() {
			exames = exames + $(this).find('input').val() + ',';
		});

		if ($.trim(exames) == '') { 
			exibirMensagem('.alerta_msg_selecionar_exames');
		}else{	

			$.post('/consulta/adicionar-exames', {pedido:pet,_token:token,exames:exames} , function(data, textStatus, xhr) {
				if (data =='1') {
					fecharModalResultadoAlerta();
					exibirMensagem('.alerta_msg_enviada_solicitacao');
				}else{
					exibirMensagem('.alerta_msg_erro_solicitacao');
				}
			});
		}	
	});

	//Enviar Modal Excluir Exames
	$('.form_excluirExame').submit(function(event) {
		event.preventDefault();
		var pet = $('.modal_excluir_exame_hidden_cod').val(),
		exames = '',
		coment = $('.justificativa_excluir_exames').val();
		token = $('input[name="_token"]').val();

		$('.linha_exame_vinculado_excluirExames').each(function() {
			if($(this).find('input').prop( "checked" )){
				exames = exames + $(this).find('input').val() + ',';
			}			
		});

		if ($.trim(exames) == '') { 
			exibirMensagem('.alerta_msg_selecionar_exames');
		}else{	

			if ($.trim(coment) == '') { 
				exibirMensagem('.alerta_msg_preencher_justificativa');
			}else{	

				$.post('/consulta/excluir-exames', {pedido:pet,_token:token,exames:exames,coment:coment} , function(data, textStatus, xhr) {
					if (data =='1') {
						fecharModalResultadoAlerta();
						exibirMensagem('.alerta_msg_enviada_solicitacao');
					}else{
						exibirMensagem('.alerta_msg_erro_solicitacao');
					}
				});
			}	
		}
	});


	//Enviar Modal Cancelar Tudo
	$('.form_cancelarTotalPeido').submit(function(event) {
		event.preventDefault();
		var pet = $('.modal_cancelar_pedido_hidden_cod').val(),		
		coment = $('.justificativa_cancelar').val();
		token = $('input[name="_token"]').val();

		if ($.trim(coment) == '') { 
			exibirMensagem('.alerta_msg_preencher_justificativa');
		}else{
			$.post('/consulta/cancelar-pedido', {pedido:pet,_token:token,coment:coment} , function(data, textStatus, xhr) {
				if (data =='1') {
					fecharModalResultadoAlerta();
					exibirMensagem('.alerta_msg_enviada_solicitacao');
				}else{
					exibirMensagem('.alerta_msg_erro_solicitacao');
				}
			});
		}	
	});


	//Enviar Modal Acompanhar Pedido
	$('.form_acompanhar_pedido').submit(function(event) {
		event.preventDefault();
		var pet = $('.modal_acompanhar_pedido_hidden_cod').val(),		
		emails = $('.emailsAcompanharPedido').val();
		token = $('input[name="_token"]').val();
		
		if ($.trim(emails) == '') { 
			exibirMensagem('.alerta_msg_selecionar_emails');
			}else{

			$.post('/consulta/seguir-pedido', {pedido:pet,_token:token,emails:emails} , function(data, textStatus, xhr) {
				if (data =='1') {
					fecharModalResultadoAlerta();
					exibirMensagem('.alerta_msg_enviada_solicitacao');
				}else{
					exibirMensagem('.alerta_msg_erro_solicitacao');
				}
			});

		}
	});


	//Enviar Modal Solicitar Urgencia
	$('.form_add_email_justificativa_solicitarUrgencia').submit(function(event) {
		event.preventDefault();
		var pet = $('.modal_solicitar_urgencia_hidden_cod').val(),
		exames = '',
		coment = $('.justificativa_solicitar_urgencia').val();
		token = $('input[name="_token"]').val();

		$('.linha_exame_vinculado_solicitarUrgencia').each(function() {
			if($(this).find('input').prop( "checked" )){
				exames = exames + $(this).find('input').val() + ',';
			}			
		});

		if ($.trim(exames) == '') { 
			exibirMensagem('.alerta_msg_selecionar_exames');
		}else{

			if ($.trim(coment) == '') { 
			exibirMensagem('.alerta_msg_preencher_justificativa');
			}else{

				$.post('/consulta/solicitar-urgencia', {pedido:pet,_token:token,exames:exames,coment:coment} , function(data, textStatus, xhr) {
					if (data =='1') {
						fecharModalResultadoAlerta();
						exibirMensagem('.alerta_msg_enviada_solicitacao');
					}else{
						exibirMensagem('.alerta_msg_erro_solicitacao');
					}
				});
			}	
		}	
	});

	//Exibir modal de mensagens de alertas, erros e sucesso.
	function exibirMensagem(alerta) {
	$(alerta).show();
    $('.modal_mensagens').fadeIn('fast');
	$('.telaoscura_mensagens').fadeIn('fast');

	}     

	

});