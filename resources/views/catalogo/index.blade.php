@extends('template')

@section('filtro-lateral')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	<!-- Filtro flutuante do lado esquerdo -->
	<section class="env_filtro_flutuante_lateral">
		<div class="conteudo_filtro">
			<div class="formulario_Abertura">
				<form action="" class="form_filtro_lateral">
					<h1>{{trans('pages.C-FilPor')}}</h1>
					<div class="env_especialidade env_especialidade_esplab">
						<div class="tt_filtro clicado tt_filtro_primero">
							<span>{{trans('pages.C-FilExpLab')}}</span>
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}" class="img_seta_filtro_catalogo estilo_unico_seta">
						</div>

						<div class="cont_especialidade cont_especialidade_aberto">

							@if(!$esplab == '0')								

								@foreach($esplab as $esp)

									<div class="linha_cont_especialidade">
										<input type="checkbox" class="catalogo_filtro_esp_click f_esplab" value="{{utf8_encode($esp)}}">
										<span>{{utf8_encode($esp)}}</span>
									</div>										

								@endforeach

							@endif
							
						</div>
					</div>
					
					<div class="env_especialidade env_especialidade_sublab">
						<div class="tt_filtro">
							<span>{{trans('pages.C-FilSubEspLab')}}</span>
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}" class="img_seta_filtro_catalogo">
						</div>
						<div class="cont_especialidade cont_especialidade_sublab"></div>
					</div>

					<div class="env_especialidade env_especialidade_espcli">
						<div class="tt_filtro">
							<span>{{trans('pages.C-FilEspMed')}}</span>
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}" class="img_seta_filtro_catalogo">
						</div>
						<div class="cont_especialidade">
							@if(!$espcli == '0')								

									@foreach($espcli as $esp)

										<div class="linha_cont_especialidade">
											<input type="checkbox" class="catalogo_filtro_esp_click f_espcli" value="{{utf8_encode($esp)}}">
											<span>{{utf8_encode($esp)}}</span>
										</div>										

									@endforeach

								@endif
						</div>
					</div>
					<div class="env_especialidade env_especialidade_amostra">
						<div class="tt_filtro">
							<span>{{trans('pages.C-FilAmos')}}</span>
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}" class="img_seta_filtro_catalogo">
						</div>
						<div class="cont_especialidade">
							@if(!$amostras == '0')								

									@foreach($amostras as $esp)

										<div class="linha_cont_especialidade">
											<input type="checkbox" class="catalogo_filtro_esp_click f_amostra" value="{{utf8_encode($esp)}}">
											<span>{{utf8_encode($esp)}}</span>
										</div>										

									@endforeach

								@endif
						</div>

					</div>
				</form>
			</div>
		</div>

		<div class="aberturaFiltro">
			<img src="{{asset('img/icones/x_vermelho1.png')}}" class="x_fecha_filtro">
			<span class="btn_filtro_lateral" style="display:none">
				<?php
					if('Filtro' == trans('pages.C-Filto')){
						echo "F<br>i<br>l<br>t<br>r<br>o";
					}elseif('Filtro' == '1'){
						//echo "F<br>i<br>l<br>t<br>r<br>o";
					}elseif('Filtro' == '2'){
						//echo "F<br>i<br>l<br>t<br>r<br>o";
					}elseif('Filtro' == '3'){
						//echo "F<br>i<br>l<br>t<br>r<br>o";	
					}elseif('Filtro' == '3'){
						//echo "F<br>i<br>l<br>t<br>r<br>o";	
					}
				?>
			</span>
		</div>
	</section><!-- Fim do filtro flutuante do lado esquerdo -->

@stop

