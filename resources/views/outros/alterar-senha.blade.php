@extends('template')

@section('conteudo')
	<h1 class="tt_alterar_senha">{{trans('pages.PA-TtAltSen')}}</h1>
					
	<form action="{{url('/alt-sen')}}" method="POST" name="form_alterar_senha" class="form_alterar_senha">
		<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">
		<label for="">
			<span>{{trans('pages.PA-DigSenNov')}}</span>
			<input type="password" name="senhaatual">
			@if($errors->has('senhaatual'))
				<span class="msg_erros_alterar_senha">{{$errors->first('senhaatual')}}</span>
			@endif
		</label>
		<label for="">
			<span>{{trans('pages.PA-SenNov')}}</span>
			<input type="password" name="senhanova">
			@if($errors->has('senhanova'))
				<span class="msg_erros_alterar_senha">{{$errors->first('senhanova')}}</span>
			@endif
		</label>
		<label for="">
			<span>{{trans('pages.PA-ConfNovSen')}}</span>
			<input type="password" name="confirmarsenha">
			@if($errors->has('confirmarsenha'))
				<span class="msg_erros_alterar_senha">{{$errors->first('confirmarsenha')}}</span>	
			@endif
		</label>
		<div class="env_botao_alterarsenha">
			<input type="submit" value="{{trans('pages.PA-BtnAltSen')}}">	
		</div>
		@if(Session::has('altsen'))			
			<span class="mensagem_sucesso_alterarsenha">{{trans('pages.PA-SenAltSuc')}}</span>				
		@endif
		@if(Session::has('failsen'))
			<span class="mensagem_falha_alterarsenha">{{trans('pages.PA-FalAltSen')}}</span>
		@endif
	</form>
@stop