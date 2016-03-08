<html>
   <head><meta charset="UTF-8"></head>

	 <tr>
   		<td align="left"><b>Paciente</b></td>
   		<td align="left"><b>Data de Registro</b></td>
   		<td align="left"><b>Data de Liberação</b></td>
   		<td align="left"><b>Referência</b></td>
   		<td align="left"><b>Pedido Noús</b></td>
   		<td align="left"><b>Status</b></td>
   </tr>

   @foreach($linhas as $linha)
      <tr>
   		<td align="left">{{$linha[0]}}</td>
   		<td align="left">{{$linha[1]}}</td>
   		<td align="left">{{$linha[2]}}</td>
   		<td align="left">{{$linha[3]}}</td>
   		<td align="left">{{$linha[4]}}</td>
   		<td align="left">{{$linha[5]}}</td>
      </tr>
   @endforeach
    
</html>