@extends('template')

@section('conteudo')
	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token()}}">
	<input type="hidden" name="userEmailSend" value="{{Session::get('email')}}">
	
	<!-- Buscador -->
	<section class="env_cx_filtro_opcoes">
		<div class="filtro_opcoes_busca">
			<img src="img/icones/lupa_azul.png" class="lupa_azul_filtro_busca_pg_resultados">
			<img src="img/icones/lupa_branco.png" class="lupa_branca_filtro_busca_pg_resultados">
			<h3>{{trans('pages.PC-FilBusPor1')}} <span>{{trans('pages.PC-FilBusPor2')}}</span> {{trans('pages.PC-FilBusPor3')}}</h3>
			<form action="" class="form_filtro_busca">
				<select name="opBusca" id="opcao_escolhida">
					<option value="nomePaciente">{{trans('pages.PC-FilNomPac')}}</option>
					<option value="referenciaCliente">{{trans('pages.PC-FilRefCli')}}</option>
					<option value="referenciaNous">{{trans('pages.PC-FilRefNous')}}</option>
					<option value="nhc">{{trans('pages.PC-FilNHC')}}</option>
					<option value="exame">{{trans('pages.PC-FilExa')}}</option>
					<option value="dtRegistro">{{trans('pages.PC-FilDtReg')}}</option>
					<option value="dtLiberacao">{{trans('pages.PC-FilDtLib')}}</option>
					<option value="urgencaSolicitada">{{trans('pages.PC-FilUrg')}}</option>
					<option value="pedidoSeguimento">{{trans('pages.PC-FilPedSeg')}}</option>
					<option value="selecione" selected>{{trans('pages.PC-FilSel')}}</option>
				</select>
			</form>
		</div>
		
		<!-- Caixa que envolve todos os formulários de busca. -->
		<div class="env_opcoes_busca">

			<p class="texto_busca_resultados opFiltro">
				{{trans('pages.PC-FilTxtBemVin1')}} <br class="pula_linha_filtro_op_busca">
				{{trans('pages.PC-FilTxtBemVin2')}} <br><br>
				{{trans('pages.PC-FilTxtBemVin3')}} <br class="pula_linha_filtro_op_busca">
				{{trans('pages.PC-FilTxtBemVin4')}}
			</p>
			
			<!-- Nome -->
			<form action="" class="form_opcao_busca_nome opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="nome_op_nomePaciente">
						<label for="">
							<span>{{trans('pages.PC-FilNom')}}</span>	
							<input type="text" name="NomePaciente">
						</label>
					</div>

					<div class="dtInicial_op_nomePaciente">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>

					<div class="dtFinal_op_nomePaciente">
						<label for="" >
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>

					<div class="tipoBusca_op_nomePaciente">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim do Nome

			<!-- Referência do cliente -->
			<form action="" class="form_opcao_busca_referencia_cliente opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="referencia_op_ReferenciaPaciente">
						<label for="">
							<span>{{trans('pages.PC-FilRef')}}</span>	
							<input type="text" name="referenciaCliente">
						</label>
					</div>
					<div class="dtInicial_op_referenciaCliente">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>	
					<div class="dtFinal_op_referenciaCliente">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_referenciaCliente">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim da referência do cliente

			<!-- Referência Noûs -->
			<form action="" class="form_opcao_busca_referencia_nous opFiltro">
				<div class="env_linha_op_busca_unificada">
					<div class="pedidoNous_op_pedidoNous">
						<label for="">
							<span>{{trans('pages.PC-FilPedNous')}}</span>	
							<input type="text" name="pedidoNous">
						</label>
					</div>
					<div class="env_btn_submit_unificados">
						<input type="submit" value="{{trans('pages.PC-FilBus')}}">	
					</div>
				</div>
			</form>   <!-- Fim dareferência Noûs -->
			
			<!-- NHC -->
		    <form action="" class="form_opcao_busca_nhc opFiltro">
		        <div class="row env_linha_op_busca_um">
		         	<div class="referencia_op_nhc">
		          	<label for="">
			           <span>NHC</span> 
			           <input type="text" name="nhc">
		          	</label>
		        </div>
		        <div class="dtInicial_op_nhc">
			        <label for="">
			           <span>{{trans('pages.PC-FilDtIni')}}</span> 
			           <img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
			        </label>
		        </div> 
			        <div class="dtFinal_op_nhc">
			          	<label for="">
				           <span>{{trans('pages.PC-FilDtFin')}}</span>
				           <img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
				         </label>
			        </div>
			        <div class="tipoBusca_op_nhc">
			          	<label for="">
			           	<span>{{trans('pages.PC-FilResul')}}</span>
				           	<select name="tipoBusca" id="">
					            <option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
					            <option value="noLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
					            <option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
				           	</select>
			          	</label>
			        </div>
		        </div>
		        <div class="env_input_submit">
		         	<input type="submit" value="{{trans('pages.PC-FilBus')}}">
		        </div>
		     </form> <!-- Fim dO NHC -->

			<!-- Exame -->
			<form action="" class="form_opcao_busca_exame opFiltro">
				<div class="env_linha_op_exames">
					<label for="">
						<span>{{trans('pages.PC-FilExaForm')}}</span>
						<input type="text" name="Exame" id="input_autocomplete_busca_exame">
					</label>
				</div>
				<div class="row env_linha_op_busca_um">
					<div class="dtInicial_op_exame">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>
					<div class="dtFinal_op_exame">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_exame">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilSelDtReg')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilSelDtLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim do Exame

			<!-- Data de registro -->
			<form action="" class="form_opcao_busca_data_registro opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="dtInicial_op_dtRegistro">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>
					<div class="dtFinal_op_dtRegistro">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_dtRegistro">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim da data de registro -->

			<!-- Data de liberação -->
			<form action="" class="form_opcao_busca_data_liberacao opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="dtInicial_op_dtLiberacao">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>
					<div class="dtFinal_op_dtLiberacao">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_dtLiberacao">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados" selected>{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos">{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- fim da data de liberação -->
			
			<!-- Urgência solicitada -->
			<form action="" class="form_opcao_busca_urgencia_solicitada opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="dtInicial_op_urgenciaSolicitada">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>
					<div class="dtFinal_op_urgenciaSolicitada">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_urgenciaSolicitada">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim da urgência solicitada -->

			<!-- Pedidos seguidos -->
			<form action="" class="form_opcao_busca_pedidos_seguidos opFiltro">
				<div class="row env_linha_op_busca_um">
					<div class="dtInicial_op_pedidosSeguidos">
						<label for="">
							<span>{{trans('pages.PC-FilDtIni')}}</span>	
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataInicial" class="datainicial">
						</label>
					</div>
					<div class="dtFinal_op_pedidosSeguidos">
						<label for="">
							<span>{{trans('pages.PC-FilDtFin')}}</span>
							<img src="img/icones/calendario_inputs.png" class="img_calendario_op_busca"><input type="text" name="dataFinal" class="datafinal">
						</label>
					</div>
					<div class="tipoBusca_op_pedidosSeguidos">
						<label for="">
							<span>{{trans('pages.PC-FilResul')}}</span>
							<select name="tipoBusca" id="">
								<option value="Liberados">{{trans('pages.PC-FilLib')}}</option>
								<option value="NoLiberados">{{trans('pages.PC-FilNaoLib')}}</option>
								<option value="Todos" selected>{{trans('pages.PC-FilTodos')}}</option>
							</select>
						</label>
					</div>
				</div>
				<div class="env_input_submit">
					<input type="submit" value="{{trans('pages.PC-FilBus')}}">
				</div>
			</form> <!-- Fim do pedidos seguidos -->

		</div>	<!-- Fim da caixa que envolve todos os formulários de busca. -->

		<div class="env_seta_abre_fecha_buscador_op_busca esconde_mostra_cx_opcoes">
			<img src="img/icones/seta_baixo.png" class="seta_esconde_mostra_cx_opcoes">
		</div>

	</section>
	<!-- Fim do buscador -->

	<hr class="linha_separadora_resultados_gerais">

	<!-- Resultados de busqueda	 -->
	<section class="env_botoes_resultados_conteudos"></section><!-- fim dos resultados de busqueda	 -->

@stop

@section('modal')
	<!-- Tela escura que envolve os madals. -->
	<section class="telaoscura">
		
		<!-- Acompanha pedido -->
		<div class="modal_acompanhar_pedido  modal_janela_pg_resultados" id="modal_acompanhar_pedido">
			<input type="hidden" class="modal_acompanhar_pedido_hidden_cod" value="">
			<div class="header_modal_pg_resultados">
				<h1 class="tt_modal">{{trans('pages.PC-MdTtSegPed')}}</h1>
				<img src="{{asset('img/icones/x_branco.png')}}" class="fechar_modal_pg_resultado" title="{{trans('pages.TtMd-FecJan')}}">
			</div>
			
			<div class="env_conteudo_acompanhar_pedido">
				<figure>
					<img src="{{asset('img/icones/estrela_grande.png')}}">
				</figure>
				<div class="texto_acompanhar_pedido">
					<p>
						    {{trans('pages.PC-MdMsgSegPed')}}
					</p>
				</div>
				<form action="" class="form_acompanhar_pedido">
					<label for="">
						{{trans('pages.PC-MdAddEmails')}}
						<textarea class="emailsAcompanharPedido"></textarea>
					</label>
					<input type="submit" value="{{trans('pages.PC-MdBtnSegPed')}}">
				</form>
			</div>
		</div><!-- Fim do acompanhamento de pedido -->	

		<!-- Incluir exames -->
		<div class="modal_add_exame modal_janela_pg_resultados">
			<input type="hidden" class="modal_add_exame_hidden_cod" value="">
			<div class="header_modal_pg_resultados">
				<h1 class="tt_modal">{{trans('pages.PC-MdTtIncExa')}}</h1>
				<img src="{{asset('img/icones/x_branco.png')}}" class="fechar_modal_pg_resultado" title="{{trans('pages.TtMd-FecJan')}}">
			</div>
			
			<div class="env_conteudo_add_exame">
				<div class="linha_exame_escolhido" style="display:none">
					<input type="hidden" value=""> </span><span>Codigo de exame - Nome do exame</span><img src="{{asset('img/icones/x.png')}}" class="remove_modal_incluir_exame">
				</div>
				<form action="" class="form_buscador_add_exame">
					<label for="">
						<img src="{{asset('img/icones/lupa_branco.png')}}">
						{{trans('pages.PC-MdIncExProExa')}}
						<input type="text" id="input_autocomplete_add_exame">
					</label>
				</form>

				<h4>{{trans('pages.PC-MdIncExExEsc')}}</h4>
				<div class="env_exame_escolhidos_adicaoExame"></div>
			</div>
			
			<P class="texto_aviso_add_exame">
				<span>{{trans('pages.PC-MdDestImportante')}} </span>{{trans('pages.PC-MdIncExNot')}}
			</P>
			
			<form action="" class="form_add_email_add_exames">
				<input type="submit" value="{{trans('pages.PC-MdBtnSol')}}">
			</form>
		</div><!-- Fim da inclusão de exames -->
			
		<!-- Solicitar Urgência -->
		<div class="modal_solicitar_urgencia modal_janela_pg_resultados">
			<input type="hidden" class="modal_solicitar_urgencia_hidden_cod" value="">
			<div class="header_modal_pg_resultados">
				<h1 class="tt_modal">{{trans('pages.PC-MdSolUrg')}}</h1>
				<img src="{{asset('img/icones/x_branco.png')}}" class="fechar_modal_pg_resultado" title="{{trans('pages.TtMd-FecJan')}}">
			</div>
			
			<p class="txt_explicativo_solicitar_urgencia">
				{{trans('pages.PC-MdSolUrgExp')}}
			</p>
			
			<form action="" class="form_radio_solicitarUrgencia">
				<input type="checkbox" name="escolhaSolicitacaoUrgencia" value="male" id="ckbx_modal_urgencia"><span>{{trans('pages.PC-MdSolUrPedCom')}}</span>
			</form>

			<div class="env_conteudo_solicitar_urgencia">
			</div>
			
			<P class="texto_aviso_solicitar_urgencia">
				<span>{{trans('pages.PC-MdDestImportante')}} </span>{{trans('pages.PC-MdSolUrNot1')}} <br>{{trans('pages.PC-MdSolUrNot2')}}
			</P>
			
			<form action="" class="form_add_email_justificativa_solicitarUrgencia">
				<label for="" class="lb_justifica_solicitarUrgencia">
					{{trans('pages.PC-MdSolUrJusUrg')}}<br>
					<textarea class="justificativa_solicitar_urgencia"></textarea>
				</label>
				<input type="submit" value="{{trans('pages.PC-MdBtnSol')}}">
			</form>
		</div><!-- Fim da solicitação de urgência -->	

		<!-- Cancelar totalmente o pedido -->
		<div class="modal_cancelarTotalPeido modal_janela_pg_resultados">
			<input type="hidden" class="modal_cancelar_pedido_hidden_cod" value="">
			<div class="header_modal_pg_resultados">
				<h1 class="tt_modal">{{trans('pages.PC-MdTtCanTotPed')}}</h1>
				<img src="{{asset('img/icones/x_branco.png')}}" class="fechar_modal_pg_resultado" title="{{trans('pages.TtMd-FecJan')}}">
			</div>
			
			<p class="txt_explicativo_cancelarTotalPeido">
				{{trans('pages.PC-MdCanTotPedExp')}}
			</p>
			
			<P class="texto_aviso_cancelarTotalPeido">
				<span>{{trans('pages.PC-MdDestImportante')}} </span>{{trans('pages.PC-MdCanTotPedNot')}}
			</P>
				
			<form action="" class="form_cancelarTotalPeido">
				<label for="" class="lb_justifica_cancelarTotalPeido">
					{{trans('pages.PC-MdCanTotPedJus')}}<br>
					<textarea name="justificativa" class="justificativa_cancelar"></textarea>
				</label>
				<input type="submit" value="{{trans('pages.PC-MdBtnSol')}}">
			</form>
		</div><!-- Fim do cancelamento total do pedido -->	

		<!-- Excluir Exames -->
		<div class="modal_excluirExame modal_janela_pg_resultados">
			<input type="hidden" class="modal_excluir_exame_hidden_cod" value="">
			<div class="header_modal_pg_resultados">
				<h1 class="tt_modal">{{trans('pages.PC-MdTtCanExa')}}</h1>
				<img src="{{asset('img/icones/x_branco.png')}}" class="fechar_modal_pg_resultado" title="{{trans('pages.TtMd-FecJan')}}">
			</div>
			
			<h4>{{trans('pages.PC-MdCanExExp')}}</h4>	

			<div class="env_exames_vinculados_excluirExames"></div>

			<P class="texto_aviso_excluirExame">
				<span>{{trans('pages.PC-MdDestImportante')}} </span>{{trans('pages.PC-MdCanExNot')}}
			</P>
				
			<form action="" class="form_excluirExame">
				<label for="" class="lb_justifica_excluirExame">
					{{trans('pages.PC-MdCanExJus')}}<br>
					<textarea name="justificativa" class="justificativa_excluir_exames"></textarea>
				</label>
				<input type="submit" value="{{trans('pages.PC-MdBtnSol')}}">
			</form>
		</div><!-- Fim da exclusão de exames -->
	</section><!-- Fim da tela escura que envolve os madals. -->
@stop

@section('alertas')
	<p class="msg_p_alerta alerta_msg_selecionar"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-NenPedSel')}}</p>
	<p class="msg_p_erro alerta_msg_erro_solicitacao"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-NaoPosEnvSol')}}</p>
	<p class="msg_p_sucesso alerta_msg_enviada_solicitacao"><span>{{trans('pages.AM-Sucesso')}} </span>{{trans('pages.AM-SolEnv')}}</p>
	<p class="msg_p_alerta alerta_msg_preencher_justificativa"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-JusMotSol')}}</p>
	<p class="msg_p_alerta alerta_msg_selecionar_exames"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-NenExSel')}}</p>
	<p class="msg_p_alerta alerta_msg_selecionar_emails"><span>{{trans('pages.AM-Atencao')}} </span>{{trans('pages.AM-InfEmaRet')}}</p>
@stop

@section('scripts')
    <script src="{{asset('js/cons.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/eln.js')}}"></script>
@stop