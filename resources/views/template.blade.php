<!doctype html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{$pageTitle}}</title>
		
		<noscript>
		 	<meta http-equiv="Refresh" content="1; url={{trans('routes.noscipt')}}">
		</noscript>
		<!-- CSS -->

		<!--[if lt IE 9]>
			<meta http-equiv="Refresh" content="1; url={{url('/browsers')}}">
		<![endif]-->

		<link rel="stylesheet" href="{{asset('css/normalize.css')}}" type="text/css" media="all">
		<link rel="stylesheet" href="{{asset('css/geral.css')}}" type="text/css" media="all">

		<link rel="stylesheet" href="{{asset('lib/jquery_ui/jquery-ui.min.css')}}" type="text/css" media="all">
		<link rel="stylesheet" href="{{asset('lib/jquery_ui/jquery-ui.structure.min.css')}}" type="text/css" media="all">
		<link rel="stylesheet" href="{{asset('lib/jquery_ui/jquery-ui.theme.min.css')}}" type="text/css" media="all">		
        <link rel="stylesheet" href="{{asset('css/smarthphones.css')}}" type="text/css" media="all and (max-width: 480px)">
        <link rel="stylesheet" href="{{asset('css/tablets.css')}}" type="text/css" media="all and (min-width:481px) and (max-width:960px)">
        <link rel="stylesheet" href="{{asset('css/desktops.css')}}" type="text/css" media="all and (min-width:961px)">

		<link rel="stylesheet" href="{{asset('css/Avenir-Book.css')}}" type="text/css" media="all">        

	</head>
	<body>
		
		<?php 
			$url = $_SERVER ['REQUEST_URI'];
			$arrayUrl = explode('/', $url);
			
			if(in_array("consulta", $arrayUrl) AND in_array("ocorrencias", $arrayUrl)){
				$aux = 0;
			}elseif(in_array("consulta", $arrayUrl)){
				$aux = 1;
			}elseif(in_array("catalogo", $arrayUrl)){
				$aux = 1;	
			}elseif(in_array("alterar-senha", $arrayUrl)){
				$aux = 1;
			}else{
	 			$aux = 0;
			}
		?>

		<!-- Section que envolve o site todo -->
		<section class="env_tudo">
			
			<!-- Header geral desktop -->
			<header class="row env_header_geral" <?php echo ($aux == 1)? '':'style="display: block;"'; ?>>
				<div class="layout-12 linha_azul"></div>
				<div class="layout-12 linha_branca"></div>
				<div class="env_conteudo_header">
					<div class="conteudo_header">
						
						<!-- Links do header geral -->	
						<nav class="links_header_geral" id="links_header_geral">
							<a href="http://www.labconous.com/" target="_blank">{{trans('pages.H-PagIni')}}</a><span>|</span><a href="http://www.labconous.com/Espana/es/Laboratorio/Catalogo/" target="_blank">{{trans('pages.H-ExAlVa')}}</a><span>|</span><a href="http://www.labco.es/es/default.aspx" target="_blank">Labco</a>
						</nav><!-- Fim dos links do header geral -->	

						<figure class="logotipo_geral">
							<a href="{{url(trans('routes.consulta'))}}"><img src="{{asset('img/logotipo_geral.png')}}" alt="Labconous" title="{{trans('pages.H-LgPagIni')}}"></a>
						</figure>
						<nav class="conteudo_azul">
							<div class="layout-4 env_idiomas_geral">
								<img id="seta_links_header" class="seta_links_header" onclick="mostrarOcultaLinksHeader()" src="{{asset('img/icones/seta_baixo.png')}}" alt="" title="Links">
								<a href="{{url('/lang/fr')}}" class="ultimo_idioma "><div class="cc_idioma"><span>Fr</span></div></a>
								<a href="{{url('/lang/en')}}"><div class="cc_idioma"><span>En</span></div></a>
								<a href="{{url('/lang/es')}}"><div class="cc_idioma"><span>Es</span></div></a> 
								<a href="{{url('/lang/br')}}"><div class="cc_idioma"><span>Pt</span></div></a> 
							</div>

							<div class="layout-2 env_bandeja"> 
								@if(Session::get('bandeja') == '10000;1')
									<a href="{{url(trans('routes.bandeja'))}}">
										<div class="env_icone_valor">
											<span class="top_count_pet">{{Session::get('pcount')}}</span>
											<img src="{{asset('img/icones/bandeja.png')}}" title="{{trans('pages.TtH-BanPed')}}">
										</div>	
									</a>
								@endif
							</div>
							<div class="layout-2 env_lista"> 
								@if(Session::get('lista') == '9000;1')
									<a href="{{url(trans('routes.lista'))}}">
										<div class="env_icone_valor">
											<span class="top_count_list">{{Session::get('lcount')}}</span>
											<img src="{{asset('img/icones/lista.png')}}" title="{{trans('pages.TtH-LiEx')}}">
										</div>
									</a>
								@endif			
							</div>
							<div class="layout-4 env_opcoes_usuario"> 
								<div class="env_usuario_opcoes">
									<img src="{{asset('img/icones/seta_baixo.png')}}" alt="">
									<span>{{ Session::get('usuario') }}</span>
									<br><br>		
									<a href="{{url(trans('routes.alterarsenha'))}}">{{trans('pages.H-AltSen')}}</a>
									<br>									
									@if(Session::get('userlang') == 'br')	
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@elseif(Session::get('userlang') == 'es')
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@elseif(Session::get('userlang') == 'eslatam')
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@elseif(Session::get('userlang') == 'en')
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@elseif(Session::get('userlang') == 'fr')
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@else
										<a href="https://drive.google.com/file/d/0B1UQ8b-4p6fUcXI2SXZubHVENEk/view" target="_blank">{{trans('pages.H-Manual')}}</a>
									@endif
									<br>
									<a href="{{url('/logout')}}">{{trans('pages.H-Sair')}}</a>
								</div>
							</div>
						</nav>
						<nav class="conteudo_branco">
							
							<div class="env_menus_header_geral">
							@if(Session::get('consulta') == '1000;1' OR Session::get('incidencia') == '2000;1')
								<div class="env_consultas_header_geral">
									@if(Session::get('consulta') == '1000;1')
										<a href="{{url(trans('routes.consulta'))}}" class="link_consultas_header_geral"><span>{{trans('pages.H-Cons')}}</span></a>
									@endif
									@if(Session::get('incidencia') == '2000;1')
									<a href="{{url(trans('routes.consulta').'/'.trans('routes.incidencias'))}}" class="link_incidencias_header_geral">
										<span>{{trans('pages.H-Oco')}}</span>
									</a>
									@endif			
								</div>
							@endif	
							@if(Session::get('regManual') == '3000;1' OR Session::get('regIntegracao') == '4000;1' OR Session::get('regConsulta') == '5000;1')
								<div class="env_registros_header_geral">
										<a href="#" class="link_registros_header_geral"><span>{{trans('pages.H-Reg')}}</span></a>
									@if(Session::get('regManual') == '3000;1')		
										<a href="{{url(trans('routes.registro').'/'.trans('routes.manual'))}}" class="link_manual_header_geral">
											<span>{{trans('pages.H-RegMan')}}</span>
										</a>
									@endif
									@if(Session::get('regIntegracao') == '4000;1')									
										<a href="{{url(trans('routes.registro').'/'.trans('routes.integracao'))}}" class="link_integracao_header_geral">
											<span>{{trans('pages.H-RegInt')}}</span>
										</a>
									@endif
									@if(Session::get('regConsulta') == '5000;1')	
										<a href="{{url(trans('routes.registro').'/'.trans('routes.consultaEnviados'))}}" class="link_integracao_header_geral">
											<span>{{trans('pages.H-RegCons')}}</span>
										</a>
									@endif
								</div>
							@endif	
							@if(Session::get('catalogo') == '6000;1')	
								<div class="env_catalogo_header_geral">
									<a href="{{url(trans('routes.catalogo'))}}" class="link_catalogo_header_geral"><span>{{trans('pages.H-Cat')}}</span></a>
								</div>
							@endif
							@if(Session::get('logistica') == '7000;1')
								<div class="env_logistica_header_geral">
									<a href="{{url(trans('routes.logistica'))}}" class="link_logistica_header_geral"><span>{{trans('pages.H-Log')}}</span></a>
								</div>
							@endif
							@if(Session::get('gerenciamento') == '8000;1')
								<div class="env_relatorios_header_geral"><a href="{{url(trans('routes.gerenciamento'))}}" class="link_relatorios_header_geral" id="link_relatorios_header_geral"><span>{{trans('pages.H-Ger')}}</span></a></div>
							@endif
								<div class="env_atualidades_header_geral">
									<a href="http://blog.labconous.com/" target="_blank" class="link_atualidades_blog"><span>{{trans('pages.H-News')}}</span></a>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</header><!-- Fim do header geral desktop -->



			<!-- Header geral responsivo -->
			<header class="row env_header_responsivo" <?php echo ($aux == 1)? '' : 'style="display: none;"'; ?>>
				<div class="layout-12 conteudo_header_responsivo">
					<figure class="layout-6 logotipo_responsivo">
						<a href="{{url(trans('routes.consulta'))}}"><img src="{{asset('img/logotipo_responsivo.png')}}" alt="Labconous" title="{{trans('pages.H-LgPagIni')}}"></a>
					</figure>
					<div class="layout-2 opcoes_responsivo">
						<a href="#" id="icone_opcoes_responsivo"><img src="{{asset('img/icones/opcoes.png')}}" alt="Labconous"></a>
					</div>
					<div class="layout-2 usuario_responsivo">
						<a href="#" id="icone_usuario_responsivo"><img src="{{asset('img/icones/usuario.png')}}" alt="Labconous"></a>
					</div>
					<div class="layout-2 menu_responsivo">
						<a href="#" id="icone_menu_responsivo"><img src="{{asset('img/icones/menu.png')}}" alt="Labconous"></a>
					</div>
				</div>
				
				<nav class="layout-12  cont_menu_responsivo escondida_header_responsivo" id="cont_menu_responsivo">
					<a href="{{url(trans('routes.consulta'))}}"><span>{{trans('pages.H-Cons')}}</span></a>
					<a href="{{url(trans('routes.catalogo'))}}"><span>{{trans('pages.H-Cat')}}</span></a>
					<a href="http://blog.labconous.com/" target="_blank" class="ultimo_a_responsivo"><span>{{trans('pages.H-News')}}</span></a>
				</nav>
				<nav class="layout-12  cont_usuario_responsivo escondida_header_responsivo" id="cont_usuario_responsivo">
					<a href="{{url(trans('routes.alterarsenha'))}}"><span>{{trans('pages.H-AltSen')}}</span></a>
					<a href="#" class="ultimo_a_responsivo"><span>{{trans('pages.H-Sair')}}</span></a>
				</nav>
				<nav class="layout-12  cont_opcoes_responsivo escondida_header_responsivo" id="cont_opcoes_responsivo">
					<div class="layout-12  env_idimoas_responsivo">
						<div class="centraliza_idiomas_responsivo">
							<a href="#"><div class="cc_idioma_responsivo"><span>Fr</span></div></a>
							<a href="#"><div class="cc_idioma_responsivo"><span>En</span></div></a>
							<a href="#"><div class="cc_idioma_responsivo"><span>Es</span></div></a> 
							<a href="#"><div class="cc_idioma_responsivo"><span>Pt</span></div></a> 
						</div>
					</div>
					<div class="layout-12  env_links_responsivos">
						<a href="#"><span>{{trans('pages.H-LgPagIni')}}</span></a>
						<a href="#"><span>{{trans('pages.H-ExAlVa')}}</span></a>
						<a href="#" class="ultimo_a_responsivo"><span>Labco</span></a>
					</div>
				</nav>
			</header><!-- Fim do header geral responsivo -->
			
			<div class="row">
				
				@yield('filtro-lateral')

				<!-- Conteúdo principal -->
				<main class="conteudo">

					@yield('conteudo')								

					<!-- Logotipo cinza -->	
					<figure class="env_logo_cinza">
						<img src="{{asset('img/logotipo_cinza.png')}}">
					</figure><!-- Fim do logotipo cinza -->

				</main><!-- Fim do Conteúdo principal -->

			</div><!-- Final da row -->
			
			<!-- Rodape -->
			<div class="invisivel"></div>
			<footer class="env_rodape_geral">
				<p>{{trans('pages.G-CR1')}} <span>{{trans('pages.G-CR2')}}</span></p>
			</footer><!-- Fim do rodape -->
		
		</section><!-- Section que envolve o site todo-->

		@yield('modal')

		<section class="tela_ajax">
   			<img src="{{asset('img/icones/espera_gif.gif')}}">
  		</section>
		
		<!-- MODAL DE MENSAGENS -->
		<section class="telaoscura_mensagens">
			
			<!-- Modal mensagens -->
			<div class="modal_mensagens" id="">
				<div class="header_modal_mensagens">
					<h1 class="tt_modal">{{trans('pages.AM-Tt')}}</h1>
					<img src="{{asset('img/icones/x_branco.png')}}" class="fechar-modal-mensagens" title="Fechar janela!">
				</div>
				<div class="cont_modal_mensagens">
					@yield('alertas')
					<p class="msg_p_erro alerta_msg_erro_ajax"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-ErrAvTI')}}</p>
				</div>
			</div><!-- Fim do Modal mensagens -->	

		</section><!-- FIM DOS MODALS DE MENSAGENS -->

		<!-- JAVASCRIPT -->
		<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
		<script src="{{asset('lib/jquery_ui/jquery-ui.min.js')}}"></script>
		<script src="{{asset('js/jquery.autocomplete.js')}}"></script>		
		<script src="{{asset('js/scripts.js')}}"></script>		
		@yield('scripts')				
		<script src="{{asset('js/fontsmoothie.min.js')}}"></script>	
		<!-- FIM DO JAVASCRIPT -->
	</body>
</html>