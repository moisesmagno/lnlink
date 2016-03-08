@if($exames == '0')
	<div class="mensagem_vazio_lista">
		<span>{{trans('pages.LE-MsgLisVaz1')}} <br>{{trans('pages.LE-MsgLisVaz2')}}</span>
		<div class="env_btn_add_pedidos_lista">
			<a href="{{url(trans('routes.catalogo'))}}" class="bt_azul">{{trans('pages.LE-BtnAdiExa')}}</a>
		</div>
	</div>

@else
	<section class="env_botoes_lista">
			<div class="env_botoes">
				@if(in_array(Session::get('codPais'), ['55','51','52','57']))
					<a href="" class="abre_moda_solicitacao_adicional">
						<div class="solicitar_informacao_adicional">
							<img src="{{asset('img/icones/solicitar_informacao.png')}}">
							<span>{{trans('pages.LE-SolInf')}}</span>
						</div>
					</a>
					<a href="" class="abre_modal_solicitar_catacao">
						<div class="solicitar_cotacao">
							<img src="{{asset('img/icones/solicitar_orcamento.png')}}">
							<span>{{trans('pages.LE-SolOrc')}}</span>
						</div>
					</a>
				@endif	
				<div class="zerar_lista">
					<a href="" class="bt_vermelho zerar_lista_click">{{trans('pages.LE-ZerLis')}}</a>
				</div>
				<a href="" class="link_gerar_pedido">
					<div class="criar_pedido">
						<img src="{{asset('img/icones/bandeja_azul.png')}}">
						<span >{{trans('pages.LE-CriPed')}}</span>
					</div>
				</a>
			</div>

			<!-- titulo bandeja -->
			<div class="estilo_barra_resultados env_tt_lista">
				<span><input type="checkbox" class="lista_exames_check_all"></span>
				<span>{{trans('pages.LE-Exa')}}</span>
			</div><!-- Fim do titulo bandeja -->
			
			<!-- Linhas de exames -->
			<div class="env_linhas_exames_lista">

				@foreach($exames as $exame)

				<div class="linha_exame_lista">
					<input type="checkbox" value="{{$exame['cod']}}" class="linha_exame_lista_input">
					<div class="nome_exame_lista"><span>{{$exame['def']}}</span></div>
					<div class="apaga_linha_exame_lista"><img src="{{asset('img/icones/x.png')}}" class="apaga_linha_exame_lista_click" title="{{trans('pages.TtLE-ExcExa')}}"></div>
				</div>

				@endforeach
			
			</div><!-- Fim das linhas de exames -->
	</section>
@endif
