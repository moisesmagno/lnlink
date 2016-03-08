@if($pacientes == '0')
	<div class="mensagem_vazio_bandeja">
		<span>{{trans('pages.BP-MsgBanVac1')}} <br>{{trans('pages.BP-MsgBanVac2')}}</span>
		<div class="env_btn_add_pedidos_bandeja">
			<a href="{{url(trans('routes.registro').'/'.trans('routes.manual'))}}" class="bt_azul">{{trans('pages.BP-BtnAdicPed')}}</a>
		</div>
	</div> 
@else

	<div class="header_bandeja">
		<!-- Header da bandeja -->
		<div class="env_legendas_bandeja">
			<!-- legendas -->
			<div class="conluna1">
				<div class="env_r r_exames_selecionados">
					<span class="ic_r">{{trans('pages.TG-SigLegR')}}</span><span class="legenda">{{trans('pages.TG-LegRef')}}</span>
				</div>
				<div class="env_c c_exames_selecionados c_legenda_bandeja">
					<span class="ic_c">{{trans('pages.TG-SigLegC')}}</span><span class="legenda">{{trans('pages.TG-LegCon')}}</span>
				</div>
			</div>
			<div class="conluna2">
				<div class="env_ta ta_exames_selecionados ta_legenda_bandeja">
					<span class="ic_ta">{{trans('pages.TG-SigLegTA')}}</span><span class="legenda">{{trans('pages.TG-LegTemAmb')}}</span>
				</div>
			</div><!-- Fim das legendas -->
		</div>
		<div class="totalizadores_bandeja">
			<p>{{trans('pages.BP-TtPaci')}} <span class="count_pac">0</span></p>
			<p>{{trans('pages.BP-TtExam')}} <span class="count_exam">0</span></p>
		</div>
		<div class="botoes_bandeja">
			<div class="btn_pacientes_exames">
				<img src="{{asset('img/icones/olho.png')}}">
				<span>{{trans('pages.BP-PacExa')}}</span>
			</div>
			<div class="apagar_pedidos_bandeja">
				<a href="" class="apagar_pedidos_bandeja_click">{{trans('pages.BP-ExcPed')}}</a>
			</div>
		</div><!-- Fim do header da bandeja -->
	</div>
			
	<!-- titulo bandeja -->
	<div class="estilo_barra_resultados env_tt_bandeja">
		<span class="tt_paciente_bandeja">{{trans('pages.BP-Pacien')}}</span>
		<span class="tt_total_exame_bandeja">{{trans('pages.BP-TtExa')}}</span>
		<span class="tt_opcoes_bandeja">{{trans('pages.BP-TtOp')}}</span>
	</div><!-- Fim do titulo bandeja -->
			
	<div class="alvo_listar_pedidos_bandeja">

		@foreach($pacientes as $paciente)
			<div class="env_linha_paciente_exames_bandeja">
				<div class="linha_paciente_exames_bandeja">
				<div class="nome_paciente_bandeja"><span>{{utf8_encode($paciente[3]).' '.utf8_encode($paciente[2])}}</span></div>
				<div class="total_exame_bandeja"><span>{{$paciente['count']}}</span></div>		
					<div class="opcoes_bandeja">
					<input type="hidden" value="{{utf8_encode($paciente[0])}}" name="petCod">
					<img src="{{asset('img/icones/olho.png')}}" class="img_olho_bandeja" title="{{trans('pages.TlBP-VisExa')}}">
					<img src="{{asset('img/icones/x.png')}}" class="img_x_bandeja" title="{{trans('pages.TlBP-ExcPed')}}">
					</div>	
				</div>
				
				<!-- Exames vinculados	 -->
				<div class="exames_vinculados_paciente_bandeja">

					@foreach($paciente['exames'] as $exame)
						<?php 
							$aux = explode('|', $exame);
							$type = $aux[1];
							$label = $aux[0];
						 ?>
					
						@if($type == '1')
							<div class="env_exame_vinculado_ta_bandeja">
								<span class="exame_vinculado_ta_bandeja">TA</span>
								<span class="nome_exame_vinculado_bandeja">{{utf8_encode($label)}}</span>
							</div>			
						@endif
						@if($type == '2')
							<div class="env_exame_vinculado_r_bandeja">
								<span class="exame_vinculado_r_bandeja">R</span>
								<span class="nome_exame_vinculado_bandeja">{{utf8_encode($label)}}</span>
							</div>		
						@endif
						@if($type == '3')
							<div class="env_exame_vinculado_c_bandeja">
								<span class="exame_vinculado_c_bandeja">C</span>
								<span class="nome_exame_vinculado_bandeja">{{utf8_encode($label)}}</span>
							</div>		
						@endif

					@endforeach
				</div>
			</div>
		@endforeach

	</div>


	<div class="env_totalizadores_btn_enviar_pedidos_bandeja">
		<div class="totalizadores_rodape_bandeja">
			<p>{{trans('pages.BP-TtPaci')}} <span class="count_pac">0</span> - {{trans('pages.BP-TtExam')}} <span class="count_exam">0</span></p>
		</div>
		<div class="env_btn_enviar_bandeja">
			<a href="" class="bt_azul btn_enviar_pedidos_bandeja">{{trans('pages.BP-BtnEnvPed')}}</a>
		</div>
	</div>

@endif