<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AjaxRegistroConsultaController extends Controller {

	public function listar(Request $request)
	{
		
		$pacientes= array();
		
		$token = Session::get('token');
		$inicial = $request->input('dtInicial');
		$final = $request->input('dtFinal');
		$tipo = $request->input('tipo');	                      

		

		$validator = Validator::make(
			[
				'inicial' => $inicial,
				'final' => $final,
				'tipo' => $tipo,			
			],
			[
				'inicial' => 'required|date_format:d/m/Y',
				'final' => 'required|date_format:d/m/Y',
				'tipo' => 'required|in:1,2',			
			]
		);

		if ($validator->fails()) {
			$pacientes = '0';
		}else{

			$param = [				
				'FecIni'=> $inicial,
				'FecFin'=> $final,					
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Registro','PeticionesPreanalitica',$param);
			//dd($resultado);

			if (isset($resultado->PeticionesPreanaliticaResult)) {
				$aux = $resultado->PeticionesPreanaliticaResult;
				$aux = explode('^', $aux);
				array_pop($aux);

				foreach( $aux as $row) {
					$paciente = explode('#', $row);
					$auxExames = array_pop($paciente);
					utf8_encode($auxExames);
					$exames = explode('$', $auxExames);
					array_pop($exames);
					$paciente['exames'] = $exames;
					$paciente['count'] = count($exames);
					array_push($pacientes, $paciente);
				}		

				}else{
					$pacientes = '0';
				}

		}		

		return view('registro.consulta-resultados')->with('pacientes',$pacientes)->with('tipo',$tipo);	
	}


	public function imprimirResultados($dti,$dtf)
	{

		$inicial = str_replace('-', '/',$dti);
		$final = str_replace('-', '/',$dtf);	

		$pacientes= array();
		
		$token = Session::get('token');

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
			$pacientes = '0';
		}else{

			$param = [				
				'FecIni'=> $inicial,
				'FecFin'=> $final,					
				'Token'=> $token,
			];

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Registro','PeticionesPreanalitica',$param);

			if (isset($resultado->PeticionesPreanaliticaResult)) {
				$aux = $resultado->PeticionesPreanaliticaResult;
				$aux = explode('^', $aux);
				array_pop($aux);

			foreach( $aux as $row) {
				$paciente = explode('#', $row);
				$auxExames = array_pop($paciente);
				utf8_encode($auxExames);
				$exames = explode('$', $auxExames);
				array_pop($exames);
				$paciente['exames'] = $exames;
				$paciente['count'] = count($exames);
				array_push($pacientes, $paciente);
			}		

			}else{
				$pacientes = '0';
			}
		}
		return view('pdfs.consulta-resultados')->with('pacientes',$pacientes);		
	}

}
