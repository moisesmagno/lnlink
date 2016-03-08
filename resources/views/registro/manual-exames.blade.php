@if($listaExames == '0')

 	<span>{{trans('pages.MRM-NemExaCad')}}</span>

@else
	@foreach($listaExames as $exame)
		<a class="exame_lista_click"><span>{{$exame['def']}}</span> <input type="hidden" value="{{$exame['cod']}}" name="exameListaCod"></a>
	@endforeach

	<div style="display:none" >
		@foreach($listaExames as $exame)
			{!!$exame['span']!!}
		@endforeach
	</div>
@endif