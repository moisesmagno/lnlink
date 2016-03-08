@if($arquivos == '0')
	<div class="sem_arquivos_busca_arquivos_integrados">
		<span>{{trans('pages.RI-NaoEncArqInt')}}</span>
	</div>	
@else
	<div class="estilo_barra_resultados tt_resultados_busca_arquivos_integrados">
		<span>{{trans('pages.RI-Arq')}}</span>
		<span>{{trans('pages.RI-TtPac')}}</span>
		<span>{{trans('pages.RI-TtExa')}}</span>
		<span>{{trans('pages.RI-DtEnv')}}</span>
	</div>

	<div class="env_linha_resultado_arquivo_integrado">
		
		<?php 
			$TtPacDt = 0;
			$TtExDt = 0;
		?>

		@foreach($arquivos as $arquivo)
			
				<div class="linha_resultado_arquivo_integrado">
					<img src="{{asset('img/icones/arquivo.png')}}">
					<div class="nome_resultado_arquivo_integrado">
						{!!$arquivo[0]!!}
					</div>
					<div class="total_pacientes_arquivo_integrado">
						{{$arquivo[1]}}
					</div>
					<div class="total_exames_arquivo_integrado">
						{{$arquivo[2]}}
					</div>
					<div class="total_exames_arquivo_integrado">
						{{$arquivo[3]}}
					</div>
				</div>

				<?php 
					$TtPacDt = $TtPacDt + $arquivo[1];
					$TtExDt = $TtExDt + $arquivo[2];
				?>
			
		@endforeach		
	</div>
	<!-- Totalizador -->
	<p class="totalizador_registros_integracao customizacao_totalizador_resultado_arquivos_integrados">
		<span> {{trans('pages.RI-Total')}}</span> 
		<!-- {{count($arquivos)}} {{trans('pages.RI-ArqSub')}} -->

		<?php
			if(count($arquivos) == 1){ $plural1 = '';}else{$plural1 = 's';}
			if($TtPacDt == 1){ $plural2 = '';}else{$plural2 = 's';}
			if($TtExDt == 1){ $plural3 = '';}else{$plural3 = 's';}
		?>


		{{count($arquivos)}} {{trans('pages.RI-ArqSub1')}}<?php echo $plural1;?> {{trans('pages.RI-ArqSub2')}}<?php echo $plural1;?> 
		- 
		<?php echo $TtPacDt; ?>
		{{trans('pages.RI-PacSub')}}<?php echo $plural2;?>
		-
		<?php echo $TtExDt; ?>
		{{trans('pages.RI-ExaSub')}}<?php echo $plural3;?>
	</p>
@endif