@if($rows == '0')

@else

	@foreach($rows as $row)

		<div class="row_tabela_evolucao_ativiade_remetida_mes">
			<div class="coluna_um_tabela_relatorio"><span class="tt_tabela_realtorio">{{utf8_encode($row[0])}}</span></div>
			<div class="coluna_dois_tabela_relatorio"><span class="tt_tabela_realtorio">{{$row[1]}}</span></div>
			<div class="coluna_tres_tabela_relatorio"><span class="tt_tabela_realtorio">{{$row[2]}}</span></div>
			<div class="coluna_quatro_tabela_relatorio"><span class="tt_tabela_realtorio">{{$row[3]}}</span></div>
		</div>

	@endforeach

@endif