@if($exames == '0')

@else
	@foreach($exames as $exame)
		@if($exame[1] == '0')
			<?php 
				$aux = explode('-',$exame[0]);
				$cod = trim($aux[0]);
			?>
			<div class="linha_exame_vinculado_solicitarUrgencia">
				<input type="checkbox" value="{{$cod}}"><span>{{$exame[0]}}</span>
			</div>

		@else
			<div class="linha_exame_vinculado_solicitarUrgencia">			
				<span>{{$exame[0]}} 
				<span id="exu">Já foi solicitado a ugência deste exame!</span>
				</span>
			</div>
		@endif
	@endforeach
@endif

