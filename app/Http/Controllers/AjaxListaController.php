<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Util\ExamFinder as ExamFinder;

use Illuminate\Http\Request;

class AjaxListaController extends Controller {

	public function listarExames()
	{		
		
		$token = Session::get('token');	

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','GetLista',['Token'=>$token]);

		if ($resultado->GetListaResult != '0') {

			Session::put('lln',$resultado->GetListaResult);			
			$aux = $resultado->GetListaResult;

			$examesLista = explode('#', $aux);
			
			$ef = new ExamFinder;
			$exames = $ef->find($examesLista);

			Session::put('lcount',count($examesLista));

		}else{
			Session::put('lln','0');	
			$exames = '0';
			Session::put('lcount',0);
		}				

		return view('catalogo.lista-exames')->with('exames',$exames);	

	}


	public function excluirExames(Request $request)
	{		
		
		$token = Session::get('token');	
		$aux = $request->input('exames');

		$exames = explode(',', $aux);
		array_pop($exames);
		$pruebas = '';

		foreach ($exames as $key) {
			
			$exame = '-'.$key.'#';
			$pruebas = $pruebas.$exame;			

		}

		$pruebas = substr($pruebas,0,-1);

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Catalogo','CreaLista',['Token'=>$token,'Pruebas'=>$pruebas]);

		$return = $resultado->CreaListaResult;
	}


	public function gerarPedido(Request $request)
	{
		$pedidos = $request->input('pedidos');
		$retorno = '0';

		if ($pedidos != '') {
			$pedidos = substr($pedidos,0,-1);
			Session::put('genPet',$pedidos);
			$retorno = '1';
		}
		
		return $retorno; 
	}


	public function atualizarCount()
	{
		$count = Session::get('lcount');
		return $count;
	}


	public function infoAdicional(Request $request)
	{
		$auxexames = $request->input('exames');
		$exames = explode('#', $auxexames);
		array_pop($exames);
		$emails = $request->input('emails');
		$desc = $request->input('desc');
		

		Mail::send('emails.informacao', ['exames' => $exames,'emails'=> $emails, 'desc' => $desc], function($message)
		{
		    
		    $cd = Session::get('codPais');

			switch($cd){
				case 55:
					//Brasil.
					$message->to('suportelab@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubINfAdiExa'));  
        		break;
        		case 51:
        			//Perú.
					$message->to('tatiana.velasquez@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubINfAdiExa'));
        		break;
        		case 57:
        			//Colombia.
					$message->to('sara.martinez@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubINfAdiExa'));
        		break;
        		case 52:
        			//Mexico.
					$message->to('monica.cubrira@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubINfAdiExa'));
        		break;
			}
		});
	}


	public function cotacoes(Request $request)
	{
		$auxexames = $request->input('exames');
		$exames = explode('^', $auxexames);
		array_pop($exames);
		$emails = $request->input('emails');
		$desc = $request->input('desc');		

		Mail::send('emails.cotacao', ['exames' => $exames,'emails'=> $emails, 'desc' => $desc], function($message)
		{
		    $cd = Session::get('codPais');

			switch($cd){
				case 55:
					//Brasil.
					$message->to('suportelab@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubCotExa'));
        		break;
        		case 51:
        			//Perú.
					$message->to('tatiana.velasquez@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubCotExa'));
        		break;
        		case 57:
        			//Colombia.
					$message->to('andres.hurtado@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubCotExa'));
        		break;
        		case 52:
        			//Mexico.
					$message->to('mara.olmos@labconous.com', 'LN-Link')->subject(trans('pages.LE-SubCotExa'));
        		break;
			}
		});
	}

}
