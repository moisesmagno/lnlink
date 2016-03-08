<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AjaxConsultaIncidenciasController extends Controller {

	public function incidenciasNous(Request $request)
	{
		
		$token = Session::get('token');
		$tipo = $request->input('tipo');

		$validator = Validator::make(
			[
				'tipo' => $tipo,			
			],
			[
				'tipo' => 'required|in:1,2',			
			]
		);

		if ($validator->fails()) {
			$incidencias = '0';
		}else{
			if ($tipo == '1') {
				$tipo = 'Interna';
			}
			if ($tipo == '2') {
				$tipo = 'Externa';
			}

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Incidencias','Incidencias',['Token'=>$token,'Tipo'=>$tipo]);

			$incidencias = array();

			if (isset($resultado->IncidenciasResult)) {
				$aux = explode('^', $resultado->IncidenciasResult);
				array_pop($aux);
				foreach ($aux as $row) {
					$incidencia = explode("#", $row);
					array_push($incidencias, $incidencia);
				}
			}else{
				$incidencias = '0';
			}
		}
		return view('consulta.incidencias-resultados')->with('incidencias',$incidencias)->with('tipo',$tipo);
	}


	//Enviar comentário.
	public function enviarComentario(Request $request)
	{
		$token = Session::get('token');
		$desc = $request->input('desc');
		$pet = $request->input('pet');
		$exam = $request->input('exam');

		// $sm = new SoapManager;

		// $resultado = $sm->execute('LNLink.Incidencias','Comentario',['Token'=>$token,'Comentario'=>$desc,'Prueba'=>$exam,'Peticion'=>$pet]);

		// if (isset($resultado->ComentarioResult)) {
		// 	$retorno = $resultado->ComentarioResult;
		// }else{
		// 	$retorno = '0';
		// }

		// return $retorno;

		return '1';
	}
}
