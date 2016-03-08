<html>
   <head><meta charset="UTF-8"></head>

	 <tr>
		<td align="left"><b>{{utf8_encode($linhas[0][0])}}</b></td>
		<td align="left"><b>{{utf8_encode($linhas[0][1])}}</b></td>
		<td align="left"><b>{{utf8_encode($linhas[0][2])}}</b></td>
		<td align="left"><b>{{utf8_encode($linhas[0][3])}}</b></td>
   		
   </tr>

   <?php array_shift($linhas) ?>

   @foreach($linhas as $linha)
      <tr>
   		<td align="left">{{utf8_encode($linha[0])}}</td>
   		<td align="left">{{utf8_encode($linha[1])}}</td>
   		<td align="left">{{utf8_encode($linha[2])}}</td>
   		<td align="left">{{utf8_encode($linha[3])}}</td>
      </tr>
   @endforeach
    
</html>