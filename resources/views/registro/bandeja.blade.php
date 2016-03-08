@extends('template')

@section('conteudo')
	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
	<section class="tt_principal_pg_fixo">
		<img style="padding-top: 13px; padding-bottom: 12px !important;" src="{{asset('img/icones/bandeja.png')}}"><h1>{{trans('pages.BP-TtBP')}}</h1>
	</section>

	<section class="env_header_pacientes_exames"></section>
@stop

@section('alertas')	
	<p class="msg_p_sucesso alerta_msg_enviados"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.BP-PacEnv')}}</p>
	<p class="msg_p_erro alerta_msg_falha_envio"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.BP-FalEnvPac')}}</p>
	
	<p class="alert_excluir_pedido">{{trans('pages.TlBP-ReExcPed')}}</p>
	<p class="alert_excluir_todos_pedidos">{{trans('pages.TlBP-ExcTodPed')}}</p>
@stop

@section('scripts')
	<script type="text/javascript" src="{{asset('js/ban.js')}}"></script>
@stop