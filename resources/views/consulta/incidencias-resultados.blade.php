@if($incidencias == '0')
	@if($tipo == 'Interna')
		<div class="mensagem_vazio_incidencias">
			<span>{{trans('pages.I-MsgNaoEncIncNous')}}</span>
		</div> 
	@endif
	@if($tipo == 'Externa')
		<div class="mensagem_vazio_incidencias">
			<span>{{trans('pages.I-MsgNaoEncIncCli')}}</span>
		</div> 
	@endif
@else

	<div class="estilo_barra_resultados env_tt_incidencias">
		<span class="tt_pacientes_icidencia">{{trans('pages.I-Pac')}}</span>
		<span class="tt_referencias_incidencias">{{trans('pages.I-Ref')}}</span>
		<span class="tt_exames_incidencias">{{trans('pages.I-Exa')}}</span>
		<span class="tt_subtipos_incidencias">{{trans('pages.I-Subti')}}</span>
		<span class="tt_img_incidencias"><img src="{{asset('img/icones/carta_preto.png')}}"></span>
	</div>

	@foreach($incidencias as $incidencia)
		
		<div class="env_linha_conteudo">
			<a href="">
				<div class="linha_incidencia">
					<?php 			
						if (!empty(trim($incidencia[1]))) {

							if(strlen($incidencia[1]) > 34){
								$nome = substr(utf8_encode($incidencia[1]), 0,34).'...';
							}else{
								$nome = utf8_encode($incidencia[1]);
							}	
						}else{
							$nome = '--';
						}
					?>

					<div class="paciente_linha_incidencia">
						<span>{{$nome}}</span>
					</div>

					<?php 		
						if (!empty(trim($incidencia[2]))) {
							$referencia = utf8_encode($incidencia[2]);
						}else{
							$referencia = '--';
						}
					?>
					
					<div class="referencia_linha_incidencia">
						<span>{{$referencia}}</span>
					</div>

					<?php 				
						if (!empty(trim($incidencia[3]))) {

							if(strlen($incidencia[3]) > 55){
								$exame = substr(utf8_encode($incidencia[3]), 0,55).'...';
							}else{
								$exame = utf8_encode($incidencia[3]);
							}	
						}else{
							$exame = '--';
						}
					?>

					<div class="exames_linha_incidencia">
						<span>{{$exame}}</span>
					</div>

					<?php 			
						if (!empty(trim($incidencia[4]))) {
							if(strlen($incidencia[4]) > 23){
								$subtipo = substr(utf8_encode($incidencia[4]), 0,23).'...';
							}else{
								$subtipo = utf8_encode($incidencia[4]);
							}	
						}else{
							$subtipo = '--';
						}
					?>

					<div class="subtipo_incidencia">
						<span>{{$subtipo}}</span>
					</div>
					
					<div class="img_carta_subtipo">
						<img src="{{asset('img/icones/carta.png')}}" title="{{trans('pages.TtI-AbrInc')}}">
					</div>
				</div>
			</a>	
			<div class="conteudo_incidencia">
				<h1>Relatório de Ocorrência</h1>
				<hr class="linha_separa_tt_textos">
					<?php 
						if ($tipo == 'Interna') {
							$origem = 'Noûs';	
						}else{
							$origem = trans('pages.I-Cli');	
						}
					?>
				<p><span>{{trans('pages.I-Origem')}} </span>{{$origem}}</p>
				<p><span>{{trans('pages.I-ConPac')}} </span>{{utf8_encode($incidencia[1])}}</p>
				@if(!empty(trim($incidencia[2])))
					<p><span>{{trans('pages.I-ConRef')}}: </span>{{utf8_encode($incidencia[2])}}</p>
				@endif
				@if(!empty(trim($incidencia[3])))
					<p><span>{{trans('pages.I-ConExa')}} </span>{{utf8_encode($incidencia[3])}}</p>
				@endif
				@if(!empty(trim($incidencia[4])))
					<p><span>{{trans('pages.I-ConSub')}} </span>{{utf8_encode($incidencia[4])}}</p>
				@endif
				@if(!empty(trim($incidencia[5])))
					<p><span>{{trans('pages.I-ConDes')}} </span>{{utf8_encode($incidencia[5])}}</p>
				@endif
				@if(!empty(trim($incidencia[6])))
					<p><span>{{trans('pages.I-ConCamLib')}} </span>{{utf8_encode($incidencia[6])}}</p>
				@endif	
				@if(!empty(trim($incidencia[7])))
					<p><span>{{trans('pages.I-ConDtComp')}} </span>{{utf8_encode($incidencia[7])}}</p>
				@endif		
				
				
				<hr class="linha_texto_formulario">

				

				<form action="" class="form_conteudo_incidencias">
					<label for="">
						<span>{{trans('pages.I-ConEnvCom')}} </span>
						<textarea name="descricao"></textarea>
					</label>
					<input type="hidden" name="hiddenpet" value="{{$incidencia[0]}}">
					<?php 
						$codexam = explode('-', $incidencia[3]);
					 ?>
					<input type="hidden" name="hiddenexam" value="{{$codexam[0]}}">
					<input type="submit" value="{{trans('pages.I-Env')}}">
				</form>


				<div class="env_btn_fechar_conteudo_incidencias">
					<img src="{{asset('img/icones/flecha_abre_fecha_azul.png')}}" class="btn_ocultar_conteudo_incidencias" title="{{trans('pages.TtI-OculCont')}}">
				</div>
			</div>
		</div>
	@endforeach

@endif