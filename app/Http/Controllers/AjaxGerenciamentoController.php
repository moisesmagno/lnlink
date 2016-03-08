<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class AjaxGerenciamentoController extends Controller {

	public function __construct()
    {       
        $this->middleware('validateUser', ['only' => ['dlPlanilha','pdf']]);            
    }

	public function relEvoAtvRem()
	{
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetFamilias',['Token'=>$token]);

		$rows = array();

		if (isset($resultado->GetFamiliasResult)) {
			
		$aux = explode('^', $resultado->GetFamiliasResult);
		array_pop($aux);

			foreach ($aux as $key) {
				$row = explode('#', $key);
				array_push($rows, $row);
			}		
		
		}else{
			$rows = '0';
		}

		return view('gerenciamento.relatorio-tabela1')->with('rows',$rows);
	}


	public function relDivParRem()
	{
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetDiversidad',['Token'=>$token]);

		$rows = array();

		if (isset($resultado->GetDiversidadResult)) {
			
		$aux = explode('^', $resultado->GetDiversidadResult);
		array_pop($aux);

			foreach ($aux as $key) {
				$row = explode('#', $key);
				array_push($rows, $row);
			}		
		
		}else{
			$rows = '0';
		}

		return view('gerenciamento.relatorio-tabela2')->with('rows',$rows);
	}


	public function relComprimentoPrazo()
	{
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetDemoras',['Token'=>$token]);

		$rows = array();

		if (isset($resultado->GetDemorasResult)) {
			
		$aux = explode('^', $resultado->GetDemorasResult);
		array_pop($aux);

			foreach ($aux as $key) {
				$row = explode('#', $key);
				array_push($rows, $row);
			}		
		
		}else{
			$rows = '0';
		}

		return view('gerenciamento.relatorio-tabela2')->with('rows',$rows);
	}


	public function relOcorrenciaOrigem()
	{
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetIncidencias',['Token'=>$token]);

		$rows = array();

		if (isset($resultado->GetIncidenciasResult)) {
			
		$aux = explode('^', $resultado->GetIncidenciasResult);
		array_pop($aux);

			foreach ($aux as $key) {
				$row = explode('#', $key);
				array_push($rows, $row);
			}		
		
		}else{
			$rows = '0';
		}

		return view('gerenciamento.relatorio-tabela3')->with('rows',$rows);
	}
	

	public function faturaPorExame(Request $request)
	{
		$token = Session::get('token');	
		$fatenv = $request->input('mesEscolhido');

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetXLSFacturaPru',['Token'=>$token,'Factura'=>$fatenv]);

		if (isset($resultado->GetXLSFacturaPruResult)) {
			
		$aux = $resultado->GetXLSFacturaPruResult;
		
		}else{
			return '0';
		}

		$chr9 = chr(9);
		$chr1310 = chr(13).chr(10);

		$linhas = array();

		$fatura = explode($chr1310,$aux);

		foreach ($fatura as $row) {
			$auxrow = explode($chr9,$row);
			array_push($linhas,$auxrow);
		}

		$retorno = md5(uniqid().$token);

		Excel::create($retorno, function($excel) use($linhas) {

	    	$excel->sheet('New sheet', function($sheet) use($linhas) {

	        	$sheet->loadView('gerenciamento.planilha')->with('linhas',$linhas);

	    	});

		})->store('xls', storage_path('excel/exports'));		

		return $retorno;

	}


	public function faturaPorMes(Request $request)
	{
		$token = Session::get('token');	
		$fatenv = $request->input('mesEscolhido');

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetXLSFactura',['Token'=>$token,'Factura'=>$fatenv]);

		if (isset($resultado->GetXLSFacturaResult)) {
			
		$aux = $resultado->GetXLSFacturaResult;
		
		}else{
			return '0';
		}

		$chr9 = chr(9);
		$chr1310 = chr(13).chr(10);

		$linhas = array();

		$fatura = explode($chr1310,$aux);

		foreach ($fatura as $row) {
			$auxrow = explode($chr9,$row);
			array_push($linhas,$auxrow);
		}

		$retorno = md5(uniqid().$token);

		Excel::create($retorno, function($excel) use($linhas) {

	    	$excel->sheet('New sheet', function($sheet) use($linhas) {

	        	$sheet->loadView('gerenciamento.planilha2')->with('linhas',$linhas);

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


	public function pdf($fatura)
	{
	 	$fatenv = $fatura;
	 	$token = Session::get('token');	

	 	$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','GetPDFFactura',['Token'=>$token,'Factura'=>$fatenv]);

		if (isset($resultado->GetPDFFacturaResult)) {
			$pdfText = $resultado->GetPDFFacturaResult;
			header('Content-type: Application/Pdf');
			echo $pdfText;
		}else{
			return view('customerrors.nopdf');
		}
	}

	public function carregarFatura()
	{
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Gerenciamiento','Facturas',['Token'=>$token]);

		$rows = array();

		if (isset($resultado->FacturasResult)) {
			
		$aux = explode('^', $resultado->FacturasResult);
		array_pop($aux);

			foreach ($aux as $key) {
				$row = explode('#', $key);
				array_push($rows, $row);
			}		
		
		}else{
			$rows = [];
		}

		return view('gerenciamento.select-faturas')->with('faturas',$rows);
	}

}
