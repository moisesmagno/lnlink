@if($grupos == '0')

	<span>{{trans('pages.MRM-NenGruCad')}}</span>
	
@else

	@foreach($grupos as $grupo)
		<?php array_pop($grupo) ?>
		<div>
			<a class="grupos_da_lista_click"><span class="nomeGrupo">{{$grupo[0]}}</span></a><img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcGru')}}" class="exluir_grupo_click">
			<div style="display:none">
			    <?php array_shift($grupo)  ?>
				@foreach($grupo as $exame)		
				<span class="exames_do_grupo">{{$exame}}</span>		
				@endforeach
			</div>
		</div>
	@endforeach
	
	<div style="display:none" >
		@foreach($exames as $exame)
			{!!$exame['span']!!}
		@endforeach
	</div>

@endif