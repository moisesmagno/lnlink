<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ArquivoIntegracaoRequest as ArquivoIntegracaoRequest;

use Illuminate\Http\Request;

class AjaxRegistroIntegracaoController extends Controller {

	public function listarArquivosIntegradosHoje()
	{
		
		$arquivos = array();
		
		$token = Session::get('token');
		$inicial = date("d/m/Y");
		$final = date("d/m/Y");

		$validator = Validator::make(
			[
				'inicial' => $inicial,
				'final' => $final,						
			],
			[
				'inicial' => 'required|date_format:d/m/Y',
				'final' => 'required|date_format:d/m/Y',						
			]
		);

		if ($validator->fails()) {
			$arquivos = '0';
		}else{
			$param = [				
				'FecIni'=> $inicial,
				'FecFin'=> $final,					
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Integrados','Ficheros',$param);

			if (isset($resultado->FicherosResult)) {
				$aux = $resultado->FicherosResult;
				$auxFile = explode('^', $aux);
				array_pop($auxFile);

				foreach ($auxFile as $key) {
					$arquivo = explode('#', $key);
					array_push($arquivos, $arquivo);
				}

			}else{
				$arquivos = '0';
			}
		}
		
		return view('registro.integracao-integrados-hoje')->with('arquivos',$arquivos);
	}


	public function listarArquivosIntegradosData(Request $request)
	{
		
		$arquivos = array();
		
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');

		$validator = Validator::make(
			[
				'inicial' => $inicial,
				'final' => $final,						
			],
			[
				'inicial' => 'required|date_format:d/m/Y',
				'final' => 'required|date_format:d/m/Y',						
			]
		);

		if ($validator->fails()) {
			$arquivos = '0';
		}else{
			$param = [				
				'FecIni'=> $inicial,
				'FecFin'=> $final,					
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Integrados','Ficheros',$param);

			if (isset($resultado->FicherosResult)) {
				$aux = $resultado->FicherosResult;
				$auxFile = explode('^', $aux);
				array_pop($auxFile);

				foreach ($auxFile as $key) {
					$arquivo = explode('#', $key);
					array_push($arquivos, $arquivo);
				}

			}else{
				$arquivos = '0';
			}
		}

		return view('registro.integracao-integrados-data')->with('arquivos',$arquivos);
	}


	public function uploadIntegracao(ArquivoIntegracaoRequest $request)
	{
			
		$file = $request->file('arquivoIntegracao');
		$token = Session::get('token');

		$name = $file->getClientOriginalName();
		$exp = explode('.', $name);
		$exp = array_pop($exp);

		$validator = Validator::make(
			[
			'exp' => $exp,
			
			],
			[
			'exp' => 'in:txt,TXT,xml,xls,csv,hl7,HL7',			
			]
		);

		if(!$validator->fails()){

			$content = file_get_contents($file->getPathName());

			$sm = new SoapManager;
			$resultado = $sm->execute('LNLink.Integrados','UpFile',['Token'=>$token,'File' => $content,'FileName' =>$name]);

			if (isset($resultado->UpFileResult)) {
				$retorno = $resultado->UpFileResult;
				if ($retorno == '[OK]') {
					Session::flash('arqenv','1');
					return redirect('/registro/integracao');
				}else{
					Session::flash('failenv','0');
					return redirect('/registro/integracao');
				}
				
			}else{
				Session::flash('failenv','0');
				return redirect('/registro/integracao');
			}

		}else{
			Session::flash('failext','0');
				return redirect('/registro/integracao');
		}
	}

}
