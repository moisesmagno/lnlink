@if($arquivos == '0')

	<div class="sem_arquivos_integrados_hoje">
		<span>{{trans('pages.RI-NaoArqIntHj')}}</span>
	</div>					

@else

	<div class="estilo_barra_resultados env_tt_integrados_hoje">
		<span>{{trans('pages.RI-Arq')}}</span>
		<span>{{trans('pages.RI-TtPac')}}</span>
		<span>{{trans('pages.RI-TtExa')}}</span>
	</div>
	<div class="env_linhas_arquivos_RI">
		<?php 
			$TtPac = 0;
			$TtEx = 0;
		?>
	
		@foreach($arquivos as $arquivo)
			<div class="linha_arquivo">
				<img src="{{asset('img/icones/arquivo.png')}}">
				<div class="nome_arquivo_integrado_hoje">
					{!!$arquivo[0]!!}
				</div>
				<div class="total_pacientes_arquivo_integrado_hoje">
					{{$arquivo[1]}}
				</div>
				<div class="total_exames_arquivo_integrado_hoje">
					{{$arquivo[2]}}
				</div>
			</div>
			<?php 
				$TtPac = $TtPac + $arquivo[1];
				$TtEx = $TtEx + $arquivo[2];
			?>
		@endforeach	
	</div>
	
	<!-- Totalizador -->
	<p class="totalizador_registros_integracao customizacao_totalizador_arquivos_integrados_hoje">
		<span>{{trans('pages.RI-Total')}}</span>
		 
		
		<?php
			if(count($arquivos) == 1){ $plural1 = '';}else{$plural1 = 's';}
			if($TtPac == 1){ $plural2 = '';}else{$plural2 = 's';}
			if($TtEx == 1){ $plural3 = '';}else{$plural3 = 's';}
		?>


		{{count($arquivos)}} {{trans('pages.RI-ArqSub1')}}<?php echo $plural1;?> {{trans('pages.RI-ArqSub2')}}<?php echo $plural1;?> 
		- 
		<?php echo $TtPac; ?>
		{{trans('pages.RI-PacSub')}}<?php echo $plural2;?>
		-
		<?php echo $TtEx; ?>
		{{trans('pages.RI-ExaSub')}}<?php echo $plural3;?>
	</p>

@endif