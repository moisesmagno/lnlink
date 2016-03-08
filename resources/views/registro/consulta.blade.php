@extends('template')

@section('conteudo')

		<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	<section class="tt_principal_pg_fixo">
		<img src="{{asset('img/icones/olho_branco.png')}}" class="img_tt_principal_consulta_registros_enviados"><h1>{{trans('pages.RE-ConRegEnv')}}</h1>
	</section>

	<!-- Div que envolve todas as divs da consulta de registros enviados -->
	<section class="env_tudo_consultar_registros_enviados">
		
		<section class="env_cx_busca_consulta_registros_enviados">
			<div class="tt_cx_buscas_dinamico">
				<span>{{trans('pages.RE-TtConReg')}}</span>
			</div>
			<div class="cx_buscas_dinamico">
				<form action="" name="form_consultar_registros_enviados" class="form_consultar_registros_enviados">
					<label for=""><span>{{trans('pages.RE-Dtini')}}</span>
						<img src="{{asset('img/icones/calendario_inputs.png')}}"><input type="text" name="dataInicial" class="datainicial">
					</label>
					<label for=""><span>{{trans('pages.RE-DtFin')}}</span>
						<img src="{{asset('img/icones/calendario_inputs.png')}}"><input type="text" name="dataFinal" class="datafinal">
					</label>
					<label for="" class="lb_tipo_consulta"><span>{{trans('pages.RE-TipCon')}}</span>
						<select name="tipoConsulta" id="">
							<option value="1">{{trans('pages.RE-Sopac')}}</option>
							<option value="2">{{trans('pages.RE-PacExa')}}</option>							
						</select>
					</label>
					<input type="submit" value="{{trans('pages.RE-BtnCons')}}">
				</form>
			</div>	
		</section>

		<hr class="linha_horizontal_consulta_registro_enviados">


		<div class="env_conteudo_registro_consulta_alvo">	
		
		</div>
	</section><!-- Fim da Div que envolve todas as divs de consulta de registros enviados -->

@stop

@section('scripts')
	<script type="text/javascript" src="{{asset('js/reg-con.js')}}"></script>
@stop