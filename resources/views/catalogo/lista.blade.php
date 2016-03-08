@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
	<input type="hidden" name="userEmailSend" value="{{Session::get('email')}}">

	<section class="tt_principal_pg_fixo">
		<img src="{{asset('img/icones/lista.png')}}" style="padding-top: 13px; padding-bottom: 10px !important;"><h1>{{trans('pages.LE-LisExa')}}</h1>
	</section>

	<div class="env_conteudo_lista_exames_alvo"></div>						

@stop

@section('modal')

	<section class="telaoscura">

		@if(in_array(Session::get('codPais'), ['55','51','52','57']))		
			<!-- Modal solicitar informações -->
			<div class="modal_solicitar_informacao modal-janela" id="modal_solicitar_informacao">
				<div class="header_modal">
					<h1 class="tt_modal">{{trans('pages.LE-SolInfAdi')}}</h1>
					<img src="{{asset('img/icones/x_branco.png')}}" class="fechar-modal-lista" title="{{trans('pages.TlLE-FecJan')}}">
				</div>
				<div class="cx_conteudo_solicitacao_informacao_modal">
					<h3>{{trans('pages.LE-Exa')}}</h3>
					<div class="cx_exames_solicitacao_informacoes_modal">
						
					</div>
				</div>
				<form action="" class="form_envio_informacao_adicional">
					<label for="" class="lb_email_informacao_adicional">
						{{trans('pages.LE-AdicEmaRetor')}}
						<input type="text" name="emailsInformacaoAdicional"  autofocus>
					</label>
					<label for="" class="lb_descricao_informacao_adicional">
						{{trans('pages.LE-Desc')}}
						<textarea name="descricaoInfoAdicional"></textarea>
					</label>
					<input type="submit" value="{{trans('pages.LE-Solicitar')}}">
				</form>
			</div><!-- Fim do Modal solicitar informações -->	


			<!-- Modal solicitar contação -->
			<div class="modal_solicitar_cotacao modal-janela" id="modal_solicitar_cotacao">
				<div class="header_modal">
					<h1 class="tt_modal">{{trans('pages.LE-SolCot')}}</h1>
					<img src="{{asset('img/icones/x_branco.png')}}" class="fechar-modal-lista" title="{{trans('pages.TlLE-FecJan')}}">
				</div>
				<form action="" class="form_solicitar_cotacao">
					
					<div class="tt_solicitar_cotacao">
						<span>{{trans('pages.LE-Exa')}}</span>
						<span>{{trans('pages.LE-Qtde')}}</span>
					</div>
					<div class="cx_exames_solicitar_cotacao"></div>

					<label for="" class="lb_email_solicitar_cotacao">
						{{trans('pages.LE-AdicEmaRetor')}}
						<input type="text" name="emailsSolicitarCotacao" autofocus>
					</label>
					<label for="" class="lb_descricao_solicitar_cotacao">
						{{trans('pages.LE-Desc')}}
						<textarea name="descricaoSolicitacaoCot"></textarea>
					</label>
					<input type="submit" value="{{trans('pages.LE-Solicitar')}}">
				</form>
			</div><!-- Fim do Modal solicitar informações -->
		@endif

	</section>
@stop

@section('alertas')	
	<p class="msg_p_alerta alerta_msg_selecionar"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMLE-NenExaSel')}}</p>
	<p class="msg_p_erro alerta_msg_erro_solicitacao"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMLE-NaoPosEnvSol')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviada_solicitacao"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.AMLE-SuaSolEnvi')}}.</p>
	<p class="msg_p_alerta alerta_msg_selecionar_exames"><span>{{trans('pages.AG-Atencao')}}! </span>{{trans('pages.AMLE-NenExaFoiSel')}}</p>
	<p class="msg_p_alerta alerta_msg_preencher_quantidade"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMLE-InfQuaExa')}}</p>
	<p class="msg_p_alerta alerta_msg_preencher_emails"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMLE-InfEmaRet')}}</p>
	<p class="msg_p_alerta alerta_msg_preencher_desc"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMLE-DeiDes')}}</p>

	<p class="alert_excluir_todos_exames">{{trans('pages.TlLE-ReaDesExcTodExa')}}</p>
	<p class="alert_excluir_exame">{{trans('pages.TlLE-ReaDesExcExa')}}</p>
@stop

@section('scripts')
	<script type="text/javascript" src="{{asset('js/list.js')}}"></script>
@stop