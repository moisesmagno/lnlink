<!doctype html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{$pageTitle}}</title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="{{asset('css/normalize.css')}}" type="text/css" media="all">
		<link rel="stylesheet" href="{{asset('css/geral.css')}}" type="text/css" media="all">

        <link rel="stylesheet" href="{{asset('css/smarthphones.css')}}" type="text/css" media="all and (max-width: 480px)">
        <link rel="stylesheet" href="{{asset('css/tablets.css')}}" type="text/css" media="all and (min-width:481px) and (max-width:960px)">
        <link rel="stylesheet" href="{{asset('css/desktops.css')}}" type="text/css" media="all and (min-width:961px)">
	</head>
	<body>
		<!-- Section que envolve o site todo -->
		<section class="env_tudo">

			<div class="row">

				<!-- Conteúdo principal -->
				<main class="conteudo">
				
					@yield('conteudo')								

					<!-- Logotipo cinza -->	
					<figure class="env_logo_cinza_2">
						<img src="{{asset('img/logotipo_cinza.png')}}">
					</figure>
					<!-- Fim do logotipo cinza -->
				</main><!-- Fim do Conteúdo principal -->

			</div><!-- Final da row -->
		
		</section><!-- Section que envolve o site todo-->

	</body>
</html>