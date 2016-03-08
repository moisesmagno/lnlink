<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{trans('pages.IPR-resultado')}}</title>
		<link rel="stylesheet" href="{{asset('css/pdfs.css')}}" type="text/css" media="all">
		<script>
			print();
		</script>
	</head>
	<body>
		<div class="botoes">
			<button onClick="window.print();">{{trans('pages.IPR-Imprimir')}}</button>
			<button onClick="window.close();">{{trans('pages.IPR-Fecahr')}}</button>
		</div>	

		<figure class="env_logotipo"><img src="{{asset('img/logotipo.png')}}" alt=""></figure>

		<hr class="hr">

		@foreach($pedidos as $pedido) 
			<h2 class="nome" style="font-size: 21px">{{$pedido[0]}}</h2>
	
			<div class="tt_resultados">
				<p><span>{{trans('pages.IPR-DtReg')}}</span> {{$pedido[1]}}</p>
				<p><span>{{trans('pages.IPR-DtLib')}}</span> {{$pedido[2]}}</p>
				<br>
				<p><span{{trans('pages.IPR-Ref')}}></span> {{$pedido[3]}}</p>
				<p><span>{{trans('pages.IPR-PedNous')}}</span> {{$pedido[4]}}</p>
				<p><span>{{trans('pages.IPR-Sta')}}</span> {{$pedido[5]}}</p>
				<h3 class="resultados">{{trans('pages.IPR-Res')}}</h3>
			</div>
			<?php
				$var = str_replace(' :', ':', $pedido[6]);
			?>
			{!!$var!!}
			<hr class="hr">
		@endforeach
		
	</body>
</html>


