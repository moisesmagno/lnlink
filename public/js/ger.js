google.load("visualization", "1.0", {packages:["corechart"]});
$(document).ready(function() {

	
	var token = $('input[name="_token"]').val();

	$.post('/gerenciamento/carregar-fatura',{_token:token}, function(data, textStatus, xhr) {
		$('.form_fatura_consolidada_mes select[name="mesEscolhido"]').html(data);
		$('.form_conferencia_fatura_mes select[name="mesEscolhido"]').html(data);
		
	});

	//Fecha o conteúdo dos relatórios.
	$('.btn_mostrar_tela_realtorio').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('clicado')){
			$(this).removeClass('clicado');

			$(this).parents('.linha_relatorio').find('.txt_btn_relatorio_ocultar').css({display: 'none'});
			$(this).parents('.linha_relatorio').find('.txt_btn_relatorio_mostrar').css({display: 'block'});
			

			$(this).parents('.linha_relatorio').find('.img_seta_btn_mostrar_conteudo_relatorio').css({transform: 'rotate(0deg)'});
			$(this).parents('.env_linha_conteudo').find('.env_conteudo_relatorio').slideUp();

		
		}else{
			$(this).addClass('clicado');

			$(this).parents('.linha_relatorio').find('.txt_btn_relatorio_mostrar').css({display: 'none'});
			$(this).parents('.linha_relatorio').find('.txt_btn_relatorio_ocultar').css({display: 'block'});

			$(this).parents('.linha_relatorio').find('.img_seta_btn_mostrar_conteudo_relatorio').css({transform: 'rotate(180deg)'});
			$(this).parents('.env_linha_conteudo').find('.env_conteudo_relatorio').slideDown();

			if ($(this).hasClass('rel_evo_atv_rem')) {
				relEvoAtvRem();
			}
			if ($(this).hasClass('rel_div_par_rem')) {
				relDivParRem();
			}
			if ($(this).hasClass('rel_comprimento_prazo')) {
				relComprimentoPrazo();
			}
			if ($(this).hasClass('rel_ocorrencia_origem')) {
				relOcorrenciaOrigem();
			}
		}
	});
	

	$('.btn_esconder_conteudo_relatorio').click(function(event) {
		$(this).parents('.env_linha_conteudo').find('.env_conteudo_relatorio').slideUp();
		$(this).parents('.env_linha_conteudo').find('.txt_btn_relatorio_ocultar').css({display: 'none'});
		$(this).parents('.env_linha_conteudo').find('.txt_btn_relatorio_mostrar').css({display: 'block'});
		$(this).parents('.env_linha_conteudo').find('.img_seta_btn_mostrar_conteudo_relatorio').css({transform: 'rotate(0deg)'});
		$(this).parents('.env_linha_conteudo').find('.btn_mostrar_tela_realtorio').removeClass('clicado');
	});


	function relEvoAtvRem(){
		$.post('/gerenciamento/rel-evo-atv-rem', {_token:token}, function(data, textStatus, xhr) {
			$('.tabela_evolucao_atividade_remetida_mes').html(data);
			drawChartTabela1();
		});		
	}


	function relDivParRem(){
		$.post('/gerenciamento/rel-div-par-rem', {_token:token}, function(data, textStatus, xhr) {
			$('.tabela_evolucao_diversidade_parametros_remetidos_mes').html(data);
			drawChartTabela2();
		});	
	}


	function relComprimentoPrazo(){
		$.post('/gerenciamento/rel-comprimento-prazo', {_token:token}, function(data, textStatus, xhr) {
			$('.tabela_comprimento_prazo').html(data);
			drawChartTabela3();
		});	
	}


	function relOcorrenciaOrigem(){
		$.post('/gerenciamento/rel-ocorrencia-origem', {_token:token}, function(data, textStatus, xhr) {
			$('.tabela_ocorrencia_origem_mes').html(data);
			drawChartTabela4();
		});	
	}


	$('.form_fatura_consolidada_mes').submit(function(event) {
		event.preventDefault();
		var mesEscolhido = $('.form_fatura_consolidada_mes select[name="mesEscolhido"] option:selected').val();		

		$.post('/gerenciamento/fatura-por-exame', {_token:token,mesEscolhido:mesEscolhido}, function(data, textStatus, xhr) {

			if (data != '0') {
				window.location.assign("/gerenciamento/dl-planilha/"+data);
			}else{
				exibirMensagem('.alerta_msg_falha');
			}
		});	
	});


	$('.form_conferencia_fatura_mes').submit(function(event) {
		event.preventDefault();
		var mesEscolhido = $('.form_conferencia_fatura_mes select[name="mesEscolhido"] option:selected').val();		

		$.post('/gerenciamento/fatura-por-mes', {_token:token,mesEscolhido:mesEscolhido}, function(data, textStatus, xhr) {

			if (data != '0') {
				window.location.assign("/gerenciamento/dl-planilha/"+data);
			}else{
				exibirMensagem('.alerta_msg_falha');
			}
		});	
	});


	$('.btn_gerar_pdf_relatorio').click(function(event) {
		event.preventDefault();
		var mesEscolhido = $('.form_conferencia_fatura_mes select[name="mesEscolhido"] option:selected').val();	
		window.open("/gerenciamento/pdf/"+mesEscolhido,"_blank");		
	});


	function exibirMensagem(alerta) {
		$(alerta).show();
	    $('.modal_mensagens').fadeIn('fast');
		$('.telaoscura_mensagens').fadeIn('fast');
	} 


	function drawChartTabela1() {
		var coluna1= new Array(),
		coluna2= new Array(),
		coluna3= new Array(),
		coluna4= new Array();

		$('.tabela_evolucao_atividade_remetida_mes').find('.coluna_um_tabela_relatorio span').each(function() {
			var i = coluna1.length;
			coluna1[i] = $(this).text();
		});

		coluna1.pop();
		coluna1[coluna1.length] = {role:'annotationText'};

		$('.tabela_evolucao_atividade_remetida_mes').find('.coluna_dois_tabela_relatorio span').each(function() {
			var i = coluna2.length;
			if (i == 0) {
			coluna2[i] = $(this).text();	
			}else{
			coluna2[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_atividade_remetida_mes').find('.coluna_tres_tabela_relatorio span').each(function() {
			var i = coluna3.length;
			if (i == 0) {
			coluna3[i] = $(this).text();	
			}else{
			coluna3[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_atividade_remetida_mes').find('.coluna_quatro_tabela_relatorio span').each(function() {
			var i = coluna4.length;
			if (i == 0) {
			coluna4[i] = $(this).text();	
			}else{
			coluna4[i] = parseInt($(this).text());
			}
		});

		var data = google.visualization.arrayToDataTable([
	        coluna1,
	        coluna2,
	        coluna3,
	        coluna4
      	]);

      var options = {        
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '30%' },
        isStacked:true
        
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_evolucao_atividade_remetida_mes"));
      chart.draw(data, options);
	}


	function drawChartTabela2() {
		var coluna1= new Array(),
		coluna2= new Array(),
		coluna3= new Array(),
		coluna4= new Array();
		coluna5= new Array();
		coluna6= new Array();
		coluna7= new Array();

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_um_tabela_relatorio span').each(function() {
			var i = coluna1.length;
			coluna1[i] = $(this).text();
		});

		coluna1.pop();
		coluna1[coluna1.length] = {role:'annotationText'};

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_dois_tabela_relatorio span').each(function() {
			var i = coluna2.length;
			if (i == 0) {
			coluna2[i] = $(this).text();	
			}else{
			coluna2[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_tres_tabela_relatorio span').each(function() {
			var i = coluna3.length;
			if (i == 0) {
			coluna3[i] = $(this).text();	
			}else{
			coluna3[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_quatro_tabela_relatorio span').each(function() {
			var i = coluna4.length;
			if (i == 0) {
			coluna4[i] = $(this).text();	
			}else{
			coluna4[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_cinco_tabela_relatorio span').each(function() {
			var i = coluna5.length;
			if (i == 0) {
			coluna5[i] = $(this).text();	
			}else{
			coluna5[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_seis_tabela_relatorio span').each(function() {
			var i = coluna6.length;
			if (i == 0) {
			coluna6[i] = $(this).text();	
			}else{
			coluna6[i] = parseInt($(this).text());
			}
		});

		$('.tabela_evolucao_diversidade_parametros_remetidos_mes').find('.coluna_sete_tabela_relatorio span').each(function() {
			var i = coluna7.length;
			if (i == 0) {
			coluna7[i] = $(this).text();	
			}else{
			coluna7[i] = parseInt($(this).text());
			}
		});

		

		 var data = google.visualization.arrayToDataTable([
	        coluna1,
	        coluna2,
	        coluna3,
	        coluna4,
	        coluna5,
	        coluna6,
	        coluna7,
      	]);

      var options = {        
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '30%' },
        isStacked:true
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_evolucao_diversidade_parametros_remetidos_mes"));
      chart.draw(data, options);
    
	}


	function drawChartTabela3() {
		var coluna1= new Array(),
		coluna2= new Array(),
		coluna3= new Array(),
		coluna4= new Array();
		coluna5= new Array();
		coluna6= new Array();
		coluna7= new Array();

		$('.tabela_comprimento_prazo').find('.coluna_um_tabela_relatorio span').each(function() {
			var i = coluna1.length;
			coluna1[i] = $(this).text();
		});

		coluna1.pop();
		coluna1[coluna1.length] = {role:'annotationText'};

		$('.tabela_comprimento_prazo').find('.coluna_dois_tabela_relatorio span').each(function() {
			var i = coluna2.length;
			if (i == 0) {
			coluna2[i] = $(this).text();	
			}else{
			coluna2[i] = parseInt($(this).text());
			}
		});

		$('.tabela_comprimento_prazo').find('.coluna_tres_tabela_relatorio span').each(function() {
			var i = coluna3.length;
			if (i == 0) {
			coluna3[i] = $(this).text();	
			}else{
			coluna3[i] = parseInt($(this).text());
			}
		});

		$('.tabela_comprimento_prazo').find('.coluna_quatro_tabela_relatorio span').each(function() {
			var i = coluna4.length;
			if (i == 0) {
			coluna4[i] = $(this).text();	
			}else{
			coluna4[i] = parseInt($(this).text());
			}
		});

		$('.tabela_comprimento_prazo').find('.coluna_cinco_tabela_relatorio span').each(function() {
			var i = coluna5.length;
			if (i == 0) {
			coluna5[i] = $(this).text();	
			}else{
			coluna5[i] = parseInt($(this).text());
			}
		});

		$('.tabela_comprimento_prazo').find('.coluna_seis_tabela_relatorio span').each(function() {
			var i = coluna6.length;
			if (i == 0) {
			coluna6[i] = $(this).text();	
			}else{
			coluna6[i] = parseInt($(this).text());
			}
		});

		$('.tabela_comprimento_prazo').find('.coluna_sete_tabela_relatorio span').each(function() {
			var i = coluna7.length;
			if (i == 0) {
			coluna7[i] = $(this).text();	
			}else{
			coluna7[i] = parseInt($(this).text());
			}
		});

	    var data = google.visualization.arrayToDataTable([
	        coluna1,
	        coluna2,
	        coluna3,
	        coluna4,
	        coluna5,
	        coluna6,
	        coluna7,

      	]);

      var options = {        
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '30%' },
        isStacked:true,
        colors: ['79E901', '4861CF', 'E90117']
      };
     
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_comprimento_prazo"));
      chart.draw(data, options);
	}


	function drawChartTabela4() {
		var coluna1= new Array(),
		coluna2= new Array(),
		coluna3= new Array(),
		coluna4= new Array();	

		$('.tabela_ocorrencia_origem_mes').find('.coluna_um_tabela_relatorio span').each(function() {
			var i = coluna1.length;
			coluna1[i] = $(this).text();
		});

		coluna1.pop();
		coluna1[coluna1.length] = {role:'annotationText'};

		$('.tabela_ocorrencia_origem_mes').find('.coluna_dois_tabela_relatorio span').each(function() {
			var i = coluna2.length;
			if (i == 0) {
			coluna2[i] = $(this).text();	
			}else{
			coluna2[i] = parseInt($(this).text());
			}
		});

		$('.tabela_ocorrencia_origem_mes').find('.coluna_tres_tabela_relatorio span').each(function() {
			var i = coluna3.length;
			if (i == 0) {
			coluna3[i] = $(this).text();	
			}else{
			coluna3[i] = parseInt($(this).text());
			}
		});

		$('.tabela_ocorrencia_origem_mes').find('.coluna_quatro_tabela_relatorio span').each(function() {
			var i = coluna4.length;
			if (i == 0) {
			coluna4[i] = $(this).text();	
			}else{
			coluna4[i] = parseInt($(this).text());
			}
		});		

		 var data = google.visualization.arrayToDataTable([
	        coluna1,
	        coluna2,
	        coluna3,
	        coluna4,	       
      	]);

      var options = {        
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '30%' },
        isStacked:true
        
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_ocorrencia_origem_mes"));
      chart.draw(data, options);
    
	}

});