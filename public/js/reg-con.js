$(document).ready(function() {
	
	token = $('input[name="_token"]').val();

	function atualizarCountPacExam(){
		var countPac = 0,
		countExam = 0;
		$('.total_exames_consulta').each(function() {
			var aux = $(this).text();
			countPac++;
			countExam = countExam + parseInt(aux);
		});
		$('.count_exam').text(countExam);
		$('.count_pac').text(countPac);
	}


	function abreOlhoRegistroConsulta(event) {
		if($(this).hasClass('olho_consulta_clicado')){
			$(this).removeClass('olho_consulta_clicado');
			$(this).parents('.env_linha_pacientes_consulta').find('.exames_vinculados_paciente_consulta').slideUp('fast');
		}else{
			$(this).addClass('olho_consulta_clicado'); 
			$(this).parents('.env_linha_pacientes_consulta').find('.exames_vinculados_paciente_consulta').slideDown('fast');
		}
	};


	$('.form_consultar_registros_enviados').submit(function(event) {
		event.preventDefault();	

		var dtInicial = $('.form_consultar_registros_enviados  input[name="dataInicial"]').val(),
		dtFinal = $('.form_consultar_registros_enviados  input[name="dataFinal"]').val(),
		tipo = $('.form_consultar_registros_enviados  select[name="tipoConsulta"]').val();
		$('.env_conteudo_registro_consulta_alvo').empty();	


		$.post('/registro/consulta-enviados/listar',{_token:token,dtInicial:dtInicial,dtFinal:dtFinal,tipo:tipo}, function(data, textStatus, xhr) {		
			$('.env_conteudo_registro_consulta_alvo').html(data);
			$('.olho_consulta_registros_enviados').bind('click',abreOlhoRegistroConsulta);
		    atualizarCountPacExam();	
		});
	});


	$(document).delegate('.impressora_consulta', 'click', function(event) {
		var dtInicial = $('.form_consultar_registros_enviados  input[name="dataInicial"]').val(),
		dtFinal = $('.form_consultar_registros_enviados  input[name="dataFinal"]').val();

		if ($.trim(dtInicial) != '' && $.trim(dtFinal) != '') {
			var dti = dtInicial.replace('/','-'),
			dtf = dtFinal.replace('/','-');
			dti = dti.replace('/','-');
			dtf = dtf.replace('/','-');
			window.open("/registro/consulta-enviados/print/"+dti+"/"+dtf,"_blank");
		}			
	});
	
});