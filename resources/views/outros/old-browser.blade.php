@extends('template_externos')
	
	@section('conteudo')
		<p class="env_msg_atualizar_navegador">
			<span>{{trans('pages.AG-Atencao')}}</span>
			<BR>
			{{trans('pages.AN-text1')}}<br><br>
			{{trans('pages.AN-text2')}}  
		</p>	

		<div class="env_navegadores">
			<div class="linha_navegador">
				<a href="http://www.google.com.br/chrome/browser/desktop/" target="_blank"><img src="{{ asset('img/icones/chrome.png') }}" title="Chrome"></a>
				<a href="http://windows.microsoft.com/pt-br/windows/downloads" target="_blank"><img src="{{ asset('img/icones/ie.png') }}" title="Internet Explorer"></a>
			</div>
			<div class="linha_navegador">
				<a href="https://www.mozilla.org/firefox/new/" target="_blank"><img src="{{ asset('img/icones/firefox.png') }}" title="Firefox"></a>
				<a href="https://support.apple.com/downloads/safari" target="_blank"><img src="{{ asset('img/icones/safari.png') }}" title="Safari"></a>
				<a href="http://www.opera.com/" target="_blank"><img src="{{ asset('img/icones/opera.png') }}" title="Opera"></a>
			</div>
		</div>
	@stop