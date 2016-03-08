@if(count($exames) == 0)

	<div class="env_texto_resultados_vazio">
		<p>{{trans('pages.C-NaoEncNenExa')}}</p>
	</div>

@else
	<p>
		@foreach($filtros as $filtro)
			<span>{{$filtro}}</span>
		@endforeach
	</p>

	<div class="estilo_barra_resultados env_tt_resultados_catalogo">
		<span>{{trans('pages.C-Exa')}}</span>
	</div>

	@foreach($exames as $exame)

		<!-- Linha do exame encontrado -->
		<div class="linha_resultado_catalogo" data-esp="{{$exame['esplab'].$exame['sublab'].$exame['espcli'].$exame['amostra']}}">
			<a href="{{url(trans('routes.catalogo').'/'.trans('routes.exame').'/'.$exame['cod'])}}">
			<div class="nome_exame_catalogo">
				<span>{{$exame['value']}}</span>
			</div>
			</a>
			<div class="icone_add add_exame_lista_click"><img src="{{asset('img/icones/add_lista_azul.png')}}" title="{{trans('pages.TtC-AdiExaList')}}"> <input type="hidden" class="cod_exame_catalogo_resultado" value="{{$exame['cod']}}"> </div>
		</div><!-- Linha do exame encontrado -->	
	
	@endforeach		
@endif