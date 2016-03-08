
@if(!$sublab == '0')	

	<div data-sublabdiv="{{$esplab}}">					

	@foreach($sublab as $esp)

		<div class="linha_cont_especialidade">
			<input type="checkbox" class="catalogo_filtro_esp_click f_sublab" value="{{utf8_encode($esp)}}">
			<span>{{utf8_encode($esp)}}</span>
		</div>										

	@endforeach
	
	</div>		

@endif



