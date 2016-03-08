<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AjaxLogisticaController extends Controller {

	public function __construct()
    {       
        $this->middleware('validateUser', ['only' => ['getDocs','gerarlote']]);            
    }

	public function getDocs($doc)
	{
		
		$token = Session::get('token');

		$validator = Validator::make(
		[
			'doc' => $doc,			
		],
		[
			'doc' => 'required|in:Genetica,General',			
		]
		);	

		if ($validator->fails()) {
			return view('customerrors.nopdf');
		}else{

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Logistica','GetDocs',['Token'=>$token,'Documento'=>$doc]);

			if (!empty($resultado->GetDocsResult)) {

				$pdfText = $resultado->GetDocsResult;
				header('Content-type: Application/Pdf');
				echo $pdfText;

			}else{

				return view('customerrors.nopdf');

			}
	    }	
	}


	public function gerarlote()
	{
		$data = date('YmdHis');

		return $data;
	}


	public function enviarMaterial(Request $request)
	{
		
		$token = Session::get('token');
		$material = $request->input('envio');

		$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Logistica','EnvioMaterial',['Token'=>$token,'Material'=>$material]);

			if (!empty($resultado->EnvioMaterialResult)) {

				$retorno = $resultado->EnvioMaterialResult;								

			}else{

				$retorno = 'erro';				

			}

		return $retorno;	
	}

	
	public function solicitarMaterial(Request $request)
	{
		$token = Session::get('token');
		$material = $request->input('envio');

		$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Logistica','SolicitudMaterial',['Token'=>$token,'Materiales'=>$material]);

			if (!empty($resultado->SolicitudMaterialResult)) {

				$retorno = $resultado->SolicitudMaterialResult;								

			}else{

				$retorno = 'erro';				

			}
		return $retorno;		
	}


}
