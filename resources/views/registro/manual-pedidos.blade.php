<div class="env_pacientes_adicionados_registro">

	@if($pacientes == '0')

		<span class="msg_sem_pacientes_adicionados">{{trans('pages.RM-NaoExAdd')}}!</span>

	@else

		@foreach($pacientes as $paciente)

			<div class="linha_pacientes_adicionados_registro">
				<div class="paciente_adicionado_registro">
					<div class="nome_paciente_adiconado_registro">{{utf8_encode($paciente[3]).' '.utf8_encode($paciente[2])}}</div>
					<div class="total_exames_registro">{{$paciente['count']}}</div>
					<div class="op_paciente_adicionado_registro">
						<input type="hidden" value="{{utf8_encode($paciente[0])}}" name="petCod">
						<img src="{{asset('img/icones/olho.png')}}" title="{{trans('pages.TtRM-VisExa')}}" class="img_olho_registro">
						<img src="{{asset('img/icones/lapis.png')}}" class="img_lapis_registro_pedidos" title="{{trans('pages.TtRM-EdiPed')}}">
						<img src="{{asset('img/icones/x.png')}}" class="img_x_registro_pedidos" title="{{trans('pages.TtRM-ExcPed')}}">
					</div>
				</div>
				<div class="exames_vinculados_paciente_registro">
					@foreach($paciente['exames'] as $exame)

						<?php 
							$aux = explode('|', $exame);
							$type = $aux[1];
							$label = $aux[0];
						 ?>
					
						@if($type == '1')		
							<div class="exame_vinculado_ta">
								<span class="exame_vinculado_ta_registro">{{trans('pages.TG-SigLegTA')}}</span>
								<span class="nome_exame_vinculado_registro">{{utf8_encode($label)}}</span>
							</div>
						@endif
						@if($type == '2')
							<div class="exame_vinculado_r">
								<span class="exame_vinculado_r_registro">{{trans('pages.TG-SigLegR')}}</span>
								<span class="nome_exame_vinculado_registro">{{utf8_encode($label)}}</span>
							</div>
						@endif
						@if($type == '3')
							<div class="exame_vinculado_c">
								<span class="exame_vinculado_c_registro">{{trans('pages.TG-SigLegC')}}</span>
								<span class="nome_exame_vinculado_registro">{{utf8_encode($label)}}</span>
							</div>
						@endif

					@endforeach
				</div>
			</div>
		@endforeach

		<div class="env_totalizadores_bt_enviar_registro_manual">
			<div class="totalizadores_registro_manual"><p>{{trans('pages.RM-Pac')}}: <span class="deixa_letra_negrito count_pac">0</span> - {{trans('pages.RM-Exa')}}: <span class="deixa_letra_negrito count_exam">0</span></p></div>
			<div class="env_bt_enviar_pedidos_registro"><a href="" class="bt_azul bt_enviar_pedidos">{{trans('pages.RM-BtnEnvPed')}}</a></div>
		</div>

	@endif
	
</div>


