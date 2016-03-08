@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	@if(Session::get('relGestaoPerformance') == '8100;1')
		<!-- Titulo dos relatórios de gestão e performance -->
		<section class="tt_principal_pg_fixo">
			<img src="{{asset('img/icones/grafico.png')}}"><h1>{{trans('pages.PG-RelGesPer')}}</h1>
		</section><!-- Fim do titulo dos relatórios de gestão e performance -->
	
		@if(Session::get('evoAtivRem') == '8104;1')
			<section class="env_linha_conteudo">
				<div class="linha_relatorio">
					<span>{{trans('pages.PG-EvoAtiRemMes')}}</span>
					<form action="" class="form_atividade_remetida_mes">
						<select name="mesEscolhido" id="">
							<option value="03/2015">Março</option>
							<option value="02/2015">Febreiro</option>
							<option value="01/2015">Janeiro</option>
							<option value="0" selected>Selecione</option>
						</select>
						<input type="submit" value="{{trans('pages.PG-GerExc')}}">
					</form>	
						
					<div class="separador_vertical_relatorio"></div>
					<a href="" class="bt_azul btn_mostrar_tela_realtorio rel_evo_atv_rem">
						<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_btn_mostrar_conteudo_relatorio">
						<p class="txt_btn_relatorio_mostrar">{{trans('pages.PG-Mostar')}}</p>
						<p class="txt_btn_relatorio_ocultar">{{trans('pages.PG-Ocultar')}}</p>
					</a>
				</div>
				<div class="env_conteudo_relatorio">
					<div class="tabela_evolucao_atividade_remetida_mes">
						
					</div>

					<hr class="hr_conteudo_relatorios">

					<div id="grafico_evolucao_atividade_remetida_mes" style="width: 70%; height: 300px;margin-left:15%;float:left;"></div>
					<div class="fecha_conteudo_relatorio"><img src="{{asset('img/icones/flecha_abre_fecha_azul.png')}}" title="{{trans('pages.TtPG-EscCont')}}" class="btn_esconder_conteudo_relatorio"></div>
				</div>
			</section>
		@endif

		@if(Session::get('evoDiverParamRemMes') == '8101;1')		
			<section class="env_linha_conteudo">
				<div class="linha_relatorio">
					<span>{{trans('pages.PG-EvoDiveParRemMes')}}</span>
					<a href="" class="bt_azul btn_mostrar_tela_realtorio rel_div_par_rem">
						<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_btn_mostrar_conteudo_relatorio">
						<p class="txt_btn_relatorio_mostrar">{{trans('pages.PG-Mostar')}}</p>
						<p class="txt_btn_relatorio_ocultar">{{trans('pages.PG-Ocultar')}}</p>
					</a>
				</div>
				<div class="env_conteudo_relatorio">
					<div class="tabela_evolucao_diversidade_parametros_remetidos_mes">
						
					</div>
					
					<hr class="hr_conteudo_relatorios">

					<div id="grafico_evolucao_diversidade_parametros_remetidos_mes"style="width: 70%; height: 300px;margin-left:15%;float:left;"></div>
					<div class="fecha_conteudo_relatorio"><img src="{{asset('img/icones/flecha_abre_fecha_azul.png')}}" title="{{trans('pages.TtPG-EscCont')}}" class="btn_esconder_conteudo_relatorio"></div>
				</div>
			</section>
		@endif

		@if(Session::get('comprimentoPrazo') == '8102;1')
			<section class="env_linha_conteudo">
				<div class="linha_relatorio">
					<span>{{trans('pages.PG-RelComPra')}}</span>
					<a href="" class="bt_azul btn_mostrar_tela_realtorio rel_comprimento_prazo">
						<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_btn_mostrar_conteudo_relatorio">
						<p class="txt_btn_relatorio_mostrar">{{trans('pages.PG-Mostar')}}</p>
						<p class="txt_btn_relatorio_ocultar">{{trans('pages.PG-Ocultar')}}</p>
					</a>
				</div>
				<div class="env_conteudo_relatorio">
					<div class="tabela_comprimento_prazo">
						
					</div>
					
					<hr class="hr_conteudo_relatorios">

					<div id="grafico_comprimento_prazo" style="width: 70%; height: 300px;margin-left:15%;float:left;"></div>
					<div class="fecha_conteudo_relatorio"><img src="{{asset('img/icones/flecha_abre_fecha_azul.png')}}" title="{{trans('pages.TtPG-EscCont')}}" class="btn_esconder_conteudo_relatorio"></div>
				</div>
			</section>
		@endif

		@if(Session::get('ocorrenciaOrigemMes') == '8103;1')
			<section class="env_linha_conteudo">
				<div class="linha_relatorio">
					<span>{{trans('pages.PG-RelOcoOriMes')}}</span>
					<a href="" class="bt_azul btn_mostrar_tela_realtorio rel_ocorrencia_origem">
						<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_btn_mostrar_conteudo_relatorio">
						<p class="txt_btn_relatorio_mostrar">{{trans('pages.PG-Mostar')}}</p>
						<p class="txt_btn_relatorio_ocultar">{{trans('pages.PG-Ocultar')}}</p>
					</a>
				</div>
				<div class="env_conteudo_relatorio">
					<div class="tabela_ocorrencia_origem_mes">
						
						
					</div>
					<hr class="hr_conteudo_relatorios">

					<div id="grafico_ocorrencia_origem_mes" style="width: 70%; height: 300px;margin-left:15%;float:left;"></div>
					<div class="fecha_conteudo_relatorio"><img src="{{asset('img/icones/flecha_abre_fecha_azul.png')}}" title="{{trans('pages.TtPG-EscCont')}}" class="btn_esconder_conteudo_relatorio"></div>
				</div>					
			</section>
		@endif
	
	@endif

	<!-- ********************************************************************************************************************* -->

	@if(Session::get('relGestaoPerformance') == '8100;0')
		<div class="espaco_gerenciamento"></div>
	@endif

	<!-- ********************************************************************************************************************* -->
	
	@if(Session::get('relFinanceiros') == '8200;1')
		<!-- Titulos do relatórios financeiros -->
		<section class="tt_principal_pg_fixo tt_pricipal_pg_fixo_relatorio_financeiro">
			<img src="{{asset('img/icones/grafico.png')}}"><h1>{{trans('pages.PG-RelFin')}}</h1>
		</section><!-- Fim do titulo de relatórios financeiros -->					
	
		@if(Session::get('faturaConExam') == '8201;1')
			<div class="linha_relatorio">
				<span>{{trans('pages.PG-FatConMes')}}:</span>    
				<form action="{{url('/gerenciamento/fatura-por-exame')}}" method="POST" class="form_fatura_consolidada_mes">
					<select name="mesEscolhido" id="">
					
					</select>
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
					<input type="submit" value="{{trans('pages.PG-GerExc')}}">
				</form>
			</div>
		@endif

		@if(Session::get('conFaturaMes') == '8202;1')
			<div class="linha_relatorio">
				<span>{{trans('pages.PG-ConFatMes')}}</span>
				<form action="{{url('/gerenciamento/fatura-por-mes')}}" method="POST" class="form_conferencia_fatura_mes">
					<select name="mesEscolhido" id="">
						
					</select>
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
					<input type="submit" value="{{trans('pages.PG-GerExc')}}">
				</form>
				<div class="separador_vertical_relatorio"></div>
				<a href="" class="bt_azul btn_gerar_pdf_relatorio">{{trans('pages.PG-GerPDF')}}</a>
			</div>
		@endif
	@endif

@stop

@section('alertas')		
	<p class="msg_p_erro alerta_msg_falha"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMPG-NaoPosGerExc')}}</p>	
@stop

@section('scripts')
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>	
	<script type="text/javascript" src="{{asset('js/ger.js')}}"></script>
@stop