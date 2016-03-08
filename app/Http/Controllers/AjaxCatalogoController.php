<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use App\Util\ExamFinder as ExamFinder;

use Illuminate\Http\Request;

class AjaxCatalogoController extends Controller {

	public function __construct()
    {       
        $this->middleware('validateUser', ['only' => ['getDoc','getFicha','getLaudo']]);            
    }


	public function listarSubLab(Request $request)
	{
		$token = Session::get('token');	
		$esplab = $request->input('esplab');				

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','SubLab',['Token'=>$token,'EspLab'=>$esplab]);

		if (isset($resultado->SubLabResult)) {
			$sublab = explode('^', $resultado->SubLabResult);
			array_pop($sublab);			
		}else{
			$sublab = '0';			
		}		

		return view('catalogo.index-esp-sublab')->with('esps',$sublab);		
	}


	public function listarSubLabFiltro(Request $request)
	{
		$token = Session::get('token');	
		$esplab = $request->input('esplab');				

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','SubLab',['Token'=>$token,'EspLab'=>$esplab]);

		if (isset($resultado->SubLabResult)) {
			$sublab = explode('^', $resultado->SubLabResult);
			array_pop($sublab);			
		}else{
			$sublab = '0';			
		}			
		return view('catalogo.index-filtro-sublab')->with('sublab',$sublab);		
	}


	public function listarSubLabFiltroDiv(Request $request)
	{
		$token = Session::get('token');	
		$esplab = $request->input('esplab');				

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','SubLab',['Token'=>$token,'EspLab'=>$esplab]);

		if (isset($resultado->SubLabResult)) {
			$sublab = explode('^', $resultado->SubLabResult);
			array_pop($sublab);			
		}else{
			$sublab = '0';			
		}			
		return view('catalogo.index-filtro-sublab-div')->with('sublab',$sublab)->with('esplab',$esplab);		
	}

	
	public function listarResultados(Request $request)
	{

		$esplab = $request->input('esplab');
		$sublab = $request->input('sublab');
		$espcli = $request->input('espcli');
		$amostra = $request->input('amostra');
		$texto = $request->input('texto');

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
				
		$resultados = array();
	
		$e = Session::get('eln');

		$resultado = explode('^', $e);

		array_pop($resultado);

		foreach ($resultado as $linha) {

			$aux = explode('#', $linha);

			$categorias = $aux[7].$aux[8].$aux[9].$aux[10];
			$label = utf8_encode($aux[0]).' - '.utf8_encode($aux[1]);

			$error = false;
			$linhaTeste = utf8_encode($categorias);

			foreach ($filtros as $filtro) {

				if (stripos($linhaTeste, $filtro) === false) {
					$error = true;
				}
				
			}

			if (stripos($label, $texto) === false AND !empty($texto)) {
					$error = true;
			}

			if (!$error) {									
				$exame = ['cod' => utf8_encode($aux[0]),'value' => utf8_encode($aux[0]).' - '.utf8_encode($aux[1]), 'cod' => utf8_encode($aux[0]), 'esplab' => utf8_encode($aux[7]),'sublab' => utf8_encode($aux[8]),'espcli' => utf8_encode($aux[9]),'amostra' => utf8_encode($aux[10])];
				array_push($resultados, $exame);		
			}			
		}				 
		return view('catalogo.index-resultados')->with('exames',$resultados)->with('filtros',$filtros);	
	}


	public function addExame(Request $request)
	{
		$exame = $request->input('cod');
		$token = Session::get('token');	
		$lista = explode('#', Session::get('lln'));

		if (!in_array($exame, $lista)) {
			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Catalogo','CreaLista',['Token'=>$token,'Pruebas'=>$exame]);

			if (isset($resultado->CreaListaResult)) {
				$aux = $resultado->CreaListaResult;

				if ($aux == '1') {					

					$listaAtual = Session::get('lln');
					if ($listaAtual == '0') {
						$listaAtual = $exame;
					}else{
					$listaAtual = $listaAtual.'#'.$exame;
					}	
					Session::put('lln',$listaAtual);
					$aux = explode('#',	$listaAtual);
					Session::put('lcount',count($aux));

					$retorno = '1';
					
				}else{
					$retorno = '0';
				}
			}else{
				$retorno = '0';
			}
		}else{
			$retorno = '2';
		}
		return $retorno;
	}


	public function getDoc($cod,$patio,$doc)
	{
		$sm = new SoapManager;

		$token = Session::get('token');	
		$prueba = $cod;
		$path = $patio.'/'.$doc;

		$resultado = $sm->execute('LNLink.Catalogo','GetDoc',['Token'=>$token,'Prueba'=>$prueba,'Path'=>$path]);		

		if (!empty($resultado->GetDocResult)) {
			$pdfText = $resultado->GetDocResult;
			header('Content-type: Application/Pdf');
			echo $pdfText;
		}else{
			return view('customerrors.nopdf');
		}
	}


	public function getFicha($cod)
	{
		$sm = new SoapManager;

		$token = Session::get('token');	
		$prueba = $cod;
		
		$resultado = $sm->execute('LNLink.Catalogo','GetFicha',['Token'=>$token,'Prueba'=>$prueba]);		

		if (!empty($resultado->GetFichaResult)) {

			$pdfText = $resultado->GetFichaResult;
			header('Content-type: Application/Pdf');
			echo $pdfText;
		}else{
			return view('customerrors.nopdf');
		}
	}


	public function getLaudo($cod)
	{
		$sm = new SoapManager;

		$token = Session::get('token');	
		$prueba = $cod;
		
		$resultado = $sm->execute('LNLink.Catalogo','GetInforme',['Token'=>$token,'Prueba'=>$prueba]);		

		if (!empty($resultado->GetInformeResult)) {

			$pdfText = $resultado->GetInformeResult;
			header('Content-type: Application/Pdf');
			echo $pdfText;
		}else{
			return view('customerrors.nopdf');
		}
	}

}
