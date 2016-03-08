@extends('template_externos')
	
	@section('conteudo')
		<p class="env_msg_noJavaScript">
			<span>{{trans('pages.AG-Atencao')}}</span>
			<br>
			{{trans('pages.JSD-text1')}}<br>
			{{trans('pages.JSD-text2')}}  
			<br>
			<br>
			{{trans('pages.JSD-text3')}} <a href="http://www.labconous.com/">www.labconous.com</a> {{trans('pages.JSD-text4')}} 
		</p>
	@stop	
