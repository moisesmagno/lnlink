@extends('template')

@section('conteudo')

	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">


	<div class="env_botoes_abas_fixo">
		<div class="add_exame_lista_click"><img src="{{asset('img/icones/add_lista_azul.png')}}" title="{{trans('pages.TDE-AdiLisExa')}}" class="img_add_lista_detalhes_exame"><input type="hidden" class="cod_exame_catalogo_resultado" value="{{$exame[0]}}"></div>
		<div class="env_abas">
			<a href="{{url('/exame/laudo/'.$exame[0])}}" target="blank"><span>{{trans('pages.DE-MModLau')}}</span></a>
			<a href="{{url('/exame/ficha/'.$exame[0])}}" target="blank"><span>{{trans('pages.DE-MFicExa')}}</span></a>	
			@if(!empty(trim($exame[24])))
			<a href="" class="vl_referencia_exame"><span>{{trans('pages.DE-MValRef')}}</span></a>
			@endif
			@if(!empty(trim($exame[25])))
			<?php $quest = explode('|', $exame[25]); ?>						
			<a href="{{url('/exame/doc/'.$exame[0].'/'.$quest[0].'/'.$quest[2])}}" target="blank"><span>{{trans('pages.DE-MConQue')}}</span></a>
			@endif
			
		</div>
	</div>
	
	<div class="empurra_detalhes_exames_responsivo"></div>

	<section class="envo_conteudo_detalhes_exame">
		
		<!-- Menu responsivo -->
		<div class="env_icone_abas_responsivo">
			<div class="img_menu_exames">
				<img src="{{asset('img/icones/menu_azul.png')}}" class="img_menu_responsivo">	
			</div>
			<div class="env_abas_responsivo">
				<a href="{{url('/exame/laudo/'.$exame[0])}}" target="blank">{{trans('pages.DE-MModLau')}}</a>
				<a href="{{url('/exame/ficha/'.$exame[0])}}" target="blank">{{trans('pages.DE-MFicExa')}}</a>
				@if(!empty(trim($exame[24])))
					<a href="" class="vl_referencia_exame">{{trans('pages.DE-MValRef')}}</a>
				@endif
				@if(!empty(trim($exame[25])))
					<a href="{{url('/exame/doc/'.$exame[0].'/'.$quest[0].'/'.$quest[2])}}" target="blank">{{trans('pages.DE-MConQue')}}</a>
				@endif	
			</div>
		</div><!-- Fim do Menu responsivo -->


		<h4 class="tt_codigo_exame">{{trans('pages.DE-CodExa')}} {{$exame[0]}}</h4>
		<h1 class="tt_nome_exame">{{utf8_encode($exame[1])}}</h1>
		@if(!empty(trim($exame[2])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-Sino')}} </span>
			{{utf8_encode($exame[2])}}
		</p>
		@endif

		@if(!empty(trim($exame[3])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-Amos')}} </span>
			{{utf8_encode($exame[3])}}
		</p>
		@endif		

		@if(!empty(trim($exame[4])) or !empty(trim($exame[5])))
		<p class="linha_detalhes_exames">
			@if(!empty(trim($exame[4])))
				<span>{{trans('pages.DE-Volu')}} </span>
				{{utf8_encode($exame[4])}}
			@endif
				@if(!empty(trim($exame[4])) AND !empty(trim($exame[5])))
					<span class="tc">-</span>
				@endif
			@if(!empty(trim($exame[5])))
				<span class="pl"></span> 
				<span>{{trans('pages.DE-VolMin')}} </span>
				{{utf8_encode($exame[5])}}
			@endif
		</p>
		@endif		

		@if(!empty(trim($exame[6])) or !empty(trim($exame[7])))
		<p class="linha_detalhes_exames">
			@if(!empty(trim($exame[6])))
				<span>{{trans('pages.DE-PraEstLoc')}} </span>
				{{utf8_encode($exame[6])}}
			@endif
			@if(!empty(trim($exame[6])) AND !empty(trim($exame[7])))
				<span class="tc">-</span>
			@endif
			@if(!empty(trim($exame[7])))
				<span class="pl"></span> 
				<span>{{trans('pages.DE-PraMedEnt')}}</span>
				{{utf8_encode($exame[7])}}
			@endif
		</p>
		@endif 

		@if(!empty(trim($exame[8])) or !empty(trim($exame[9])))
		<p class="linha_detalhes_exames">
			@if(!empty(trim($exame[8])))
				<span>{{trans('pages.DE-Cons')}} </span>			
				{{utf8_encode($exame[8])}}
			@endif
			@if(!empty(trim($exame[8])) AND !empty(trim($exame[9])))
				<span class="tc">-</span>
			@endif
			@if(!empty(trim($exame[9])))
				<span class="pl"></span> 
				<span>{{trans('pages.DE-EstAmos')}} </span>			
				{{utf8_encode($exame[9])}}
			@endif
		</p>
		@endif

		@if(!empty(trim($exame[10])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-Tecn')}} </span>
			{{utf8_encode($exame[10])}} 
		</p>
		@endif

		@if(!empty(trim($exame[11])) or !empty(trim($exame[12])))
		<p class="linha_detalhes_exames">
			@if(!empty(trim($exame[11])))
				<span>{{trans('pages.DE-PraEnt')}} </span>			
				{{utf8_encode($exame[11])}}
			@endif
			@if(!empty(trim($exame[11])) AND !empty(trim($exame[12])))
				<span class="tc">-</span>
			@endif
			@if(!empty(trim($exame[12])))
				<span class="pl"></span> 
				<span>{{trans('pages.DE-Proc')}} </span>		
				{{utf8_encode($exame[12])}}
			@endif
		</p>
		@endif	

		@if(!empty(trim($exame[13])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-Jejum')}} </span>
			{{utf8_encode($exame[13])}} 
		</p>
		@endif	

		@if(!empty(trim($exame[14])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-CriRej')}} </span>
			{{utf8_encode($exame[14])}} 
		</p>
		@endif	
		
		@if(!empty(trim($exame[15])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-InsCole')}} </span>
			{{utf8_encode($exame[15])}} 
		</p>
		@endif	

		@if(!empty(trim($exame[16])))
		<p class="linha_detalhes_exames">
			<span>{{trans('pages.DE-IndCli')}} </span>
			{{utf8_encode($exame[16])}} 
		</p>
		@endif

		<!-- Amostras alteranativas -->
		<div class="env_tabela_amostras_alternativas">
			<hr class="linha_separadora_exame_um">
			<div class="env_tabela_exames_alternativas">
				<div class="tabela_amostras_alternativas">
					<!-- Titulos -->
					<div class="linhas_tt_amostra_alternativa">
						<span class="tt_amostra_alternativa">Amostra alternativa</span>
						<span class="tt_amostra_alternativa_volume">Volume</span>
						<span class="tt_amostra_alternativa_conservacao">Conservação</span>
						<span class="tt_amostra_alternativa_refrigerado">Estabilidade refrigerada</span>
						<span class="tt_amostra_alternativa_congelado">Estabilidade congelada</span>
					</div><!-- Fim dos Titulos -->

					<!-- Linha de amostra alternativa -->
					<div class="linha_amostrar_alterantivas">
						<span class="span_amostra_alterantiva">Soro</span>
						<span class="span_amostra_alternativa_volume">2.0 mL</span>
						<span class="span_amostra_alternativa_conservacao">Congelado -20ºC</span>
						<span class="span_amostra_alternativa_refrigerado">24 Horas</span>
						<span class="span_amostra_alternativa_congelado">30 Dias</span>
					</div><!-- Fim da Linha de amostra alternativa -->
					<!-- Linha de amostra alternativa -->	
					<div class="linha_amostrar_alterantivas">
						<span class="span_amostra_alterantiva">Líquido cefalorraquidiano - LCR</span>
						<span class="span_amostra_alternativa_volume">2.0 mL</span>
						<span class="span_amostra_alternativa_conservacao">Congelado -20ºC</span>
						<span class="span_amostra_alternativa_refrigerado">24 Horas</span>
						<span class="span_amostra_alternativa_congelado">30 Dias</span>
					</div><!-- Fim da Linha de amostra alternativa -->
					<!-- Linha de amostra alternativa -->
					<div class="linha_amostrar_alterantivas">
						<span class="span_amostra_alterantiva">Líquido articular</span>
						<span class="span_amostra_alternativa_volume">2.0 mL</span>
						<span class="span_amostra_alternativa_conservacao">Congelado -20ºC</span>
						<span class="span_amostra_alternativa_refrigerado">24 Horas</span>
						<span class="span_amostra_alternativa_congelado">30 Dias</span>
					</div><!-- Fim da Linha de amostra alternativa -->
				</div>

				<!-- Instruções de coleta -->
				<div class="env_instrucoes_coleta">
					<h1>Instruções de coleta</h1>
					<p>
						<span>SORO: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
					<p>
						<span>LCR: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
					<p>
						<span>LÍQUIDO ARTICULAR: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
				</div><!-- Fim das instruções de coleta -->
			</div>
		</div>
		<!-- Fim das amostras alteranativas -->

		<!-- Amostras alternativas responsivo -->
		<div class="env_botao_amostrar_alternativas">
			<div class="bt_azul botao_amostra_alternativa">
				<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_amostrar_alternativa"> <span>Amostrar alternativas</span>
			</div>
		</div>
		<div id="env_todos_env_responsivos">
			<div class="env_amostras_alternativas_responsivo">
				<div class="amostra_alternativa_responsivo">
					<p>
						<span>Amostra alternativa: </span>
						Soro
					</p>
					<p>
						<span>Volume: </span>
						2.0 mL 
						<span class="tc">-</span> 
						<span class="pl"></span>  
						<span>Conservação: </span>
						Congelado -20ºC
					</p>
					<p>
						<span>Estabilidade refrigerada: </span>
						24 Horas 
						<span class="tc">-</span> 
						<span class="pl"></span> 
						<span>Estabilidade congelada: </span>
						30 Dias
					</p>
					<p>
						<span>Instruções de coleta: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
				</div>
				<div class="amostra_alternativa_responsivo">
					<p>
						<span>Amostra alternativa: </span>
						Soro
					</p>
					<p>
						<span>Volume: </span>
						2.0 mL 
						<span class="tc">-</span> 
						<span class="pl"></span>  
						<span>Conservação: </span>
						Congelado -20ºC
					</p>
					<p>
						<span>Estabilidade refrigerada: </span>
						24 Horas 
						<span class="tc">-</span> 
						<span class="pl"></span> 
						<span>Estabilidade congelada: </span>
						30 Dias
					</p>
					<p>
						<span>Instruções de coleta: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
				</div>
				<div class="amostra_alternativa_responsivo">
					<p>
						<span>Amostra alternativa: </span>
						Soro
					</p>
					<p>
						<span>Volume: </span>
						2.0 mL 
						<span class="tc">-</span> 
						<span class="pl"></span>  
						<span>Conservação: </span>
						Congelado -20ºC
					</p>
					<p>
						<span>Estabilidade refrigerada: </span>
						24 Horas 
						<span class="tc">-</span> 
						<span class="pl"></span> 
						<span>Estabilidade congelada: </span>
						30 Dias
					</p>
					<p>
						<span>Instruções de coleta: </span>
						Coletar 5,0 mL de sangue total em tubo sem anticoagulante, centrifugar, aliquotar 2,0 mL de soro em tubo de transporte e congelar. 
					</p>
				</div>
			</div>
		</div>
		<!-- Fim das amostras alternativas responsivo -->

		<!-- Detalhes de Genes Estático-->
		<div class="env_detalhes_genes">
			<hr class="linha_separadora_exame_dois">

			@if(!empty(trim($exame[17])) or !empty(trim($exame[18])) or !empty(trim($exame[19])) or!empty(trim($exame[20])) or !empty(trim($exame[21])) or!empty(trim($exame[22])))
				<!-- Tabela -->
				<div class="env_tt_linhas">
					<div class="env_tt_detalhes_genes">
						<span class="tt_detalhes_genes">{{trans('pages.DE-TGene')}}Gene</span>
						<span class="tt_detalhes_locus">{{trans('pages.DE-TLocus')}}Locus</span>
						<span class="tt_detalhes_omm_gene">{{trans('pages.DE-TOMIGene')}}OMIM Gene</span>
						<span class="tt_detalhes_omm_fenotipos">{{trans('pages.DE-TOMIMFen')}}OMIM Fenótipo</span>
						<span class="tt_detalhes_heranca">{{trans('pages.DE-THer')}}Herança</span>
						<span class="tt_detalhes_icidencias">{{trans('pages.DE-TInc')}}Incidências</span>
					</div>

					<div class="linha_detalhes_genes">
						<span class="span_detalhes_genes">
						@if(!empty(trim($exame[17])))
							{{utf8_encode($exame[17])}}
						@else
						 --
						@endif
						</span>
						<span class="span_detalhes_locus">
						@if(!empty(trim($exame[18])))
							{{utf8_encode($exame[18])}}
						@else
						 --
						@endif
						</span>
						<span class="span_detalhes_OMM_gene">
						@if(!empty(trim($exame[19])))
							{{utf8_encode($exame[19])}}
						@else
						 --
						@endif
						</span>
						<span class="span_detalhes_OMM_Fenotipo">
						@if(!empty(trim($exame[20])))
							{{utf8_encode($exame[20])}}
						@else
						 --
						@endif
						</span>
						<span class="span_detalhes_heranca">
						@if(!empty(trim($exame[21])))
							{{utf8_encode($exame[21])}}
						@else
						 --
						@endif
						</span>
						<span class="span_detalhes_incidencias">
						@if(!empty(trim($exame[22])))
							{{utf8_encode($exame[22])}}
						@else
						 	--
						@endif
						</span>
					</div>
				</div>
				<!-- Fim da tabela -->
			@endif

			@if(!empty($exame[23]))
				<!-- LINKS	 -->
				<div class="links_vinculados_detalhes_genes">
					<h1>LINKS:</h1>
					@foreach($exame['links'] as $link)

						<?php $auxlink = explode('|', $link) ?>	

						@if(stripos($auxlink[2],'http') === false)		
						
							<p><a href="{{url('/exame/doc/'.$exame[0].'/'.utf8_encode($auxlink[0]).'/'.utf8_encode($auxlink[2]))}}" target="blank"><span> <p class="tt_link_arquivo_ex">{{utf8_encode($auxlink[1])}}</p> <img src="{{ asset('img/icones/pdf.png') }}" class="img_arquivo_exame_links" title="{{trans('pages.TDE-VisPDF')}}"></span><br></p></a>
						@else
							
							<p><a href="{{utf8_encode($auxlink[2])}}" target="blank"><span>{{utf8_encode($auxlink[1])}}</span></a><br>
							<?php 
								if (strlen($auxlink[2]) > 80) {
									$url = substr($auxlink[2], 0,80).'...';
								}else{
									$url = $auxlink[2];
								}
							?>
							
							{{utf8_encode($url)}}</p>	

						@endif

					@endforeach
				</div>
				<!-- fIM DOS LINKS	 -->
			@endif

		</div><!-- Fim do detalhes de Genes Estático-->
		


		@if(!empty(trim($exame[17])) or !empty(trim($exame[18])) or !empty(trim($exame[19])) or!empty(trim($exame[20])) or !empty(trim($exame[21])) or!empty(trim($exame[22])))

			<!-- Detalhes de genes Responsivo-->
			<div class="env_botao_detalhes_genes">
				<div class="bt_azul botao_detalhes_genes">
					<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_detalhes_genes"> <span>{{trans('pages.DE-TtDetGen')}}</span>
				</div>
			</div>
			<div id="env_todos_env_responsivos">
				<div class="env_detalhes_genes_responsivo">
					
					<!-- Tabela -->
					<div class="detalhes_genes_responsivo">
						<p>
							<span>{{trans('pages.DE-TGene')}} </span>
							@if(!empty(trim($exame[17])))
								{{utf8_encode($exame[17])}}
							@else
							 	--
							@endif
							<span class="tc">-</span> 
							<span class="pl"></span> 
							<span>{{trans('pages.DE-TLocus')}} </span>
							@if(!empty(trim($exame[18])))
								{{utf8_encode($exame[18])}}
							@else
							 	--
							@endif
						</p>
						<p>
							<span>{{trans('pages.DE-TOMIGene')}} </span>
							@if(!empty(trim($exame[19])))
								{{utf8_encode($exame[19])}}
							@else
							 	--
							@endif
							<span class="tc">-</span> 
							<span class="pl"></span>  
							<span>{{trans('pages.DE-TOMIMFen')}} </span>
							@if(!empty(trim($exame[20])))
								{{utf8_encode($exame[20])}}
							@else
							 	--
							@endif
						</p>
						<p>
							<span>{{trans('pages.DE-THer')}} </span>
							@if(!empty(trim($exame[21])))
								{{utf8_encode($exame[21])}}
							@else
							 	--
							@endif
							<span class="tc">-</span> 
							<span class="pl"></span> 
							<span>{{trans('pages.DE-TInc')}} </span>
							@if(!empty(trim($exame[22])))
								{{utf8_encode($exame[22])}}
							@else
							 	--
							@endif
						</p>
						
						<!-- <hr class="riscos_destalhes_genetica_responsivo"> -->
					</div>
				</div>
			</div>
			<!-- Fim dos Detalhes de genes responsivo-->
		@endif


		@if(!empty($exame[23]))
			<!-- LInks de exames Responsivo-->
			<div class="env_botao_detalhes_links">
				<div class="bt_azul botao_detalhes_links">
					<img src="{{asset('img/icones/seta_baixo.png')}}" class="img_seta_detalhes_links"> <span>{{trans('pages.DE-Link')}}</span>
				</div>
			</div>
			<div id="env_todos_env_responsivos">
				<div class="env_links_exames_responsivo">
					<!-- <hr class="riscos_destalhes_genetica_responsivo"> -->

					<div class="links_vinculados_exame_responsivo">
						@foreach($exame['links'] as $link)

							<?php $auxlink = explode('|', $link) ?>	

							@if(stripos($auxlink[2],'http') === false)
								
								<p>
									<a href="{{url('/exame/doc/'.$exame[0].'/'.utf8_encode($auxlink[0]).'/'.utf8_encode($auxlink[2]))}}" target="blank">
										<span> 
											<span class="tt_arquivo_links_res">{{utf8_encode($auxlink[1])}}</span> 
											<img src="{{ asset('img/icones/pdf.png') }}" class="img_liks_ex_res" title="{{trans('pages.TDE-VisPDF')}}">
										</span>
									</a>
								</p>

							@else

								<p><a href="{{utf8_encode($auxlink[2])}}" target="blank"><span>{{utf8_encode($auxlink[1])}}</span></a><br>
								<?php 
									if (strlen($auxlink[2]) > 80) {
										$url = substr($auxlink[2], 0,80).'...';
									}else{
										$url = $auxlink[2];
									}
								?>

								{{utf8_encode($url)}}</p>
										
							@endif

						@endforeach
						
					</div>
				</div>
			</div>	
			<!-- Fim dos LInks de exames responsivo-->
		@endif
	</section>



@stop

@section('alertas')	
	<p class="msg_p_alerta alerta_msg_ja_adicionado"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMDE-ExJaAddLis')}}</p>
	<p class="msg_p_erro alerta_msg_falha"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.AMDE-NaoPosAddExa')}}</p>
	<p class="msg_p_sucesso alerta_msg_adicionado"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.AMDE-ExaAddLis')}}</p>
@stop

@section('scripts')	
	<script type="text/javascript" src="{{asset('js/exam.js')}}"></script>
@stop


<section class="telaoscura_vl_referencia">	
	<!-- Modal valores de referência -->
	<div class="modal_vl_referencia modal-janela-vl-referencia" id="">
		<div class="header_modal_vl_referencia">
			<h1 class="tt_modal">{{trans('pages.DE-MValRef')}}</h1>
			<img src="{{ asset('img/icones/x_branco.png') }}" class="fechar-modal" title="{{trans('pages.AMDE-FecJan')}}">
		</div>
		<div class="cont_vl_referencia">
			<p> {{utf8_encode($exame[24])}} </p>
		</div>
	</div><!-- Fim do Modal valores de referência -->	
</section>

				
