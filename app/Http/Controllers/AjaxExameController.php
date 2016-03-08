<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Util\SoapManager as SoapManager;

class AjaxExameController extends Controller {

	

	public function listarExamesRegistro()
	{
	
		
		$i = 0;
		$retorno = array();
	
		$e = Session::get('eln');

		$resultado = explode('^', $e);

		array_pop($resultado);

		foreach ($resultado as $linha) {

			$aux = explode('#', $linha);			
			$codnome = $aux[0].' - '.$aux[1];					
			$exame = ['value' => utf8_encode($codnome), 'data' => [utf8_encode($aux[0]),utf8_encode($aux[1]),utf8_encode($aux[2]),utf8_encode($aux[3]),utf8_encode($aux[4]),utf8_encode($aux[5]),utf8_encode($aux[6])]];
			$retorno[$i] = $exame;
			$i++;
		}

		return json_encode($retorno,8000);
	}


	public function listarExames()
	{
		
		$i = 0;
		$retorno = array();
	
		$e = Session::get('eln');

		$resultado = explode('^', $e);

		array_pop($resultado);

		foreach ($resultado as $linha) {

			$aux = explode('#', $linha);			
			$codnome = $aux[0].' - '.$aux[1];			
			$exame = ['value' => utf8_encode($codnome), 'data' => utf8_encode($aux[0])];
			$retorno[$i] = $exame;
			$i++;
		}			 
		
		return json_encode($retorno,8000);	
	}

	public function listarExamesCatalogo()
	{
		
		$i = 0;
		$retorno = array();
	
		$e = Session::get('eln');

		$resultado = explode('^', $e);

		array_pop($resultado);

		foreach ($resultado as $linha) {

			$aux = explode('#', $linha);						
			$exame = ['value' => utf8_encode($aux[0]).' - '.utf8_encode($aux[1]), 'data' => utf8_encode($aux[0])];
			$retorno[$i] = $exame;
			$i++;

		}			 

		return json_encode($retorno,8000);	

	}




	public function buscarExames(Request $request)
	{

		$esplab = $request->input('esplab');
		$sublab = $request->input('sublab');
		$espcli = $request->input('espcli');
		$amostra = $request->input('amostra');

		$filtros = array();

		if (!empty($esplab)) {
			array_push($filtros, $esplab);
		}
		if (!empty($sublab)) {
			array_push($filtros, $sublab);
		}
		if (!empty($espcli)) {
			array_push($filtros, $espcli);
		}
		if (!empty($amostra)) {
			array_push($filtros, $amostra);
		}
		
		$retorno = array();
	
		$e = Session::get('eln');

		$resultado = explode('^', $e);

		array_pop($resultado);

		foreach ($resultado as $linha) {

			$aux = explode('#', $linha);
			$error = false;
			$categorias = $aux[7].$aux[8].$aux[9].$aux[10];

			foreach ($filtros as $filtro) {
				$linhaTeste = utf8_encode($categorias);

				if (strpos($linhaTeste, $filtro) === false) {
					$error = true;
				}
				
			}

			if (!$error) {
				$aux = explode('#', $linha);					
				$exame = ['value' => utf8_encode($aux[0]).' - '.utf8_encode($aux[1]), 'data' => utf8_encode($aux[0])];
				array_push($retorno, $exame);		
				
			}			

		}			 
		
		return json_encode($retorno,8000);
	}


	public function examesSolicitarUrgencia(Request $request)
	{
		
		$pedido = $request->input('pedido');
		$token = Session::get('token');

		$sm = new SoapManager;	

		$resultado = $sm->execute('LNLink.Peticiones','GetPruebas',['Token'=>$token,'Peticion'=>$pedido]);

		$exames = array();		

		if (isset($resultado->GetPruebasResult)) {
			$aux = explode('^', $resultado->GetPruebasResult);
			array_pop($aux);
			foreach ($aux as $row) {
				$exame = explode('#', $row);
				array_push($exames, $exame);
			}

		}else{
			$exames = '0';			
		}		

		return view('consulta.exames-modal-solicitar-urgencia')->with('exames',$exames);
	}


	public function examesExcluirExames (Request $request)
	{
		$pedido = $request->input('pedido');
		$token = Session::get('token');

		$sm = new SoapManager;	

		$resultado = $sm->execute('LNLink.Peticiones','GetPruebas',['Token'=>$token,'Peticion'=>$pedido]);

		$exames = array();		

		if (isset($resultado->GetPruebasResult)) {
			$aux = explode('^', $resultado->GetPruebasResult);
			array_pop($aux);
			foreach ($aux as $row) {
				$exame = explode('#', $row);
				array_push($exames, $exame);
			}

		}else{
			$exames = '0';			
		}		

		return view('consulta.exames-modal-excluir-exames')->with('exames',$exames);
	}

}
