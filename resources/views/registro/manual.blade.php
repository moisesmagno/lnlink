@extends('template')


@section('conteudo')
	
	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
	<section class="tt_principal_pg_fixo">
		<img src="{{asset('img/icones/bandeja.png')}}" style="padding-top: 14px; padding-bottom: 11px !important;"><h1>{{trans('pages.RM-TtRegMan')}}</h1>
	</section>

	<!-- Tudo que envolve o registro manual -->
	<section class="env_tudo_registro_manual">

		<!-- Envolve todo o conteúdo dos dados do paciente -->
		<section class="env_tudo_dados_paciente">
			<div class="tt_cx_conteudo_fixo">
				<span>{{trans('pages.RM-DdPac')}}</span>
			</div>
			<div class="cx_conteudo_fixo">
				<form action="" name="form_dados_paciente_registro" class="form_dados_paciente_registro">
					<label for="" class="lb_nome"> <span class="span_dd_Pacientes">{{trans('pages.RM-DdNomPac')}}</span> <span id="camp_import">*</span><input type="text" name="nome" autofocus></label>
					<label for="" class="lb_sobrenome"> <span class="span_dd_Pacientes">{{trans('pages.RM-DdSobCom')}}</span><span id="camp_import">*</span> <input type="text" name="sobrenome"></label>
					<label for="" class="lb_dt_nascimento"> <span class="span_dd_Pacientes">{{trans('pages.RM-DdDtNasc')}}</span><span id="camp_import">*</span> <input type="text" name="dataNascimento" placeholder="dd/mm/aaaa"></label>
					<label for="" class="lb_sexo"> <span class="span_dd_Pacientes">{{trans('pages.RM-DdSexo')}}</span><span id="camp_import">*</span>
						<select name="sexo" id="">
							<option value="0">{{trans('pages.RM-DdSelSel')}}</option>
							<option value="1">{{trans('pages.RM-DdSelHom')}}</option>
							<option value="2">{{trans('pages.RM-DdSelMul')}}</option>
							<option value="3">{{trans('pages.RM-DdSelPed')}}</option>
						</select>
					</label>
					<label for="" class="lb_referencia_interna"> <span class="span_dd_Pacientes">{{trans('pages.RM-DdRefInt')}}</span><span id="camp_import">*</span> <input type="text" name="referenciaInterna"></label>
					<label for="" class="lb_numero_etiquetas"> <span>{{trans('pages.RM-DdNumEti')}}</span> <input type="text" name="numeroEtiquetas"></label>
					<label for="" class="lb_nhc"> <span>{{trans('pages.RM-DdNHC')}}</span> <input type="text" name="nhc"></label>
					<label for="" class="lb_medico_solicitante"> <span>{{trans('pages.RM-DdMedSol')}}</span> <input type="text" name="medicoSolicitante"></label>
					<label for="" class="lb_local"> <span>{{trans('pages.RM-DdLocal')}}</span> <input type="text" name="local"></label>
				</form>
			</div>
		</section><!-- Fim do envolve todo o conteúdo dos dados do paciente -->

		<!-- Envolve todo o conteúdo da adição de exames -->
		<section class="env_tudo_add_exames">
			

			<!-- Div lista de exames flutuante -->	
			<nav class="env_cont_lista_exames cont_box_registro">
				<figure><img src="{{asset('img/icones/seta_baixo_azul.png')}}"></figure>
				<div class="lista_exame">
					@include('registro.manual-exames')
				</div>	
			</nav><!-- Fim da Div lista de exames flutuante -->	
			
			<!-- Div grupo de solicitações flutuante -->	
			<nav class="env_cont_grupo_solicitacoes cont_box_registro">
				<figure><img src="{{asset('img/icones/seta_baixo_azul.png')}}"></figure>
				<div class="grupo_solicitacoes">
					@include('registro.manual-grupos')
				</div>	
			</nav><!-- Fim da Div grupo de solicitações flutuante -->	

			<div class="tt_cx_conteudo_fixo">
				<span>{{trans('pages.RM-TtAdEx')}}</span>
			</div>
			<div class="cx_conteudo_fixo">
				<div class="env_busca_dropdown">
					<div class="env_busca">
						<span>{{trans('pages.RM-AEProExCliSel')}}</span>
						<figure class="icone_lupa_busca_exame">	
							<img src="{{asset('img/icones/lupa_branco.png')}}">
						</figure>
						<form action="" class="form_autocomplete_lock"><input type="text" id="input_autocomplete_registro_manual"></form>
					</div>
					<div class="env_grupo_solicitacoes">
						<span>{{trans('pages.RM-AEGruSol')}}</span>
						<figure class="icone_grupo_solicitacoes" >	
								<img src="{{asset('img/icones/grupo_solicitacoes.png')}}">
						</figure>
						<div class="box_grupo_solicitacoes">
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}" class="seta_baixo_grupo_solicitacoes">
						</div>	
					</div>
					<div class="env_lista_exames">
						<span>{{trans('pages.RM-AELisEx')}}</span>
						<figure class="icone_lista_exames">	
								<img src="{{asset('img/icones/lista_exames.png')}}">
						</figure>
						<div class="box_lista_exames">
							<img src="{{asset('img/icones/seta_baixo_azul.png')}}"class="seta_baixao_lista_exames">
						</div>	
					</div>
				</div>

				<div id="modelos_exames" style="display:none">
					<!-- Temperatura Ambiente -->
					<div class="modelo_exame_ta">
						<span style="display:none" class="uniq_cod_exam"></span>
						<div class="exame_add_ta_registro">
							<span class="tc_exames_add_ta_registro">{{trans('pages.TG-SigLegTA')}}</span>
							<p><span class="span_exame_val"></span><span class="span_amostra_exame_val"></span></p>
						</div>
						<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
					</div><!-- Fim - Temperatura Ambiente -->
					
					<!-- Resfriado -->
					<div class="modelo_exame_r">
						<span style="display:none" class="uniq_cod_exam"></span>
						<div class="exame_add_r_registro">
							<span class="tc_exames_add_r_registro">{{trans('pages.TG-SigLegR')}}</span>
							<p><span class="span_exame_val"></span><span class="span_amostra_exame_val"></span></p>
						</div>
						<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
					</div><!-- Fim - Resfriado -->
					
					<!-- Congelado -->
					<div class="modelo_exame_c">
						<span style="display:none" class="uniq_cod_exam"></span>
						<div class="exame_add_c_registro">
							<span class="tc_exames_add_c_registro">{{trans('pages.TG-SigLegC')}}</span>
						<p><span class="span_exame_val"></span><span class="span_amostra_exame_val"></span></p>

						</div>
						<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
					</div><!-- Fim  - Congelado -->

					
					<!-- Verificar Pendências -->
					<div class="modelo_exame_vp">
						<span style="display:none" class="uniq_cod_exam isvp"></span>
						<div class="exame_add_vp_registro">
							<span class="tc_exames_add_vp_registro">{{trans('pages.TG-SigLegVP')}}</span>
							<p><span class="span_exame_val"></span><span class="span_amostra_exame_val"></span></p>
						</div>
						<img src="{{asset('img/icones/x.png')}}" title="{{trans('pages.TtRM-ExcExa')}}" class="x_apaga_exame_selecionado">
						
						<!-- Dependência do exame -->
						<div class="env_cont_dependencias env_cont_dependencias_vp">
							<div class="cont_dependencias">
								
								<div class="cria_espaco_dependencia_exame"></div>

								<form class="form_dependencias_exame"></form>

							</div>
							<img src="{{asset('img/icones/flecha_cima_dependencias.png')}}" alt="Esconder dependências" class="flecha_esconder_dependencias">
						</div><!-- Fim da dependência do exame -->

						<!-- Bolinha -->
						<div class="abre_dependenecias_registro menu_bolinhas_vp">
							<div class="bolinha1"></div>
							<div class="bolinha2"></div>
							<div class="bolinha3"></div>
						</div><!-- Dim das Bolinhas -->
					</div><!-- Fim de verificar Pendências -->
				</div>

				<div class="env_exames_selecionados">
					<h3>{{trans('pages.RM-AEExVinPac')}}</h3>
					<div class="exames_selecionados">

						@include('registro.manual-exames-gerar-pedido')

					</div>
				</div>

				<div class="env_legendas_criarGrupo_btns">
					<div class="env_legendas">
						
						<!-- legendas -->
						<div class="conluna1">
							<div class="env_vp vp_exames_selecionados">
								<span class="ic_vp">{{trans('pages.TG-SigLegVP')}}</span><span class="legenda">{{trans('pages.TG-LegVerPen')}}</span>
							</div>
							<div class="env_c c_exames_selecionados">
								<span class="ic_c">{{trans('pages.TG-SigLegC')}}</span><span class="legenda">{{trans('pages.TG-LegCon')}}</span>
							</div>
						</div>
						<div class="conluna2 ">
							<div class="env_r r_exames_selecionados">
								<span class="ic_r">{{trans('pages.TG-SigLegR')}}</span><span class="legenda">{{trans('pages.TG-LegRef')}}</span>
							</div>
							<div class="env_ta ta_exames_selecionados">
								<span class="ic_ta">{{trans('pages.TG-SigLegTA')}}</span><span class="legenda">{{trans('pages.TG-LegTemAmb')}}</span>
							</div>
						</div><!-- Fim das legendas -->

					</div>
					<div class="separador_env_legendas_criarGrupo_btns"></div>
					<div class="env_criar_grupo_solicitacoes">
						<form action="" class="form_criar_grupo_solicitacoes">
							<span>{{trans('pages.RM-AECrGruSol')}}</span>
							<input type="text" name="nomeGrupo">
							<input type="submit" value="Criar">
						</form>
						<div class="resposta_criar_grupo">						
						
				           <!-- MENSAGENS DE NOTIFICAÇÃO DO FORMULÁRIO QUE CRIAR OS GRUPOS DE EXAMES -->
				           <span class="grupo_criado_sucesso" style="display:none">{{trans('pages.MRM-GGruCriSuc')}}</span>
				           <span class="grupo_criado_falha grupo_criado_falha_existe" style="display:none">{{trans('pages.MRM-GNomGruDigExi')}}</span>
				           <span class="grupo_criado_falha grupo_criado_falha_erro" style="display:none">{{trans('pages.MRM-GOcoFalCriGru')}}</span>
				           <span class="grupo_criado_falha grupo_criado_falha_vazio" style="display:none">{{trans('pages.MRM-GEscNoGru')}}</span> 
				           <span class="grupo_criado_falha grupo_criado_falha_exames" style="display:none">{{trans('pages.MRM-GEscExAddGru')}}</span>  
				           <!-- FIM DAS MENSAGENS DE NOTIFICAÇÃO DO FORMULÁRIO QUE CRIAR OS GRUPOS DE EXAMES -->
          
					</div>
					</div>
					<div class="separador_env_legendas_criarGrupo_btns">
					</div>
					<div class="env_botoes_add_paciente_limpar_tudo_registro_manual">
						<div class="div_form_registro_modo_insert" >						
						<a href="#" class="bt_azul btn_add_paciente_registro_manual" id="btn_add_paciente_registro_manual">{{trans('pages.RM-AEBtnAddPac')}}</a>
						<a href="#" class="bt_vermelho btn_limpar_campos_paciente_registro_manual" id="btn_limpar_campos_paciente_registro_manual">{{trans('pages.RM-AEBtnLimCam')}}</a>
						</div>
						<div class="div_form_registro_modo_edit" style="display:none">						
						<a href="#" class="bt_azul btn_add_paciente_registro_manual" id="btn_add_paciente_registro_manual">{{trans('pages.RM-AEBtnSalAlt')}}</a>
						<a href="#" class="bt_vermelho btn_limpar_campos_paciente_registro_manual" id="btn_limpar_campos_paciente_registro_manual">{{trans('pages.RM-AEBtnCanAlt')}}</a>
						</div>
					</div>
				</div>
		  
			</div>
		</section><!-- Fim do envolve todo o conteúdo da adição de exames -->


		<!-- Div que envolve tudo dos pacientes adcionados -->
		<section class="env_tudo_pacientes_adicionados">
			<div class="env_bandeja_aviso">
				<figure>
					<a href="{{url(trans('routes.bandeja'))}}">
						<img src="{{asset('img/icones/bandeja_azul.png')}}" Title="{{trans('pages.TtRM-BanPed')}}">
					</a>
					<span class="bandeja_count_bottom">0</span>
				</figure>
				<div class="separador_bandeja_aviso"></div>
				<div class="env_mensagens_aviso_addPaciente">
					<p Class="msg_sem_pacientes msg_pacientes_hidden">
						{{trans('pages.RM-MsgPacAdd')}}
					</p>
					<p class="msg_com_pacientes msg_pacientes_hidden">
						{{trans('pages.RM-MsgAddPac')}}
					</p>
				</div>
			</div>

			<div class="estilo_barra_resultados env_tt_pacientes_adidicionado">
				<span>{{trans('pages.RM-PAPac')}}</span>
				<span>{{trans('pages.RM-PATotEx')}}</span>
				<span>{{trans('pages.RM-PAOp')}}</span>
			</div>
			
			<section class="env_pacientes_add_registro_totalizadores_btn"></section>

		</section><!-- Fim da Div que envolve tudo dos pacientes adcionados -->
	</section><!-- <!-- Fim de tudo que envolve o registro manual  -->	


