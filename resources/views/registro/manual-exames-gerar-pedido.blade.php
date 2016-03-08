@if($genPet == '0')

@else

	@foreach($genPet as $exame)

		@if(!empty($exame[4]))

			<?php 
				switch ($exame[2]) {
					case '1':
						$dataTip = trans('pages.TG-SigLegTAMin');
					break;
					case '2':
						$dataTip = trans('pages.TG-SigLegRMin');
					break;
					case '3':
						$dataTip = trans('pages.TG-SigLegCMin');
					break;	
				}
			 ?>

			<div class="env_exame_dependecias_add_registro">
				<span style="display:none" class="uniq_cod_exam isvp" data-cod="{{$exame[0]}}" data-codnome="{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}" data-tip="{{$dataTip}}"></span>
					<div class="exame_add_vp_registro">
						<span class="tc_exames_add_vp_registro">{{trans('pages.TG-SigLegVP')}}</span>
						<p><span class="span_exame_val">{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}</span><span class="span_amostra_exame_val">{{utf8_encode($exame[3])}}</span></p>
					</div>
					<img src="{{asset('img/icones/x.png')}}" class="x_apaga_exame_selecionado">
						
					<!-- Dependência do exame -->
					<div class="env_cont_dependencias env_cont_dependencias_vp">
						<div class="cont_dependencias">
							
							<div class="cria_espaco_dependencia_exame"></div>

							<form class="form_dependencias_exame">

								<?php
									 $deps = explode(';', $exame[4]);
									 $i = 0;
								 ?>

								@foreach($deps as $dep)
									
									<?php $aux = explode('|',$dep)?>

									@if($aux[1] == 'Input')
										<?php 
											$str = strtolower($aux[0]);
											$str = substr($str,0,2);
										?>

										@if($str == 'vo')
										
											<label class="input_dependencias_exame bool_dep_exam" data-label="{{$aux[0]}}" data-vp="0">{{$aux[0]}}: <input type="text" name="dependencia" class="rt_input_dep"> ml</label>
										
										@else
										
											<label class="input_dependencias_exame bool_dep_exam" data-label="{{$aux[0]}}" data-vp="0">{{$aux[0]}}: <input type="text" name="dependencia" class="rt_input_dep"></label>

										@endif

									@elseif($aux[1] == 'Radio')
										
										<label class="radio_dependencias_exame bool_dep_exam" data-label="{{$aux[0]}}" data-vp="0">{{$aux[0]}}<input type="radio" name="confirmacao{{$i}}" value="1"class="rt_radio_dep">{{trans('pages.RM-Sim')}}<input type="radio" name="confirmacao{{$i}}" value="0" class="rt_radio_dep">{{trans('pages.RM-Nao')}}</label>
									
									@else
										<div class="env_bot_link_externo_exame bool_dep_exam" data-label="{{$aux[0]}}" data-vp="0"><a href="" class="rt_link_dep">{{$aux[0]}}</a></div>
									@endif
									<?php $i++ ?>
								@endforeach
							
							</form>
						</div>
						<img src="{{asset('img/icones/flecha_cima_dependencias.png')}}" alt="Esconder dependências" class="flecha_esconder_dependencias">
					</div><!-- Fim da dependência do exame -->

					<!-- Bolinha -->
					<div class="abre_dependenecias_registro menu_bolinhas_vp">
						<div class="bolinha1"></div>
						<div class="bolinha2"></div>
						<div class="bolinha3"></div>
					</div><!-- Dim das Bolinhas -->
			</div><!-- Fim de verificar Pendências -->

		@else

			@if($exame[2] == '1')
				
				<div class="env_exame_dependecias_add_registro">
						<span style="display:none" class="uniq_cod_exam" data-cod="{{$exame[0]}}" data-codnome="{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}"></span>
							<div class="exame_add_ta_registro">
								<span class="tc_exames_add_ta_registro">{{trans('pages.TG-SigLegTA')}}</span>
								<p><span class="span_exame_val">{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}</span><span class="span_amostra_exame_val">{{utf8_encode($exame[3])}}</span></p>
							</div>
							<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
				</div><!-- Fim - Temperatura Ambiente -->
			@endif

			@if($exame[2] == '2')
				<div class="env_exame_dependecias_add_registro">
					<span style="display:none" class="uniq_cod_exam" data-cod="{{$exame[0]}}" data-codnome="{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}"></span>
					<div class="exame_add_r_registro">
						<span class="tc_exames_add_r_registro">{{trans('pages.TG-SigLegR')}}</span>
						<p><span class="span_exame_val">{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}</span><span class="span_amostra_exame_val">{{utf8_encode($exame[3])}}</span></p>

					</div>
					<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
				</div><!-- Fim - Resfriado -->
			@endif

			@if($exame[2] == '3')
					
				<div class="env_exame_dependecias_add_registro">
					<span style="display:none" class="uniq_cod_exam" data-cod="{{$exame[0]}}" data-codnome="{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}"></span>
					<div class="exame_add_c_registro">
						<span class="tc_exames_add_c_registro">{{trans('pages.TG-SigLegC')}}</span>
					<p><span class="span_exame_val">{{utf8_encode($exame[0]) .' - ' .utf8_encode($exame[1])}}</span><span class="span_amostra_exame_val">{{utf8_encode($exame[3])}}</span></p>

					</div>
					<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
				</div><!-- Fim  - Congelado -->

			@endif

		@endif	

	@endforeach

@endif
