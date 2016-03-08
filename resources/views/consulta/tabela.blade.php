@if($resultados == '0')

<div class="env_texto_resultados_vazio">
	<p>{{trans('pages.PC-MsgResNaoEnc')}}</p>
</div> 


@else
	<div class="env_botoes_resultados">
		<div class="div_botao_resultado exportar_excel">
			<span>{{trans('pages.PC-ExpExc')}}</span><img src="img/icones/excel.png">
		</div>
		<div class="div_botao_resultado imprimir_resultados">
			<span>{{trans('pages.PC-ImpRes')}}</span><img src="img/icones/impressora.png">
		</div>
		<div class="div_botao_resultado baixar_arquivo_click_con">
			<span>{{trans('pages.PC-ArqInt')}}</span><img src="img/icones/baixar.png">
		</div>
		<div class="div_botao_resultado imprimir_laudos">
			<span>{{trans('pages.PC-ImpLau')}}</span><img src="img/icones/impressora.png">
		</div>
	</div>
	<div class="tt_resultados_customizado">
		<div class="checkbox_tt_resulado"><span><input type="checkbox" class="checkbox_ped"></span></div>
		<div class="tt_paciente_resultado tt-click"><span>{{trans('pages.PC-Pac')}}</span></div>
		<div class="tt_dtRegistro_resultado tt-click"><span>{{trans('pages.PC-DtReg')}}</span></div>
		<div class="tt_dtLiberacao_resultado tt-click"><span>{{trans('pages.PC-DtLib')}}</span></div>
		<div class="tt_referencia_resultado tt-click"><span>{{trans('pages.PC-Ref')}}</span></div>
		<div class="tt_pedido_nous_resultado tt-click"><span>{{trans('pages.PC-PedNous')}}</span></div>
		<div class="tt_status_resultado tt-click"><span>{{trans('pages.PC-Sta')}}</span></div>
		<div class="tt_opcoes_resultado"><span>{{trans('pages.PC-Opc')}}</span></div>
		<div class="tt_ver_mais"><span><img src="img/icones/mais_preto.png"></span></div>
	</div>

	<!-- Linha de envolve resultados e conteudo--> 
	<div class="env_todas_linhas_resultados">

		@foreach($resultados as $linha)

			
			<div class="env_linha_conteudos">
			
				<div class="linha_resultado">
					<input type="hidden" class="input_hidden_lib_p" value="{{$linha[6]}}">
					<div class="env_checkbox"><span><input type="checkbox" value="{{$linha[0]}}" class="result_checkbox_ped"></span></div>
					<div class="pacientes_resultados"><span title="{{utf8_encode($linha[1])}}">{{substr(utf8_encode($linha[1]),0,35) }}</span></div>
						<?php 
							if (!empty($linha[2])) {
								$aux  = explode('/', $linha[2]);
								$aux2 = $aux[2].$aux[1].$aux[0];
							}else{
								$aux2 = '';
							}
						?>
					<div class="dt_registro_resultados"><span>{{$linha[2]}}</span><span class="span-hidden">{{$aux2}}</span></div>
						<?php 
							if (!empty($linha[3])) {
								$aux  = explode('/', $linha[3]);
								$aux2 = $aux[2].$aux[1].$aux[0];
							}else{
								$linha[3] = '--';	
								$aux2 = '';
							}

							$aux3 = '';

							if ($linha[6] == '1') {
								$aux3 = 'class=cor_laranja_data';
							}
							if ($linha[6] == '0') {
								$aux3 = 'class=cor_azul_data';
							}
						?>
					<div class="dt_liberacao_resultados"><span {{$aux3}}>{{$linha[3]}}</span><span class="span-hidden">{{$aux2}}</span></div>
					<div class="referencias_resultados"><span>{{$linha[4]}}</span></div>
					<div class="pedido_nous"><span>{{$linha[5]}}</span></div>

					<?php
						switch ($linha[6]) {
						 	case '0':
						 			$auxCor  = 'cor_status_preAnalitica';
						 			$auxStatus = trans('pages.PC-StPreAna');
						 		break;
						 	
						 	case '1':
						 			$auxCor  = 'cor_status_emProcesso';
						 			$auxStatus = trans('pages.PC-StProc');
						 		
						 		break;

						 	case '2':
						 			$auxCor  = 'cor_status_liberado';
						 			$auxStatus = trans('pages.PC-StLib');
						 		break;

						 	case '3':
						 			$auxCor  = 'cor_status_ocorrenciaCliente';
						 			$auxStatus = trans('pages.PC-StIncCli');
						 		break;
						 		
						 	case '4':
						 			$auxCor  = 'cor_status_ocorrenciaNous';
						 			$auxStatus = trans('pages.PC-StIncNous');
						 		break;									 					
						} 
					 ?>

					<div class="status_resultados"><span class="{{$auxCor}}">{{$auxStatus}}</span></div>

					<div class="opcoes_resultados">
						<input type="hidden" value="{{$linha[0]}}">
						<img src="img/icones/opcoes.png" title="{{trans('pages.TtC-FcOp')}}" class="op_branco_resultados_fx clicar_btn_opcoes">
						<img src="img/icones/opcoes_azul.png" title="{{trans('pages.TtC-AbOp')}}" class="op_azul_resultados_fx clicar_btn_opcoes">
						<img src="img/icones/pdf.png" title="{{trans('pages.TtC-VisLau')}}" class="pdf_resultados_fx imprimir_laudo">

						@if($linha[9] != '')
							<img src="img/icones/olho.png" title="{{trans('pages.TtC-VisRes')}}" class="olho_resultados_fx">
						@endif
						@if($linha[7] != '0')
							<img src="img/icones/estrela.png" title="{{trans('pages.TtC-PedSeg')}}" class="estrela_paciente_fx">
						@endif
						@if($linha[8] != '0')
							<img src="img/icones/u.png" class="urgencia_resultado_fx" title="{{trans('pages.TtC-PedUrg')}}">
						@endif
					</div>
					<div class="ver_restante_resultado"><img src="img/icones/mais_azul.png" title="{{trans('pages.TtC-VerMais')}}"></div>
				</div>
				<div class="complemento_resultado_responsivos">
					<div class="env_tt_resultado_complemento_resultado">
						<p class="p_data_registro_complemento"><span>{{trans('pages.PC-DtReg')}}: </span><br class="pulo_linha_txt_complemento">{{$linha[2]}}</p>
						<p class="p_data_liberacao_complemento"><span>{{trans('pages.PC-DtLib')}}: </span><br class="pulo_linha_txt_complemento {{$aux3}}">{{$linha[3]}}</p>
						<p class="p_referencia_complemento"><span>{{trans('pages.PC-Ref')}}: </span><br class="pulo_linha_txt_complemento">{{$linha[4]}}</p>
						<p class="p_pedido_nous_complemento"><span>{{trans('pages.PC-PedNous')}}: </span><br class="pulo_linha_txt_complemento">{{$linha[5]}}</p>
						<p class="p_status_complemento"><span>{{trans('pages.PC-Sta')}}: </span><br class="pulo_linha_txt_complemento"><span class="{{$auxCor}}">{{$auxStatus}}</span></p>
					</div>
					<div class="env_opcoes_responsivo">
						@if($linha[8] != '')											
						<img src="img/icones/u.png" class="urgencia_resultado_resultado" title="{{trans('pages.TtC-PedUrg')}}">
						@endif	
						@if($linha[7] != '')		
						<img src="img/icones/estrela.png" title="{{trans('pages.TtC-PedSeg')}}" class="estrela_complemento_responsivo">
						@endif
						@if($linha[9] != '')
						<img src="img/icones/olho.png" title="{{trans('pages.TtC-VisRes')}}" class="olho_complemento_responsivo">
						@endif
						<img src="img/icones/pdf.png" title="{{trans('pages.TtC-VisLau')}}" class="pdf_complemento_responsivo imprimir_laudo">
						<input type="hidden" value="{{$linha[0]}}">
					</div>
				</div>
				<nav class="conteudo_opcoes_resultados">
					<input type="hidden" value="{{$linha[0]}}">
					<div class="env_menus_opcoes_resultados chama_modal_incluir_exame"><span>{{trans('pages.PC-OpIncExa')}}</span></div>
					<div class="env_menus_opcoes_resultados chama_modal_cancelar_exame"><span>{{trans('pages.PC-OpCanExa')}}</span></div>
					<div class="env_menus_opcoes_resultados chama_modal_cancelar_totalmente_pedido"><span>{{trans('pages.PC-OpCanTotPed')}}</span></div>
					<div class="env_menus_opcoes_resultados chama_modal_solicitar_urgencia"><span>{{trans('pages.PC-OpSolUrg')}}</span></div>
					<div class="env_menus_opcoes_resultados chama_modal_acompanhar_pedido"><span>{{trans('pages.PC-OpSegPed')}}</span></div>
				</nav>
				<div class="conteudo_resultados_pacientes_tela">
					{!!utf8_encode($linha[9])!!}
				</div>
				
			</div><!-- Fim da Linha de envolve resultados e conteudo -->

		@endforeach

	</div> <!-- Fecha grupo de linhas -->

		@if(count($resultados) == 1000)
		<div class="bt_azul mostrar_mais_resultados" data-param="{{$param}}"><span>{{trans('pages.PC-MosMais')}}</span></div>
		@endif
@endif						