@stop

@section('alertas')
	<p class="msg_p_alerta alerta_msg_dependencias"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.ARM-ExiExDepVer')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviado"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.ARM-PacEnvBand')}}</p>
	<p class="msg_p_sucesso alerta_msg_alterado"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.ARM-AltEfet')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviados"><span>{{trans('pages.AG-Sucesso')}} </span>{{trans('pages.ARM-PacEnv')}}</p>
	<p class="msg_p_erro alerta_msg_falha_envio"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.ARM-FalEnvPac')}}</p>
	<p class="msg_p_erro alerta_msg_campos"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.ARM-PreCamObr')}}</p>
	<p class="msg_p_erro alerta_msg_erro"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.ARM-ErroEnvPacBand')}}</p>
	<p class="msg_p_erro alerta_msg_exames"><span>{{trans('pages.AG-Atencao')}} </span>{{trans('pages.ARM-EscExaVinPac')}}</p>

	<p class="alert_excluir_grupo">{{trans('pages.TtRM-ReDeExcGru')}}</p>
	<p class="alert_excluir_pedido">{{trans('pages.TtRM-ReDeExcPed')}}</p>
	<span class="txt_carregando_gru_lis">Carregando...</span>
@stop


@section('scripts')
	<script type="text/javascript" src="{{asset('lib/inputmask.js')}}"></script>
	<script type="text/javascript" src="{{asset('lib/jquery.inputmask.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/reg.js')}}"></script>
@stop