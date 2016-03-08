@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	<!-- Section que envolve as informações importantes da logistica. -->
	<section class="env_cx_informacoes_importantes_logistica">
		<div class="tt_cx_conteudo_fixo">
			<span>{{trans('pages.PL-TtInfImpo')}}</span>
		</div>
		<div class="cx_conteudo_fixo">
			<div class="env_informacoes_importantes_logistica">
				<div class="informacoes_importantes_logistica">
					<a href="{{url('/logistica/docs/Genetica')}}" target="blank"><img src="{{asset('img/icones/pdf.png')}}" title="{{trans('pages.TtPL-VisPDF')}}"><span>{{trans('pages.PL-RegEnvMatGen')}}</span></a>
				</div>
				<div class="informacoes_importantes_logistica">
					<a href="{{url('/logistica/docs/General')}}" target="blank"><img src="{{asset('img/icones/pdf.png')}}" title="{{trans('pages.TtPL-VisPDF')}}"><span>{{trans('pages.PL-DocEnvMat')}}</span></a>
				</div>
			</div>
		</div>
	</section><!-- Fim da section envolve as informações importantes da logistica. -->

	<section class="env_cx_envio_material_genetico">
		<div class="tt_cx_conteudo_fixo">
			<span>{{trans('pages.PL-AviEnvMatBio')}}</span>
		</div>
		<div class="cx_conteudo_fixo">
			<h4>{{trans('pages.PL-CriLotEnv')}}</h4>
			<form action="" class="form_envio_material_logistica">
				<label for="" class="lb_num_lote">{{trans('pages.PL-NumLot')}} </label>
				<input type="text" name="numeroLote" class="input_numero_lote " disabled>
				<img src="{{asset('img/icones/atualizar.png')}}" class="bt_atulizar atualizar_lote_click" title="{{trans('pages.TtPL-GerNumLot')}}">
				
				<input type="text" name="envioMaterialFisico" class="input_envio_material_fisico" >
				<label for="" class="lb_data_envio ">{{trans('pages.PL-DatEnvFis')}} </label>

				<div class="estilo_barra_resultados env_tt_envio_material_biologico">
					<span class="tt_referencia_cx">{{trans('pages.PL-RefCai')}}</span>
					<span>{{trans('pages.PL-QutVol')}}</span>
					<span class="tt_tamanho_material">{{trans('pages.PL-Tamanho')}}</span>
					<span class="tt_conservacao">{{trans('pages.PL-Conser')}}</span>
					<span>{{trans('pages.PL-TempSai')}}</span>
					<span>{{trans('pages.PL-QtdeAmos')}}</span>
					<span><img src="{{asset('img/icones/x_preto.png')}}"></span>
				</div>
				
				<div class="env_linha_envio_material">
				<div class="linha_envio_material">
					<div class="ref_cx_env_mat">
						<input type="text" name="referenciaCaixa">
					</div>
					<div class="qtde_volumes_env_mat">
						<input type="number" name="qtdeVolumes" min=1>
					</div>
					<div class="tamanho_env_mat">
						<select name="tamanhoCx" id="">
							<option value="Pequeno">{{trans('pages.PL-Peq')}}</option>
							<option value="Médio">{{trans('pages.PL-Med')}}</option>
							<option value="Grande">{{trans('pages.PL-Gra')}}</option>
							<option value="" selected>{{trans('pages.PL-Sel')}}</option>
						</select>
					</div>
					<div class="conservacao_env_mat">
						<select name="conservacaoAmostra" id="">
							<option value="Congelado">{{trans('pages.PL-Con')}}</option>
							<option value="Resfriado">{{trans('pages.PL-Ref')}}</option>
							<option value="Temperatura Ambiente">{{trans('pages.PL-TemAmb')}}</option>
							<option value="" selected>{{trans('pages.PL-Sel')}}</option>
						</select>
					</div>
					<div class="temp_saida_env_mat">
						<input type="text" name="temperaturaSaida">
					</div>
					<div class="qtde_amostras_env_mat">
						<input type="number" name="quantidadeAmostras" min=1>
					</div>
					<div class="x_env_mat">
						<a href="" class="x_env_mat_click"><img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtPL-ExcCai')}}"></a>
					</div>
				</div>
				</div>
				
				<div class="empurra_add_linha_btn"></div>
				
				<div class="add_linha add_linha_lote">
					<img src="{{asset('img/icones/mais.png')}}"><span>{{trans('pages.PL-AddCai')}}</span>
				</div>	
				<input type="submit" value="{{trans('pages.PL-BtnEnv')}}">
			</form>
		</div>
	</section>

	@if(!$materiais == '0')
		<section class="env_cx_solicitacao_material">
			<div class="tt_cx_conteudo_fixo">
				<span>{{trans('pages.PL-ReqMat')}}</span>
			</div>
			<div class="cx_conteudo_fixo">
				<h4>{{trans('pages.PL-CriReq')}}</h4>
				<form action="" class="form_solicitar_material">
					<label for="" class="lb_num_requisicao">{{trans('pages.PL-NumReq')}} </label>
					<input type="text" name="numeroRequisicao" class="input_numero_requisicao " disabled>
					<img src="{{asset('img/icones/atualizar.png')}}" class="bt_atulizar atualizar_requisicao_click" title="{{trans('pages.TtPL-GerNumReq')}}">

					<input type="text" name="dataSolicitacao" class="input_data_solicitacao" >
					<label for="" class="lb_data_solicitacao ">{{trans('pages.PL-DtSol')}} </label>

					<div class="estilo_barra_resultados env_tt_solicitacao">
						<span class="tt_material_solicitacao">{{trans('pages.PL-Material')}}</span>
						<span class="tt_qtde_solicitacao">{{trans('pages.PL-QtdeUni')}}</span>
						<span class="tt_utilizacao_solicitacao">{{trans('pages.PL-UniBase')}}</span>
						<span class="tt_total_solicitacao">{{trans('pages.PL-Total')}}</span>
						<span class="tt_total_img"><img src="{{asset('img/icones/x_preto.png')}}"></span>
					</div>
					
					<div class="env_linha_solicitacao_material">
					<div class="linha_solicitacao_material">
						<div class="nome_material">
							<select name="nomeMaterial" id="">
								@foreach($materiais as $material)
									<option value="{{utf8_encode($material)}}">{{utf8_encode($material)}}</option>
								@endforeach
								
								<option value="" selected>{{trans('pages.PL-Sel')}}</option>
							</select>
						</div>
						<div class="qtde_solicitacao">
							<input type="number" name="qtdeSolicitacao" min=1>
						</div>
						<div class="utilizacao_solicitacao">
							<select name="utilizacaoSolicitacao" id="">
								@foreach($units as $unit)
									<option value="{{utf8_encode($unit)}}">{{utf8_encode($unit)}}</option>
								@endforeach
								<option value="" selected>{{trans('pages.PL-Sel')}}</option>
							</select>
						</div>
						<div class="total_solicitacao">
							<input type="number" name="totalSolicitacao" min=1>
						</div>
						<div class="img_solicitacao">
							<a href="" class="img_solicitacao_click"><img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtPL-IncMat')}}"></a>
						</div>
					</div>
					</div>

					<div class="empurra_add_linha_btn"></div>
					
					<div class="add_linha add_linha_solicitacao">
						<img src="{{asset('img/icones/mais.png')}}"><span>{{trans('pages.PL-AddMat')}}</span>
					</div>	
					<input type="submit" value="{{trans('pages.PL-BtnEnv')}}">
				</form>
			</div>
		</section>
	@endif

@stop

@section('alertas')
	<p class="msg_p_alerta alerta_msg_preencher_campos"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.PL-TodCamDevPre')}}</p>
	<p class="msg_p_erro alerta_msg_erro_envio"><span>{{trans('pages.AG-Atencao')}}! </span>{{trans('pages.PL-NaoPosEnvInf')}}</p>
	<p class="msg_p_erro alerta_msg_erro_requisicao"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.PL-NaoPosEnvReqMat')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviada"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.PL-EnvAvEnvMatBio')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviada_requisicao"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.PL-ReqMatEnv')}}</p>
@stop

@section('scripts')
    <script src="{{asset('js/log.js')}}"></script>
@stop