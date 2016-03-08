<!doctype html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		
		<noscript>
		 	<meta http-equiv="Refresh" content="1; url={{trans('routes.noscipt')}}">
		</noscript>
		<!-- CSS -->

		<!--[if lt IE 9]>
			<meta http-equiv="Refresh" content="1; url={{url('/browsers')}}">
		<![endif]-->

		<link rel="stylesheet" href="{{asset('css/normalize.css')}}" type="text/css" media="all">
		<link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset('css/smarthphones.css')}}" type="text/css" media="all and (max-width: 480px)">
        <link rel="stylesheet" href="{{asset('css/tablets.css')}}" type="text/css" media="all and (min-width:481px) and (max-width:960px)">
        <link rel="stylesheet" href="{{asset('css/desktops.css')}}" type="text/css" media="all and (min-width:961px)">

        <link rel="stylesheet" href="{{asset('css/Avenir-Book.css')}}" type="text/css" media="all">   
	</head>
	<body>
		
		<!-- SECTION QUE ENVOLVE TODO O SITE-->
		<section class="env_tudo">

			<!-- LOGOTIPO, IDIOMAS E LINKS -->
			<header class="row">
				<figure class="layout-8 logotipo">
					<img src="{{asset('img/logotipo.png')}}">
				</figure>
				<div class="layout-4 idiomas_links">
					<div class="idiomas_login">
						<div class="env_idiomas">
							<a href="{{url('/lang/br')}}"><div  class="cc_idioma_login pt" id="pt"><span>Pt</span></div></a>
							<a href="{{url('/lang/es')}}"><div  class="cc_idioma_login es" id="es"><span>Es</span></div></a>
							<a href="{{url('/lang/en')}}"><div  class="cc_idioma_login en" id="en"><span>En</span></div></a>
							<a href="{{url('/lang/fr')}}"><div  class="cc_idioma_login fr" id="fr"><span>Fr</span></div></a>
						</div>
					</div>
					<div class="links_login">
						<div class="env_link">
							<a href="http://www.labconous.com/" target="_blank">{{trans('pages.PL-PagIni')}}</a><span>|</span><a href="http://www.labconous.com/Espana/es/Laboratorio/Catalogo/" target="_blank">{{trans('pages.PL-ExAlVa')}}</a><span>|</span><a href="http://www.labco.es/es/default.aspx" target="_blank">Labco</a>
						</div>
					</div>
				</div>
			</header><!-- FIMO DO LOGOTIPO, IDIOMAS E LINKS -->

			
			<div class="row">
				<!-- CONTEÚDO PRINCIPAL -->
				<section class="conteudo_responsivo">
					<div class="row">
						<div class="layout-12">	
							<div class="env_form_apresentacao_login">
								<p>
									{{trans('pages.PL-MsgBemVin1')}} <span><br> {{trans('pages.PL-MsgBemVin2')}}</span>
								</p>
								<div class="env_form_login">
									<form action="{{url('login')}}" method="POST" name="form_login" class="form_login">
									    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
										<h1>{{trans('pages.PL-TtForm')}}</h1>
										<input type="email" placeholder="{{trans('pages.PL-PlaHolEmail')}}" name="email" >
											@if($errors->has('email'))
												<span>{{$errors->first('email')}}</span>
											@endif
										<input type="password" placeholder="{{trans('pages.PL-PlaHolSenha')}}" name="password" >
											@if($errors->has('password'))
												<span>{{$errors->first('password')}}</span>
											@endif
											@if(Session::has('loginerror'))
												<span id="dd_incorretos_login">{{trans('pages.PL-DdsInc')}}</span>
											@endif
										<a href="#">{{trans('pages.PL-AvLegal')}}</a>
										<input type="submit" value="{{trans('pages.PL-BtnEntrar')}}">
									</form>
								</div>				
							</div>		
						</div>
					</div>	
				
				</section><!-- CONTEÚDO PRINCIPAL -->
			</div>
			
			<div class="invisivel"></div>
			<footer class="env_rodape_login">
				<p>{{trans('pages.PL-CR1')}} <span>{{trans('pages.PL-CR2')}}</span></p>
			</footer>
		
		</section><!-- FIM DA SECTION QUE ENVOLVE TODO O SITE-->
		
		<!-- JAVASCRIPT -->
		<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
		<script src="{{asset('js/fontsmoothie.min.js')}}"></script>	
	</body>
</html>