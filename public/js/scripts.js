//METODO QUE MOSTRA E OCULTA OS LINKS DO HEADER GERAL.
function mostrarOcultaLinksHeader(){
	var seta = document.getElementById('seta_links_header');
	var liksHeaderGeral = document.getElementById('links_header_geral');

	if(seta.className ==  'seta_links_header'){
		seta.className = 'seta_links_header_apertado girar_cima_completamente';
		liksHeaderGeral.style.display = 'block';
		seta.style.transform = 'rotate(180deg)';
	}else{
		seta.className = 'seta_links_header';
		liksHeaderGeral.style.display = 'none';
		seta.style.transform = 'rotate(0deg)';
	}
	
}

jQuery(document).ready(function($) {

	$(document).ajaxStart(function() {
		$('.tela_ajax').fadeIn('slow');
	});

	$(document).ajaxStop(function() {
		$('.tela_ajax').fadeOut('slow');
	});

	$(document).ajaxError(function(event, xhr, settings, thrownError) {
		exibirMensagemErroAjax('.alerta_msg_erro_ajax');
	});


	//METODO QUE MOSTRA E OCULTA OS MENUS DO HEADER RESPONSIVO.
	$('#icone_menu_responsivo').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('icone_selecionado')){
			$(this).removeClass('icone_selecionado');
			$('.cont_menu_responsivo').slideUp();
		}else{
			$('.icone_selecionado').removeClass('icone_selecionado');
			$('.escondida_header_responsivo').hide();

			$('.cont_menu_responsivo').slideDown();
			$(this).addClass('icone_selecionado');
		}
	});

	//METODO QUE MOSTRA E OCULTA OS MENUS DO HEADER RESPONSIVO.
	$('#icone_usuario_responsivo').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('icone_selecionado')){
			$(this).removeClass('icone_selecionado');
			$('.cont_usuario_responsivo').slideUp();
		}else{
			$('.icone_selecionado').removeClass('icone_selecionado');
			$('.escondida_header_responsivo').hide();

			$('.cont_usuario_responsivo').slideDown();
			$(this).addClass('icone_selecionado');
		}
	
	});

	//METODO QUE MOSTRA E OCULTA OS MENUS DO HEADER RESPONSIVO.
	$('#icone_opcoes_responsivo').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('icone_selecionado')){
			$(this).removeClass('icone_selecionado');
			$('.cont_opcoes_responsivo').slideUp();
		}else{
			$('.icone_selecionado').removeClass('icone_selecionado');
			$('.escondida_header_responsivo').hide();

			$('.cont_opcoes_responsivo').slideDown();
			$(this).addClass('icone_selecionado');
		}
	
	});


	/* ******************************************************************************
	                                  MODAL
	****************************************************************************** */
	// Função que fecha o modal
	function fecharModalLista(){
		$('.modal-janela').fadeOut('slow');
		$('.telaoscura').fadeOut('slow');
	}
	// Fim da unção que fecha o modal.
	$('.fechar-modal-lista').bind('click', fecharModalLista);
	/* ******************************************************************************
	                                  FIM DO MODAL
	****************************************************************************** */

	/* ******************************************************************************
	                         MODAL VALORES DE REFERENCIA
	****************************************************************************** */
	$('.vl_referencia_exame').click(function(event) {
		event.preventDefault();	
		$('.telaoscura_vl_referencia').fadeIn('slow');
		$('.modal_vl_referencia').fadeIn('slow');
		$('html, body').css({
			overflow: 'hidden'
		});
	});	

	// Função que fecha o modal
	function fecharModa(){
		$('.modal_vl_referencia').fadeOut('slow');
		$('.telaoscura_vl_referencia').fadeOut('slow');
		$('html, body').removeAttr('style');
	}

	// Fim da unção que fecha o modal.
	$('.fechar-modal').bind('click', fecharModa);
	/* ******************************************************************************
	                      FIM DO MODAL VALORES DE REFERENCIA
	****************************************************************************** */

	/* ******************************************************************************
	                               BANDEJA DE PEDIDOS
	****************************************************************************** */
	// Abre e fecha exames vinculados
	

	$('.btn_pacientes_exames').click(function(event){
		if($(this).hasClass('btn_pacientes_exames_clicado')){
			$(this).removeClass('btn_pacientes_exames_clicado');
			$('.img_olho_bandeja').removeClass('olho_bandeja_clicado');
			$('.exames_vinculados_paciente_bandeja').slideUp('fast');

		}else{
			$(this).addClass('btn_pacientes_exames_clicado');
			$('.img_olho_bandeja').addClass('olho_bandeja_clicado');
			$('.exames_vinculados_paciente_bandeja').slideDown('fast');	
		}
	});
	// Fim Abre e fecha exames vinculados
	/* ******************************************************************************
	                           FIM DA BANDEJA DE PEDIDOS
	****************************************************************************** */


	/* ******************************************************************************
	                       TELA DE REGISTRO MANUAL
	****************************************************************************** */
		//Mostra o conteudo da lista no registro.
		$('.box_lista_exames').click(function(event) {
			if($(this).hasClass('box_clicado')){
				$(this).removeClass('box_clicado');
				$('.env_cont_lista_exames').fadeOut();

				$('.seta_baixao_lista_exames').css({transform: 'rotate(0deg)'});
			}else{
				$('.box_clicado').removeClass('box_clicado');
				$('.cont_box_registro').hide();

				$('.env_cont_lista_exames').fadeIn();
				$(this).addClass('box_clicado');

				$('.seta_baixao_lista_exames').css({transform: 'rotate(180deg)'});		
			}
		});

		//Mostra o conteudo do grupo de soclitações no registro.
		$('.box_grupo_solicitacoes').click(function(event) {
			if($(this).hasClass('box_clicado')){
				$(this).removeClass('box_clicado');
				$('.env_cont_grupo_solicitacoes').fadeOut();

				$('.seta_baixo_grupo_solicitacoes').css({transform: 'rotate(0deg)'});
			}else{
				$('.box_clicado').removeClass('box_clicado');
				$('.cont_box_registro').hide();

				$('.env_cont_grupo_solicitacoes').fadeIn();
				$(this).addClass('box_clicado');

				$('.seta_baixo_grupo_solicitacoes').css({transform: 'rotate(180deg)'});				
			}
		
		});
	/* ******************************************************************************
	                       FIM DA TELA DE REGISTRO MANUAL
	****************************************************************************** */


	/* ******************************************************************************
	                       	        INCIDÊNCIAS
	****************************************************************************** */
	$('.linha_incidencia').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideUp();
		}else{
			$(this).addClass('clicado');
			$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideDown();
		}
	});

	$('.btn_ocultar_conteudo_incidencias').click(function(event) {
		$(this).parents('.env_linha_conteudo').find('.linha_incidencia').removeClass('clicado');
		$(this).parents('.env_linha_conteudo').find('.conteudo_incidencia').slideUp();
	});
	/* ******************************************************************************
	                       	    FIM DAS INCIDÊNCIAS
	****************************************************************************** */


	/* ******************************************************************************
	                       	    	CATALOGO
	****************************************************************************** */

	// Abre e fecha filtro lateral
	$('.aberturaFiltro').click(function(event) {
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			$('.x_fecha_filtro').hide();						
			$('.conteudo_filtro').animate({'margin-left': '-390px'}, 'slow', function() {
				$('.env_filtro_flutuante_lateral').css({
					background: 'none'
				});
			});

		}else{
			$(this).addClass('clicado');
			$('.x_fecha_filtro').show();			
			$('.env_filtro_flutuante_lateral').css({
				background: 'rgba(149,149,149,0.7)'
			});
			$('.conteudo_filtro').animate({'margin-left': '0px'}, 'slow');		
		}
	});// Fimdo Abre e fecha filtro lateral

	// Abre as especialidades do filtro suspenso
	$('.tt_filtro').click(function(event) {
		if($(this).hasClass('tt_filtro_primero')){
			$(this).removeClass('clicado');
			$(this).removeClass('tt_filtro_primero');
			$('.cont_especialidade_aberto').slideUp();
			$(this).parents('.env_especialidade').find('.img_seta_filtro_catalogo').css({transform:'rotate(0deg)'});
		}else{
			if($(this).hasClass('clicado')){
				$(this).removeClass('clicado');
				$(this).parents('.env_especialidade').find('.cont_especialidade').slideUp();
				$(this).parents('.env_especialidade').find('.img_seta_filtro_catalogo').css({transform:'rotate(0deg)'});
			}else{
				$(this).addClass('clicado');
				$(this).parents('.env_especialidade').find('.cont_especialidade').slideDown();
				$(this).parents('.env_especialidade').find('.img_seta_filtro_catalogo').css({transform:'rotate(180deg)'});
			}
		}
		
	});// Fim - Abre as especialidades do filtro suspenso


	//Abre e fecha os filtros estáticos.
	$('.flecha_abre_fecha_catalogo').click(function(event) {
		var altura = $('.envFiltrosCat').height();
		var autoHeight = $('.envFiltrosCat').css('height', 'auto').height();
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			$(this).css({transform: 'rotate(0deg)'});
			$('.envFiltrosCat').height(altura).animate({height: autoHeight}, 'slow');
			$(this).css('background', '');
		}else{
			$(this).addClass('clicado');
			$(this).css({transform: 'rotate(180deg)'});
			$('.envFiltrosCat').animate({'height': '1px'}, 'slow');	
			$(this).css('background', '#0590c0');
		}
	});

	/* ******************************************************************************
	                       	    FIM CATALOGO
	****************************************************************************** */

	

	/* ******************************************************************************
	                       	 		  EXAMES
	****************************************************************************** */
	// Abre e fecha o menu responsivo
	$('.img_menu_responsivo').click(function(event) {
		if($(this).hasClass('img_menu_responsivo_clicado')){
			$(this).removeClass('img_menu_responsivo_clicado');
			$('.env_abas_responsivo').slideUp();		
		}else{
			$(this).addClass('img_menu_responsivo_clicado');
			$('.env_abas_responsivo').slideDown();	
		}
	});// Fim da abertura e fecahmento do menu responsivo

	// Abre e fecha o conteúdo das amostras alternativas
	$('.botao_amostra_alternativa').click(function(event) {
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			
			$('.env_amostras_alternativas_responsivo').slideUp(function(){
				$('.env_botao_amostrar_alternativas').css({'margin-bottom':'40px'});	
			});
			$('.img_seta_amostrar_alternativa').css({transform: 'rotate(0deg)'});
		}else{
			$(this).addClass('clicado');
			
			$('.env_botao_amostrar_alternativas').css({'margin-bottom':'0px'});
			$('.env_amostras_alternativas_responsivo').slideDown();
			$('.img_seta_amostrar_alternativa').css({transform: 'rotate(180deg)'});
		}
	});// Fim da abertura e fechamento do conteúdo das amostras alternativas

	// Abre e fecha os detalhes dos genes
	$('.botao_detalhes_genes').click(function(event) {
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			
			$('.env_detalhes_genes_responsivo').slideUp(function(){
				$('.env_botao_detalhes_genes').css({'margin-bottom':'40px'});	
			});
			$('.img_seta_detalhes_genes').css({transform: 'rotate(0deg)'});
		}else{
			$(this).addClass('clicado');	
			
			$('.env_botao_detalhes_genes').css({'margin-bottom':'0px'});
			$('.env_detalhes_genes_responsivo').slideDown();
			$('.img_seta_detalhes_genes').css({transform: 'rotate(180deg)'});
		}
	});// Fim da abertura e fechamento do detalhes dos genes

	// Abre e fecha os linkis do exame
	$('.botao_detalhes_links').click(function(event) {
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');
			
			$('.env_links_exames_responsivo').slideUp(function(){
				$('.env_botao_detalhes_links').css({'margin-bottom':'40px'});	
			});
			$('.img_seta_detalhes_links').css({transform: 'rotate(0deg)'});
		}else{
			$(this).addClass('clicado');	
			
			$('.env_botao_detalhes_links').css({'margin-bottom':'0px'});
			$('.env_links_exames_responsivo').slideDown();
			$('.img_seta_detalhes_links').css({transform: 'rotate(180deg)'});
		}
	});// Fim da abertura e fechamento dos links do exame
	/* ******************************************************************************
	                       	 	  FIM DE EXAMES
	****************************************************************************** */


	/* ******************************************************************************
	                       	 		CALENDÁRIO
	****************************************************************************** */
	$(".datainicial" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'dd/mm/yy',						
	});
	$(".datainicial").datepicker("setDate",	'-1d');

	$( ".datafinal" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'dd/mm/yy',		
	});	
	$(".datafinal").datepicker("setDate",new Date());

	$(".input_data_solicitacao" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'dd/mm/yy',						
	});
 	$(".input_data_solicitacao").datepicker("setDate",new Date());

	$(".input_envio_material_fisico" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'dd/mm/yy',						
	});	
	$(".input_envio_material_fisico").datepicker("setDate",new Date());

	/* ******************************************************************************
	                       	 	FIM DO CALENDÁRIO
	****************************************************************************** */


	/* ******************************************************************************
	                               LOGISTICA
	****************************************************************************** */

	function removerLinhaLote(event){
		event.preventDefault();
		if ($('.x_env_mat_click').length == 1) {
			var aux = $(this).parent().parent();
			aux.find('input[name="referenciaCaixa"]').val('');
			aux.find('input[name="qtdeVolumes"]').val('');
			aux.find('.tamanho_env_mat select').find('option[value=""]').attr("selected",true);
			aux.find('.conservacao_env_mat select').find('option[value=""]').attr("selected",true);
			aux.find('input[name="temperaturaSaida"]').val('');
			aux.find('input[name="quantidadeAmostras"]').val('');
		}else{
			$(this).parent().parent().remove();	
		}		
	}


	$('.add_linha_lote').click(function(event) {		
		var x = $('.linha_envio_material').clone().first();
			x.find('input[name="referenciaCaixa"]').val('');
			x.find('input[name="qtdeVolumes"]').val('');
			x.find('.tamanho_env_mat select').find('option[value=""]').attr("selected",true);
			x.find('.conservacao_env_mat select').find('option[value=""]').attr("selected",true);
			x.find('input[name="temperaturaSaida"]').val('');
			x.find('input[name="quantidadeAmostras"]').val('');		
		x.appendTo('.env_linha_envio_material');

		$('.x_env_mat_click').bind('click',removerLinhaLote);
	});

	$('.x_env_mat_click').bind('click',removerLinhaLote);


    //Solicitação
	function removerLinhaSolicitacao(event){
		event.preventDefault();
		if ($('.img_solicitacao_click').length == 1) {
			var aux = $(this).parent().parent();
			aux.find('.nome_material select').find('option[value=""]').attr("selected",true);
		aux.find('.utilizacao_solicitacao select').find('option[value=""]').attr("selected",true);
		aux.find('input[name="qtdeSolicitacao"]').val('');
		aux.find('input[name="totalSolicitacao"]').val('');		
		}else{
			$(this).parent().parent().remove();	
		}		
	}


	$('.add_linha_solicitacao').click(function(event) {		
		var x = $('.linha_solicitacao_material').clone().first();			
			x.find('.nome_material select').find('option[value=""]').attr("selected",true);
			x.find('.utilizacao_solicitacao select').find('option[value=""]').attr("selected",true);
			x.find('input[name="qtdeSolicitacao"]').val('');
			x.find('input[name="totalSolicitacao"]').val('');		
			x.appendTo('.env_linha_solicitacao_material');
		
	});

	$(document).delegate('.img_solicitacao_click', 'click', removerLinhaSolicitacao);
	

	/* ******************************************************************************
	                            FIM DE LOGISTICA
	****************************************************************************** */

	//Fechar Modal Mensagens
	$('.fechar-modal-mensagens').click(function(event) {
		$('.modal_mensagens').fadeOut('medium');
		$('.telaoscura_mensagens').fadeOut('slow');
		$('.msg_p_alerta').hide();
		$('.msg_p_sucesso').hide();
		$('.msg_p_erro').hide();
	});

	function exibirMensagemErroAjax(alerta) {
	$(alerta).show();
    $('.modal_mensagens').fadeIn('fast');
	$('.telaoscura_mensagens').fadeIn('fast');

	}   

	//LockForms
	$('.form_dados_paciente_registro').submit(function(event) {
		event.preventDefault();
	});

	$('.form_autocomplete_lock').submit(function(event) {
		event.preventDefault();
	});

	$(document).delegate('.form_dependencias_exame', 'submit', function(event) {
		event.preventDefault(); 
	});

});

