<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Util\ExamFinder as ExamFinder;
use App\Util\Replacer as Replacer;

class AjaxRegistroController extends Controller {

	public function adicionarPaciente(Request $request)
	{	

		$token = Session::get('token');
		$cliente = Session::get('cliVinculado');
		$nome = $request->input('nome');
		$sobrenome = $request->input('sobrenome');
		$dataNascimento = $request->input('dataNascimento');
		$sexo = $request->input('sexo');
		$referenciaInterna = $request->input('referenciaInterna');
		$numeroEtiquetas = $request->input('numeroEtiquetas');
		$nhc = $request->input('nhc');
		$medicoSolicitante = $request->input('medicoSolicitante');
		$local = $request->input('local');
		$exames = $request->input('exames');
		$editPet = '';

		//Apagar Caracteres Especiais

		$rp = new Replacer;

		$nome = $rp->replace($nome);
		$sobrenome = $rp->replace($sobrenome);
		$referenciaInterna = $rp->replace($referenciaInterna);
		$numeroEtiquetas = $rp->replace($numeroEtiquetas);
		$nhc = $rp->replace($nhc);
		$medicoSolicitante = $rp->replace($medicoSolicitante);
		$local = $rp->replace($local);		

		//Fim apagar caracteres especiais

		//Validar exames

			$valexames = explode('^', $exames);
			array_shift($valexames);
			$examesUsados = array();
			foreach ($valexames as $aux) {
				$aux = $aux.'$';
				$auxvalexam = explode('$', $aux);
				$exame = $auxvalexam[0];
				array_push($examesUsados, $exame);				
			}
			$ef = new ExamFinder;
			$ef->validarExames($examesUsados);

		//Fim Validar exames

		$validator = Validator::make(
			[
				'nome' => $nome,
				'sobrenome' => $sobrenome,
				'dataNascimento' => $dataNascimento,
				'sexo' => $sexo,
				'referenciaInterna' => $referenciaInterna,
				'exames' => $exames			
			],
			[
				'nome' => 'required',
				'sobrenome' => 'required',
				'dataNascimento' => 'required|date_format:d/m/Y',
				'sexo' => 'required|in:1,2,3',
				'referenciaInterna' => 'required',
				'exames' => 'required'			
			]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{
			if (Session::has('editPet')) {
				$editPet = Session::get('editPet');
				Session::forget('editPet');
			}
			$pedido = $cliente.'#'.$nome.'#'.$sobrenome.'#'.$dataNascimento.'#'.$sexo.'#'.$referenciaInterna.'#'.$numeroEtiquetas.'#'.$nhc.'#'.$medicoSolicitante.'#'.$local.'#'.$editPet.$exames;

			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Registro','InsertPet',['Peticion'=>$pedido,'Token' => $token]);

			if (isset($resultado->InsertPetResult)) {
				$retorno = '1';								
			}else{
				$retorno = '0';			
			}
	    }	
	    return $retorno;
	}


	public function criarGrupo(Request $request)
	{
		
		$token = Session::get('token');
		$nome = $request->input('nome');
		$exames = $request->input('exames');

		//Apagar Caracteres Especiais

		$rp = new Replacer;

		$nome = $rp->replace($nome);			

		//Fim apagar caracteres especiais


		//Validar exames

			$valexames = explode('#', $exames);
			array_pop($valexames);
			$examesUsados = $valexames;			
			$ef = new ExamFinder;
			$ef->validarExames($examesUsados);

		//Fim Validar exames

		$validator = Validator::make(
		[
			'nome' => $nome,
			'exames' => $exames,			
		],
		[
			'nome' => 'required',
			'exames' => 'required',			
		]
		);

		if ($validator->fails()) {
			$retorno = '0';
		}else{
			$sm = new SoapManager;

			$resultado = $sm->execute('LNLink.Catalogo','CreaGrupo',['Grupo'=>$nome,'Pruebas' => $exames, 'Token'=>$token]);

			if (isset($resultado->CreaGrupoResult)) {
				$retorno = $resultado->CreaGrupoResult;
			}else{
				$retorno = '0';
			}	
		}		
		return $retorno;
	}


	public function excluirGrupo(Request $request)
	{
		
		$token = Session::get('token');
		$nome = $request->input('nome');		

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','CreaGrupo',['Grupo'=>$nome, 'Token'=>$token]);

		return $resultado->CreaGrupoResult;	
	}


	public function listarGrupos(Request $request) 
	{
		
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','GetGrupos',['Token'=>$token]);

		if (!isset($resultado->GetGruposResult)) {
			Session::put('gln','0');			
			$grupos = '0';
			$exames = '0';

		}else{
			Session::put('gln',$resultado->GetGruposResult);	
			$aux = $resultado->GetGruposResult;

			$aux2 = explode('^',$aux);
			array_pop($aux2);

			$grupos = array();
			$examesUsados = array();

			foreach ($aux2 as $row) {
			$grupo = explode('#',$row);
			array_push($grupos, $grupo);	
		}		

		foreach ($grupos as $row) {
			$i = 0;

			foreach ($row as $exame) {
				if ($i > 0) {
					array_push($examesUsados, $exame);
				}
				$i = 1;
			}
		}

		$ef = new ExamFinder;
		$exames = $ef->find($examesUsados);

		}

		return view('registro.manual-grupos')->with('grupos',$grupos)->with('exames',$exames);

	}	


	public function listarPedidos(Request $request)
	{
		$pacientes = array();
		
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Registro','Peticiones',['Token'=>$token]);

		if (isset($resultado->PeticionesResult)) {
			
		$aux = $resultado->PeticionesResult;

		$aux = explode('^', $aux);
		array_pop($aux);

			foreach ( $aux as $row) {
				$paciente = explode('#', $row);
				$auxExames = array_pop($paciente);
				utf8_encode($auxExames);
				$exames = explode('$', $auxExames);
				array_pop($exames);
				$paciente['exames'] = $exames;
				$paciente['count'] = count($exames);
				array_push($pacientes, $paciente);
			}

		Session::put('pcount',count($aux));

		}else{
			$pacientes = '0';
			Session::put('pcount',0);
		}		

		return view('registro.manual-pedidos')->with('pacientes',$pacientes);		
	}	

}
