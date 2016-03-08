<html>
   <head><meta charset="UTF-8"></head>
	 <tr>
   		<td align="left"><b>{{utf8_encode($linhas[0][0])}}</b></td>
   		<td align="left"><b>{{utf8_encode($linhas[0][1])}}</b></td>
   		<td align="left"><b>{{utf8_encode($linhas[0][2])}}</b></td>
   		<td align="left"><b>{{utf8_encode($linhas[0][3])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][4])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][5])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][6])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][7])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][8])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][9])}}</b></td>
         <td align="left"><b>{{utf8_encode($linhas[0][10])}}</b></td>
   		
   </tr>

   <?php array_shift($linhas) ?>

   @foreach($linhas as $linha)
      <tr>
   		<td align="left">{{utf8_encode($linha[0])}}</td>
         <td align="left">{{utf8_encode($linha[1])}}</td>
         <td align="left">{{utf8_encode($linha[2])}}</td>
         <td align="left">{{utf8_encode($linha[3])}}</td>
         <td align="left">{{utf8_encode($linha[4])}}</td>
         <td align="left">{{utf8_encode($linha[5])}}</td>
         <td align="left">{{utf8_encode($linha[6])}}</td>
         <td align="left">{{utf8_encode($linha[7])}}</td>
         <td align="left">{{utf8_encode($linha[8])}}</td>
         <td align="left">{{utf8_encode($linha[9])}}</td>
         <td align="left">{{utf8_encode($linha[10])}}</td>
      </tr>
   @endforeach
      
</html>