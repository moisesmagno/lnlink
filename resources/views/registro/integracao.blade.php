@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	<section class="tt_principal_pg_fixo">
		<img src="{{asset('img/icones/bandeja.png')}}" style="padding-top: 13px; padding-bottom: 12px !important;"><h1>{{trans('pages.RI-RegInt')}}</h1>
	</section>

	<!-- Envolve a todo o conteúdo do envio de arquivo. -->
	<section class="env_cx_envio_arquivo">
		<div class="tt_cx_conteudo_fixo">
			<span>{{trans('pages.RI-TtEnvArq')}}</span>
		</div>
		<div class="cx_conteudo_fixo">
			<form action="{{url('/registro/integracao/upload')}}" method="POST" class="form_enviar_arquivo" name="form_enviar_arquivo" enctype="multipart/form-data" >
				<label for=""><span>{{trans('pages.RI-SubSelArqInt')}}</span>
					<input type="file" name="arquivoIntegracao" required>
					<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">
					<input type="submit" value="{{trans('pages.RI-BtnEnv')}}">
				</label>
			</form>
			<div class="dev_confirmacao">
				<hr>				
				
				@if(Session::has('arqenv'))
					<div class="msg_sucesso notificao_sucesso_envio_integrado">
						<img src="{{asset('img/icones/icone_sucesso.png')}}"><p><span>{{trans('pages.AG-Sucesso')}}</span>{{trans('pages.AMRI-ArqIntEnv')}}</p>
					</div>
				@endif

				@if(Session::has('failenv'))
					<div class="msg_falhar notificao_falha_envio_integrado">
						<img src="{{asset('img/icones/icone_falha.png')}}"><p><span>{{trans('pages.AG-Atencao')}}</span{{trans('pages.AMRI-OcoFalEnvArqTI')}}></p>
					</div>
				@endif

				@if(Session::has('failext'))
					<div class="msg_falhar notificao_falha_envio_integrado">
						<img src="{{asset('img/icones/icone_falha.png')}}"><p><span>{{trans('pages.AG-Atencao')}}</span>{{trans('pages.AMRI-ExtArqNaoAce')}}</p>
					</div>
				@endif
				
			</div>
			<div class="empurra_cont_envio_arquivo"></div>		
		</div>
	</section><!-- Envolve a todo o conteúdo do envio de arquivo. -->

	<!-- Section Envolve a todo o conteúdo dos arquivos integrados hoje. -->
	<section class="env_cx_integrados_hoje">
		<div class="tt_cx_conteudo_fixo">
			<span>{{trans('pages.RI-TtArqIntHj')}}</span>
		</div>
		<div class="cx_conteudo_fixo">
			<div class="env_integrados_hoje">			
				<div class="arquivos_integrados_hoje_alvo"></div>
			</div>	
		</div>
	</section><!-- Fim da Section que envolve a todo o conteúdo dos arquivos integrados hoje. -->

	<!-- Section Envolve a todo o conteúdo da busca de arquivos por data-->
	<section class="env_cx_busca_aquivos">
		<div class="tt_cx_conteudo_fixo">
			<span>{{trans('pages.RI-BusArqDt')}}</span>
		</div>
		<div class="cx_conteudo_fixo">
			<form action="" class="form_busca_arquivos_integrados" name="form_busca_arquivos_integrados">
				<label for=""><span>{{trans('pages.RI-DtIni')}}</span>
					<img src="{{asset('img/icones/calendario_inputs.png')}}"><input type="text" name="dataInicial" class="datainicial" >
				</label>
				<label for=""><span>{{trans('pages.RI-DtFin')}}</span>
					<img src="{{asset('img/icones/calendario_inputs.png')}}"><input type="text" name="dataFinal" class="datafinal">
				</label>
				<input type="submit" value="Buscar">
			</form>		
		</div>

		<div class="resultado_busca_registros_integrados_alvo"></div>
	</section><!-- Fim da Section Envolve a todo o conteúdo da busca de arquivos por data-->


@stop

@section('scripts')
	<script type="text/javascript" src="{{asset('js/reg-int.js')}}"></script>
@stop