@section('conteudo')

	<!-- Section que envolve toda a busca -->
	<section class="env_buscador_catalogo">
		<div class="tt_cx_conteudo_responsivo">
			<span>{{trans('pages.C-BusExa')}}</span>
		</div>
		<div class="cx_conteudo_responsivo">
			<form action="" class="form_buscador_catalogo" name="form_buscador_catalogo">

				<!-- Fm do resultado da busca digitada -->

				<div class="row buscador">
					<div class="layout-1 env_lupa_buscador">
						<img src="{{asset('img/icones/lupa_branco.png')}}" class="lupa_catalogo">
					</div>	
					<div class="layout-10 env_input_buscador">
						<img src="{{asset('img/icones/lupa_azul.png')}}">
						<input type="text" class="input_buscador_catalogo" id="input_catalogo_autocomplete" placeholder="{{trans('pages.C-BusExa')}}" autofocus>
						
					</div>
					<div class="layout-1 env_flecha_abre_fecha">
						<img src="{{asset('img/icones/flecha_abre_fecha_branco.png')}}" class="flecha_abre_fecha_catalogo">
					</div>
				</div>
				<div class="row filtro_catalogo">
					
					<div class="envFiltrosCat">
						<div class="layout-6 env_duplas_filtro">
							<label for="">
								<span>{{trans('pages.C-FilExpLab1')}} <br class="pulo_linha_lb_filtro_catalogo">{{trans('pages.C-FilExpLab2')}}</span>
								<select name="especialidadeLaboratorio" class="select_esp_lab_load select_esp_auto_load">								
									@if($esplab == '0')
										<option value="">{{trans('pages.C-FilSel')}}</option>
									@else
										
										<option value="">{{trans('pages.C-FilSel')}}</option>

										@foreach($esplab as $esp)

											<option value="{{utf8_encode($esp)}}">{{utf8_encode($esp)}}</option>

										@endforeach

									@endif

								</select>
							</label>
							<label for="">
								<span>{{trans('pages.C-FilSubEspLab1')}} <br class="pulo_linha_lb_filtro_catalogo">{{trans('pages.C-FilSubEspLab2')}}</span>
								<select name="subEspecialidadeLaboratorio" class="select_esp_sub_load select_esp_auto_load">
									
									<option value="" selected>{{trans('pages.C-FilSel')}}</option>
								</select>
							</label>	
						</div>
						<div class="layout-6 env_duplas_filtro">
							<label for="">
								<span>{{trans('pages.C-FilEspMed')}}</span>
								<select name="especialidadeMedica" class="select_esp_cli_load select_esp_auto_load">
									
									@if($espcli == '0')
										<option value="">{{trans('pages.C-FilSel')}}</option>
									@else
										
										<option value="">{{trans('pages.C-FilSel')}}</option>

										@foreach($espcli as $esp)

											<option value="{{utf8_encode($esp)}}">{{utf8_encode($esp)}}</option>

										@endforeach

									@endif
								</select>
							</label>
							<label for="">
								<span>{{trans('pages.C-FilAmos')}}</span>
								<select name="amostra" class="select_esp_amostra_load select_esp_auto_load">								
									@if($amostras == '0')
										<option value="">{{trans('pages.C-FilSel')}}</option>
									@else
										
										<option value="">{{trans('pages.C-FilSel')}}</option>

										@foreach($amostras as $esp)

											<option value="{{utf8_encode($esp)}}">{{utf8_encode($esp)}}</option>

										@endforeach

									@endif
								</select>
							</label>
						</div>
						
						<hr class="separador_busca_catalogo">
					</div>
					
					<div class="env_input_submit_catalogo">
						<input type="submit" value="{{trans('pages.C-BtnBuscar')}}">	
					</div>
				</div>
			</form>
		</div>
	</section><!-- Fim da section que envolve toda a busca -->
	
	<section class="resultados_busca_catalogo">
		
	</section>
@stop

@section('alertas')
	<p class="msg_p_alerta alerta_msg_campos"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMC-PreMenOpcBus')}}</p>

	<p class="msg_p_alerta alerta_msg_ja_adicionado"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMC-ExJaAddLis')}}</p>
	<p class="msg_p_erro alerta_msg_falha"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMC-NaoPosAddExa')}}</p>
	<p class="msg_p_sucesso alerta_msg_adicionado"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.AMC-ExaAddLis')}}</p>
@stop

@section('scripts')	
	<script type="text/javascript" src="{{asset('js/cat.js')}}"></script>
@stop