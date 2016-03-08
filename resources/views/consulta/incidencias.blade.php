@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">

	<!-- Titulo dos relatórios de gestão e performance -->
	<section class="tt_principal_pg_fixo">
		<img src="{{asset('img/icones/lupa_branco.png')}}"><h1 class="tt_geral_incidencias">{{trans('pages.I-BusInc')}}</h1>
		<form action="" class="form_tipos_incidencias">
			<select name="tipoIncidencia" id="">
				<option value="1">{{trans('pages.I-IncNous')}}</option>
				<option value="2">{{trans('pages.I-IncCli')}}</option>
				<option value="0" selected>{{trans('pages.I-Sel')}}</option>
			</select>
			<input type="submit" value="{{trans('pages.I-BtnListar')}}">
		</form>
	</section><!-- Fim do titulo dos relatórios de gestão e performance -->	
	
	<div class="resultados_incidencias_target">
		<div class="mensagem_vazio_incidencias">
			<span>{{trans('pages.I-MsgBenVin1')}} <br> {{trans('pages.I-MsgBenVin2')}}</span>
		</div> 	
	</div>
@stop

@section('alertas')	
	<p class="msg_p_sucesso alerta_msg_enviado_comentario"><span>Sucesso!</span>Comentario enviado</p>
	<p class="msg_p_erro alerta_msg_erro_comentario"><span>Atenção!</span>Erro no envio do comentario!</p>	
	<p class="msg_p_alerta alerta_msg_comentario_vazio"><span>Atenção!</span>Comentario não pode ser vazio!</p>
@stop

@section('scripts')
    <script src="{{asset('js/cons-inc.js')}}"></script>
@stop