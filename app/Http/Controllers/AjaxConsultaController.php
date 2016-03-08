<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AjaxConsultaController extends Controller {

	public function __construct()
    {       
        $this->middleware('validateUser', ['only' => ['dlPlanilha','gerarPDF','imprimirResultados','baixarArquivo']]);            
    }

	public function nomePaciente(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$nome = $request->input('nomePaciente');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro,
			'nome' => $nome
		],
		[
			'nome' => 'required',
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'Nombre'=> $nome,
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','NombrePaciente',$param);

			if (isset($resultado->NombrePacienteResult)) {
				$aux = explode('^',$resultado->NombrePacienteResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			

		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	}


	public function refCliente(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$referencia = $request->input('referenciaCliente');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro,
			'referencia' => $referencia
		],
		[
			'referencia' => 'required',
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'Referencia'=> $referencia,
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','ReferenciaPaciente',$param);

			if (isset($resultado->ReferenciaPacienteResult)) {
				$aux = explode('^',$resultado->ReferenciaPacienteResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}

			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	} 


	public function refNous(Request $request)
	{
	 	$retorno = '';
		
		$token = Session::get('token');		
		$pedido = $request->input('pedido');			

			$param = [
				'Peticion'=> $pedido,				
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','ReferenciaNous',$param);

			if (isset($resultado->ReferenciaNousResult)) {
				$aux = explode('^',$resultado->ReferenciaNousResult);
				array_pop($aux);
				$aux2 = explode('#',$aux[0]);
				$retorno = [$aux2];

			}else{
				$retorno = '0';
			}					
		return view('consulta.tabela')->with('resultados',$retorno)->with('param','#');	  
	}


	public function nhc(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$nhc = $request->input('nhc');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro,
			'nhc' => $nhc
		],
		[
			'nhc' => 'required',
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'NHC'=> $nhc,
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','NHCPaciente',$param);

			if (isset($resultado->NHCPacienteResult)) {
				$aux = explode('^',$resultado->NHCPacienteResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	}


	public function exame(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$exame = $request->input('exame');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro,
			'exame' => $exame
		],
		[
			'exame' => 'required',
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$exame = $exame.'-';
			$auxExam = explode('-', $exame);
			$exame = trim($auxExam[0]);

			$param = [
				'Prueba'=> $exame,
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','Prueba',$param);

			if (isset($resultado->PruebaResult)) {
				$aux = explode('^',$resultado->PruebaResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	   	
	}


	public function dtRegistro(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro
		],
		[
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','FechaRegistro',$param);

			if (isset($resultado->FechaRegistroResult)) {
				$aux = explode('^',$resultado->FechaRegistroResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	}


	public function dtLiberacao(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	$request->input('top');

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro
		],
		[
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','FechaSalida',$param);

			if (isset($resultado->FechaSalidaResult)) {
				$aux = explode('^',$resultado->FechaSalidaResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	
	}


	public function urgSolicitadas(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	'1000';

		$validator = Validator::make(
		[
			'inicial' => $inicial,
			'final' => $final,
			'filtro' => $filtro
		],
		[
			'inicial' => 'required|date_format:d/m/Y',
			'final' => 'required|date_format:d/m/Y',
			'filtro' => 'required|in:Todos,NoLiberados,Liberados'
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{

			$param = [
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','Urgencias',$param);

			if (isset($resultado->UrgenciasResult)) {
				$aux = explode('^',$resultado->UrgenciasResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}
		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	}


	public function pedSeguimento(Request $request)
	{
	 	$retorno = '';

		$cli = Session::get('cliVinculado');
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$filtro =  $request->input('filtro');
		$top =	'1000';

		$validator = Validator::make(
			[
				'inicial' => $inicial,
				'final' => $final,
				'filtro' => $filtro
			],
			[
				'inicial' => 'required|date_format:d/m/Y',
				'final' => 'required|date_format:d/m/Y',
				'filtro' => 'required|in:Todos,NoLiberados,Liberados'
			]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{
			$param = [
				'Cliente'=> $cli,
				'FecIni'=> $inicial,
				'FecFin'=> $final,
				'Status'=> $filtro,
				'Top'=> $top,
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Consultas','Seguimiento',$param);

			if (isset($resultado->SeguimientoResult)) {
				$aux = explode('^',$resultado->SeguimientoResult);
				array_pop($aux);
				$retorno = array();

				foreach ($aux as $row) {
					$aux2 = explode('#',$row);					
					array_push($retorno, $aux2);			
				}
			}else{
				$retorno = '0';
			}

		}			
		return view('consulta.tabela')->with('resultados',$retorno)->with('param',$inicial.'#'.$final.'#'.$filtro);	  
	}


	public function planilha(Request $request)
	{
	 	$token = Session::get('token');
	 	$resultados = $request->input('resultados');

	 	$aux = explode('^', $resultados);
	 	array_pop($aux);

	 	$linhas = array();

	 	foreach ($aux as $row) {
	 		$aux2 = explode('#', $row);
	 		array_push($linhas, $aux2);
	 	}

	 	$retorno = md5(uniqid().$token);

	 	Excel::create($retorno, function($excel) use($linhas) {

	    	$excel->sheet('New sheet', function($sheet) use($linhas) {

	        	$sheet->loadView('consulta.planilha')->with('linhas',$linhas);

	    	});

		})->store('xls', storage_path('excel/exports'));

	 	return $retorno;
	}


	public function dlPlanilha($url)
	{

	 	$filepath = storage_path('excel/exports/').$url.'.xls';
	    $file = Excel::load($filepath, function($reader) {});
	    unlink($filepath);
	    $file->export('xls');	
	}


	public function flashPedidos(Request $request)
	{
	 	$pedidos = $request->input('pedidos');
	 	Session::put('flashped',$pedidos);
	}


	public function gerarPDF()
	{	

	 	if (!Session::get('flashped')) {
	 		abort(404);
	 	}

	 	$pedidos = Session::get('flashped');
	 	Session::forget('flashped');
	 	$token = Session::get('token');

	 	$param = [
				'Peticiones'=> $pedidos,
				'Token'=> $token
			];

	 	$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Consultas','GetPDF',$param);
		$aux = $resultado->GetPDFResult;

		if (!empty($resultado->GetPDFResult->PDFFile)) {
			$pdfText = $resultado->GetPDFResult->PDFFile;
			header('Content-type: Application/Pdf');
			echo $pdfText;
		}else{
			return view('customerrors.nopdf');
		}
	}


	public function addExame(Request $request)
	{		 	
	 	$pedido = $request->input('pedido');
	 	$exames = $request->input('exames');	 	
	 	$token = Session::get('token');

	 	$pruebas = substr($exames, 0,-1);

	 	$param = [
				'Peticion'=> $pedido,
				'Pruebas'=> $pruebas,
				'Token'=> $token
		];

	    $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Peticiones','AñadirPruebas',$param);		

		if (!empty($resultado->AñadirPruebasResult)) {			
			$aux = $resultado->AñadirPruebasResult;
		}else{
			$aux = '0';
		}

		return  $aux;
	}


	public function cancelarExames(Request $request)
	{		 	

	 	$pedido = $request->input('pedido');
	 	$exames = $request->input('exames');	 	
	 	$token = Session::get('token');
	 	$coment = $request->input('coment');

	 	$pruebas = substr($exames, 0,-1);

	 	$param = [
				'Peticion'=> $pedido,
				'Pruebas'=> $pruebas,
				'Token'=> $token,
				'Comentario'=> $coment
		];

	    $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Peticiones','CancelarPruebas',$param);		

		if (!empty($resultado->CancelarPruebasResult)) {			
			$aux = $resultado->CancelarPruebasResult;
		}else{
			$aux = '0';
		}

		return  $aux;
	}

	
	public function cancelarPedido(Request $request)
	{		 	
	 	$pedido = $request->input('pedido');	 		 	
	 	$token = Session::get('token');
	 	$coment = $request->input('coment'); 	

	 	$param = [
				'Peticion'=> $pedido,				
				'Token'=> $token,
				'Comentario'=> $coment
		];

	    $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Peticiones','Cancelar',$param);		

		if (!empty($resultado->CancelarResult)) {			
			$aux = $resultado->CancelarResult;
		}else{
			$aux = '0';
		}
		return  $aux;
	}


	public function seguirPedido(Request $request)
	{		 	

	 	$pedido = $request->input('pedido');	 		 	
	 	$token = Session::get('token');
	 	$emails = $request->input('emails'); 	

	 	$param = [
				'Peticion'=> $pedido,				
				'Token'=> $token,
				'emails'=> $emails
		];

	    $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Peticiones','SeguirPet',$param);		

		if (!empty($resultado->SeguirPetResult)) {			
			$aux = $resultado->SeguirPetResult;
		}else{
			$aux = '0';
		}

		return  $aux;
	}

	
	public function solicitarUrgencia(Request $request)
	{		 	

	 	$pedido = $request->input('pedido');
	 	$exames = $request->input('exames');	 	
	 	$token = Session::get('token');
	 	$coment = $request->input('coment');

	 	$pruebas = substr($exames, 0,-1);

	 	$param = [
				'Peticion'=> $pedido,
				'Pruebas'=> $pruebas,
				'Token'=> $token,
				'Comentario'=> $coment
		];

	    $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Peticiones','Urgencia',$param);		

		if (!empty($resultado->UrgenciaResult)) {			
			$aux = $resultado->UrgenciaResult;
		}else{
			$aux = '0';
		}

		return  $aux;
	}

	
	public function gerarImpressao(Request $request)
	{
	 	$print = $request->input('pedidos');
	 	$url = md5(Session::get('email').Session::get('clienteVinculado'));
	 	Cache::put($url,$print,2);	 	
	}

	
	public function imprimirResultados()
	{
	 	$md = md5(Session::get('email').Session::get('clienteVinculado'));

	 	if (!Cache::has($md)) {
	 		abort(404);
	 	}

	 	$aux = Cache::get($md);
	 	Cache::forget($md);

	 	$auxped = explode("^", $aux);
	 	array_pop($auxped);
	 	$pedidos = array();

	 	foreach ($auxped as $row) {
	 		$pedido = explode("#", $row);
	 		array_push($pedidos, $pedido);
	 	}

	 	return view('pdfs.impressao-resultados')->with('pedidos',$pedidos);
	}


	public function gerarDownload(Request $request)
	{
	 	$pedidos = $request->input('pedidos');
	 	Session::put('pedidosArqInt',$pedidos);	 		 	
	}

	
	public function baixarArquivo()
	{
	 	$token = Session::get('token');

	 	if (!Session::has('pedidosArqInt')) {
	 		abort(404);
	 	}else{
	 		$pedidos = 	Session::get('pedidosArqInt');	
	 		Session::forget('pedidosArqInt');		
	 	}

	 	$param = [
				'Peticiones'=> $pedidos,				
				'Token'=> $token,				
		];

	 	 $sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Consultas','GetIntegrado',$param);		

		if (isset($resultado->GetIntegradoResult->INTFile)) {			
			$aux = $resultado->GetIntegradoResult;
			
			File::put(storage_path() . '/arqint/'.$aux->FileName,$aux->INTFile);

			$retorno = response()->download(storage_path() . '/arqint/'.$aux->FileName)->deleteFileAfterSend(true);			

			return $retorno;
			
		}else{
			abort(404);
		}	
	}

}
