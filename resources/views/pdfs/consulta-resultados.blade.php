<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{trans('pages.IPCRE-RegEnv')}}</title>
		<link rel="stylesheet" href="{{asset('css/pdfs.css')}}" type="text/css" media="all">
		<script>
			print();
		</script>
	</head>
	<body>
		<div class="botoes">
			<button onClick="window.print();">{{trans('pages.IPCRE-Imprimir')}}</button>
			<button onClick="window.close();">{{trans('pages.IPCRE-Fechar')}}</button>
		</div>	

		<figure class="env_logotipo"><img src="{{asset('img/logotipo.png')}}" alt=""></figure>

		<hr class="hr">

		@foreach($pacientes as $paciente) 
			<h2 class="nome" style="font-size: 21px">{{$paciente[2]}}</h2>
	
			<div class="tt_resultados">
				<p><span>{{trans('pages.IPCRE-TotExa')}} </span>{{$paciente['count']}}</p><br>
				@foreach($paciente['exames'] as $exame)
					<?php 
						$aux = explode('|', $exame);
						$type = $aux[1];
						$label = $aux[0];
					?>
					<p><span>-</span> {{utf8_encode($label)}}</p><br>
				@endforeach
			</div>
			<hr class="hr">
		@endforeach
		
	</body>
</html>


