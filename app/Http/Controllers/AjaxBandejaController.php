<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use App\Util\ExamFinder as ExamFinder;

use Illuminate\Http\Request;

class AjaxBandejaController extends Controller {

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

		return view('registro.bandeja-pedidos')->with('pacientes',$pacientes);		
	}

	public function excluirPedido(Request $request)
	{	
		Session::forget('editPet');
		
		$token = Session::get('token');	
		$pedido = $request->input('pedido');

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Registro','BorrarPet',['Token'=>$token,'IdPeticion'=>$pedido]);

		return $resultado->BorrarPetResult;

	}

	public function excluirPedidos(Request $request)
	{
		
		$token = Session::get('token');		

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Registro','BorrarTodas',['Token'=>$token]);

		return $resultado->BorrarTodasResult;

	}

	public function editarPedido(Request $request)
	{
		$token = Session::get('token');	
		$idPeticion = $request->input('pedido');
		$ef = new ExamFinder;

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Registro','GetPet',['Token'=>$token,'IdPeticion'=>$idPeticion]);

		if (isset($resultado->GetPetResult)) {
			$pedidoStr = $resultado->GetPetResult;
			$auxPedido = explode("^", $pedidoStr);
			$dataStr = array_shift($auxPedido);
			$pedido['exames'] = $auxPedido;
			$pedido['data'] = explode('#', $dataStr);
			$examesUsados = array();
			foreach ($pedido['exames'] as $exame) {
				$aux = explode('$', $exame.'$');
				array_push($examesUsados, $aux[0]);
			}
			$pedido['examesUsados'] = $ef->findGenPet($examesUsados);
			Session::put('editPet',$idPeticion);
			$retorno = view('registro.manual-editar-pedido')->with('pedido',$pedido);

		}else{
			$retorno = '0';
		}

		return $retorno;
	}

	public function cancelarAlteracoes()
	{
		Session::forget('editPet');
	}

	public function atualizarCount()
	{
		$count = Session::get('pcount');
		return $count;
	}


	public function enviarPedidos()
	{	
		$retorno = '0';

		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Registro','Peticiones',['Token'=>$token]);
		$pedidos = array();

		if (isset($resultado->PeticionesResult)) {
			
		$aux = $resultado->PeticionesResult;

		$aux = explode('^', $aux);
		array_pop($aux);

			foreach ( $aux as $row) {
				$pedido = explode('#', $row);				
				array_push($pedidos, $pedido);
			}

		$enviarPets = '';
		
			foreach ($pedidos as $pedido) {
						$enviarPets = $enviarPets.$pedido[0].',';		
					}

		$resultado = $sm->execute('LNLink.Registro','EnviaPets',['Token'=>$token,'Peticiones'=>$enviarPets]);
		
			if (isset($resultado->EnviaPetsResult)) {
				$retorno = $resultado->EnviaPetsResult;						
			}						

		}else{
			$retorno = '0';			
		}		

		return $retorno;
	}

}
