@if($exames == '0')

@else
	@foreach($exames as $exame)
		<?php 
			$aux = explode('-',$exame[0]);
			$cod = trim($aux[0]);
		?>
		<div class="linha_exame_vinculado_excluirExames">
			<input type="checkbox" value="{{$cod}}"><span>{{$exame[0]}}</span>
		</div>
	@endforeach
@endif