$(document).ready(function() {

	token = $('input[name="_token"]').val();
	
	$.post('/lista/listar-exames',{_token:token}, function(data, textStatus, xhr) {
			$('.env_conteudo_lista_exames_alvo').empty();
  		$('.env_conteudo_lista_exames_alvo').html(data);
  		$('.apaga_linha_exame_lista_click').bind('click',excluirExame); 
  		$('.lista_exames_check_all').bind('click',checkAll); 
  		$('.zerar_lista_click').bind('click',zerarLista);  
      $('.link_gerar_pedido').bind('click',gerarPedido); 
      atualizarCountLista(); 
      $('.abre_moda_solicitacao_adicional').bind('click',abrirModalInfoAdicional);
      $('.abre_modal_solicitar_catacao').bind('click',abrirModalSolicitacaoCot);       		     		
 	});


 	function excluirExame(event) {
 		event.preventDefault();
    var r = confirm($('.alert_excluir_exame').text());

    if (r == true) {
      var exames = $(this).parent().parent().children('.linha_exame_lista_input').val() +',';
      $.post('/lista/excluir-exames',{_token:token,exames:exames}, function(data, textStatus, xhr) {atualizarLista();});
    } 
 	}


 	function zerarLista(event) {
 		event.preventDefault();
    var r = confirm($('.alert_excluir_todos_exames').text());

    if (r == true) {
   		var exames = '';
   		
   		$('.linha_exame_lista_input').each(function() {
   				exames = exames + $(this).val()+',';
   		}); 
   		$.post('/lista/excluir-exames',{_token:token,exames:exames}, function(data, textStatus, xhr) {atualizarLista();}); 		
    }
 	}


 	function atualizarLista() {
 		$.post('/lista/listar-exames',{_token:token}, function(data, textStatus, xhr) {
			$('.env_conteudo_lista_exames_alvo').empty();
      		$('.env_conteudo_lista_exames_alvo').html(data); 
      		$('.apaga_linha_exame_lista_click').bind('click',excluirExame);
      		$('.lista_exames_check_all').bind('click',checkAll); 
      		$('.zerar_lista_click').bind('click',zerarLista); 
          $('.link_gerar_pedido').bind('click',gerarPedido); 
          atualizarCountLista();  
          $('.abre_moda_solicitacao_adicional').bind('click',abrirModalInfoAdicional);
          $('.abre_modal_solicitar_catacao').bind('click',abrirModalSolicitacaoCot);    		   		     		
 	  });
 	}


 	function checkAll(event){
    if($(this).prop( "checked" )){
			$('.linha_exame_lista_input').prop('checked', true);
		}else{
			$('.linha_exame_lista_input').prop('checked', false);
		}
  }; 


  function gerarPedido(event){
    event.preventDefault();
    var pedidos = '';   

    if ($('.linha_exame_lista_input:checked').length > 0) {    
      $('.linha_exame_lista_input:checked').each(function() {
        pedidos = pedidos +$(this).val()+',';
      });
      $.post('/lista/gerar-pedido',{_token:token,pedidos:pedidos}, function(data, textStatus, xhr) {
        if (data == '1') {           
            window.location.assign("/registro/manual");         
        }
      }); 
    }else{
     exibirMensagem('.alerta_msg_selecionar');
    }
  };  


  function atualizarCountLista()
  {
    $.post('/lista/atualizar-count' ,{_token:token},function(data, textStatus, xhr) {
      $('.top_count_list').empty();  
      $('.top_count_list').text(data);     
    });
  }  


  //Fechar modal depois de mostrar alerta de mensagens.
  function fecharModalResultadoAlerta(){
    $('.modal_janela_pg_resultados').fadeOut('fast');
    $('.telaoscura').fadeOut('fast');
    $('.modal-janela').fadeOut('fast');
    $('html, body').removeAttr('style');
  }


  function exibirMensagem(alerta) {
    $(alerta).show();
    $('.modal_mensagens').fadeIn('fast');
    $('.telaoscura_mensagens').fadeIn('fast');
  }  


  //Desmarca todos os checked box.
  function desmarcar(){
    $('.linha_exame_lista_input').each(
      function(){
        if ($(this).prop( "checked")){
          $(this).prop("checked", false);
          $('.lista_exames_check_all').prop("checked", false);
        }            
      }
    );
  }


  // Abre o Modal de solicitação de informação adicional da tela de listar.
  function abrirModalInfoAdicional(event) {
    event.preventDefault(); 
    $('.cx_exames_solicitacao_informacoes_modal').empty();
     if ($('.linha_exame_lista_input:checked').length > 0) {    
      $('.linha_exame_lista_input:checked').each(function() {
        var label = $(this).parent().find('span').text();
        $('.cx_exames_solicitacao_informacoes_modal').append('<span>'+label+'</span>');
      });        
      $('input[name="emailsInformacaoAdicional"]').val($('input[name="userEmailSend"]').val()+',');
      $('textarea[name="descricaoInfoAdicional"]').val('');   
      $('.telaoscura').fadeIn('slow');
      $('.modal_solicitar_informacao').fadeIn('slow');
      $('html, body').css({
        overflow: 'hidden'
      });
    }else{
     exibirMensagem('.alerta_msg_selecionar');
    }
  } // Fim do Modal de solicitação de informação adicional da tela de listar.
  

  // Abre o Modal de solicitação de cotação.
   function abrirModalSolicitacaoCot(event) {
    event.preventDefault();
    $('.cx_exames_solicitar_cotacao').empty();
    if ($('.linha_exame_lista_input:checked').length > 0) {    
      $('.linha_exame_lista_input:checked').each(function() {
        var label = $(this).parent().find('span').text();
        $('.cx_exames_solicitar_cotacao').append('<div><span>'+label+'</span><input type="number" name="" min="1"></div>');
      });
      $('input[name="emailsSolicitarCotacao"]').val($('input[name="userEmailSend"]').val()+',');
      $('textarea[name="descricaoSolicitacaoCot"]').val('');           
      $('.telaoscura').fadeIn('slow');
      $('.modal_solicitar_cotacao').fadeIn('slow');
      $('html, body').css({
        overflow: 'hidden'
      });
    }else{
     exibirMensagem('.alerta_msg_selecionar');
    }
  } // Fim do Modal de solicitação de cotação.


  //Enviar Modal Informação adicional
  $('.form_envio_informacao_adicional').submit(function(event) {
      event.preventDefault();
      var exames = '',emails,desc;
      $('.cx_exames_solicitacao_informacoes_modal span').each(function() {
        exames = exames+$(this).text()+'#';
      });
      emails = $('input[name="emailsInformacaoAdicional"]').val();
      desc = $('textarea[name="descricaoInfoAdicional"]').val();

      if ($.trim(exames) == '') { 
        exibirMensagem('.alerta_msg_selecionar_exames');
      }else{
        if ($.trim(emails) == '') { 
        exibirMensagem('.alerta_msg_preencher_emails');
        }else{

          if ($.trim(desc) == '') { 
          exibirMensagem('.alerta_msg_preencher_desc');
          }else{ 
            $.post('/lista/info-adicional',{_token:token,exames:exames.trim(),emails:emails.trim(),desc:desc.trim()}, function(data) {  
                desmarcar();
                fecharModalResultadoAlerta();
                $('input[name="emailsInformacaoAdicional"]').val('');
                $('textarea[name="descricaoInfoAdicional"]').val('');
                exibirMensagem('.alerta_msg_enviada_solicitacao');
            });               
          }    
        }
      }  
  });


  $('.form_solicitar_cotacao').submit(function(event) {
      event.preventDefault();
      var exames = '',emails,desc,error = false;
      $('.cx_exames_solicitar_cotacao div').each(function() {
        exames = exames+$(this).children('span').text()+'#'+$(this).children('input').val()+'^';
        if ($.trim($(this).children('input').val()) == '') {
            error = true;
        }
      });
      emails = $('input[name="emailsSolicitarCotacao"]').val();
      desc = $('textarea[name="descricaoSolicitacaoCot"]').val();

      if ($.trim(exames) == '') { 
        exibirMensagem('.alerta_msg_selecionar_exames');
      }else{
        if (error == true) {
          exibirMensagem('.alerta_msg_preencher_quantidade');
        }else{
          if ($.trim(emails) == '') { 
          exibirMensagem('.alerta_msg_preencher_emails');
          }else{
            if ($.trim(desc) == '') { 
            exibirMensagem('.alerta_msg_preencher_desc');
            }else{ 
              $.post('/lista/solicitacao-cot',{_token:token,exames:exames.trim(),emails:emails.trim(),desc:desc.trim()}, function(data) {  
                  desmarcar();
                  fecharModalResultadoAlerta();
                  $('input[name="emailsSolicitarCotacao"]').val('');
                  $('textarea[name="descricaoSolicitacaoCot"]').val('');
                  $('.cx_exames_solicitar_cotacao div').children('input').val('');
                  exibirMensagem('.alerta_msg_enviada_solicitacao');
              });               
            }
          }
        }  
      }            
  });

});