@if($pacientes == '0')
	
	  <div class="env_texto_resultados_vazio">
      <p>{{trans('pages.RE-NaoForEncRegEnv')}}</p>
     </div> 

@else
	<?php 
		$display = '';
		$clicado = '';

		if ($tipo == '2') {
			$display = 'style="display: block;"';
			$clicado = 'olho_consulta_clicado';
		}
	 ?>	

	<!-- Legendas, totalizadores e impressão de registros enviados situados no topo -->
	<section class="env_legendas_totalizadores_impressao_resultados">
		<div class="legendas_totalizadores_impressora">
			<div class="env_legendas_consulta">
				<!-- legendas -->
				<div class="conluna1">
					<div class="env_r">
						<span class="ic_r">{{trans('pages.TG-SigLegR')}}</span><span class="legenda">{{trans('pages.TG-LegRef')}}</span>
					</div>
					<div class="env_c c_consulas_registros_enviados">
						<span class="ic_c">{{trans('pages.TG-SigLegC')}}</span><span class="legenda">{{trans('pages.TG-LegCon')}}</span>
					</div>
				</div>
				<div class="conluna2 ">
					<div class="env_ta ta_consulas_registros_enviados">
						<span class="ic_ta">{{trans('pages.TG-SigLegTA')}}</span><span class="legenda">{{trans('pages.TG-LegTemAmb')}}</span>
					</div>
				</div><!-- Fim das legendas -->
			</div>
			<div class="env_totalizadores_consulta">
				<p>{{trans('pages.RE-PacCont')}} <span class="deixa_letra_negrito count_pac">0</span> - {{trans('pages.RE-Exa')}} <span class="deixa_letra_negrito count_exam">0</span></p>
			</div>
			<div class="env_impressora_consulta">
				<div class="impressora_consulta"><img src="{{asset('img/icones/impressora.png')}}"> <span>{{trans('pages.RE-ImpReg')}}</span></div>
			</div>
		</div>
	</section><!-- Fim das Legendas, totalizadores e impressão de registros enviados situados no topo -->	

	<div class="estilo_barra_resultados env_tt_pacientes_consultas">
		<span>{{trans('pages.RE-Pac')}}</span>
		<span>{{trans('pages.RE-TtExa')}}</span>
		<span><img src="{{asset('img/icones/olho_preto.png')}}"></span>
	</div>

	@foreach($pacientes as $paciente)
		<!-- Linha do paciente -->	
		<div class="env_linha_pacientes_consulta">
			<div class="linha_paciente_consulta">
				<div class="nome_paciente_consulta">{{utf8_encode($paciente[2])}}</div>
				<div class="total_exames_consulta">{{$paciente['count']}}</div>
				<div class="op_paciente_consulta">
					<img src="{{asset('img/icones/olho.png')}}" class="olho_consulta_registros_enviados {!!$clicado!!}" title="Visualizar exames.">
				</div>
			</div>
			<!-- Exames vinculados	 -->
			<div class="exames_vinculados_paciente_consulta" {!!$display!!}>
				@foreach($paciente['exames'] as $exame)
					<?php 
						$aux = explode('|', $exame);
						$type = $aux[1];
						$label = $aux[0];
					?>
				
					@if($type == '1')
						<div class="env_exame_vinculado_ta_consulta">
							<span class="exame_vinculado_ta_consulta">TA</span>
							<span class="nome_exame_vinculado_consulta">{{utf8_encode($label)}}</span>
						</div>	
					@endif
					@if($type == '2')
						<div class="env_exame_vinculado_r_consulta">
							<span class="exame_vinculado_r_consulta">R</span>
							<span class="nome_exame_vinculado_consulta">{{utf8_encode($label)}}</span>
						</div>	
					@endif
					@if($type == '3')
						<div class="env_exame_vinculado_c_consulta">
							<span class="exame_vinculado_c_consulta">C</span>
							<span class="nome_exame_vinculado_consulta">{{utf8_encode($label)}}</span>
						</div>
					@endif
				@endforeach				
			</div><!-- Fim dos exames vinculados	 -->
		</div><!-- Fim da linha do paciente -->	
	@endforeach
		

	<!-- Totalizadores e impressão de registros enviados situados no rodapé -->
	<section class="env_totalizadores_impressao_resultados">
		<div class="totalizadores_impressora">
			<div class="env_totalizadores_consulta_rodape">
				<p>{{trans('pages.RE-PacCont')}} <span class="deixa_letra_negrito count_pac">0</span> - {{trans('pages.RE-Exa')}} <span class="deixa_letra_negrito count_exam">0</span></p>
			</div>
			<div class="env_impressora_consulta_rodape">
				<div class="impressora_consulta"><img src="{{asset('img/icones/impressora.png')}}"> <span>{{trans('pages.RE-ImpReg')}}</span></div>
			</div>
		</div>
	</section><!-- Fim dos totalizadores e impressão de registros enviados situados no rodapé -->
@endif