<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Util\SoapManager as SoapManager;
use Illuminate\Http\Request;

class CatalogoController extends Controller {

	 public function __construct()
    {
       $this->middleware('catalogo', ['only' => ['showExame','showIndex','showLista']]); 
       $this->middleware('validateToken');     
    }


	public function showExame($cod)
	{
		$token = Session::get('token');			

		$sm = new SoapManager;		

		$resultado = $sm->execute('LNLink.Catalogo','GetPrueba',['Token'=>$token,'Prueba'=>$cod]);

		if (isset($resultado->GetPruebaResult)) {
			$exame = explode('#', $resultado->GetPruebaResult);
			$exame['links'] = explode('^', $exame[23]);	
			array_pop($exame['links']);	
		}else{
			abort(404);
		}

		return view('catalogo.exame')->with('pageTitle',trans('pages.exame'))->with('exame',$exame);
	}


	public function showIndex()
	{	

		$token = Session::get('token');	
		$espcli = 'Todos';

		$sm = new SoapManager;

		//EspLab
		$resultado = $sm->execute('LNLink.Catalogo','EspLab',['Token'=>$token,'EspCli'=>$espcli]);

		if (isset($resultado->EspLabResult)) {
			$esplab = explode('^', $resultado->EspLabResult);
			array_pop($esplab);
		}else{
			$esplab = '0';
		}

		//EspCli
		$resultado = $sm->execute('LNLink.Catalogo','EspCli',['Token'=>$token,'EspLab'=>'Todos']);

		if (isset($resultado->EspCliResult)) {
			$espcli = explode('^', $resultado->EspCliResult);
			array_pop($espcli);
		}else{
			$espcli = '0';
		}

		//Amostra

		$resultado = $sm->execute('LNLink.Catalogo','Muestras',['Token'=>$token]);

		if (isset($resultado->MuestrasResult)) {
			$amostras = explode('^', $resultado->MuestrasResult);
			array_pop($amostras);
		}else{
			$amostras = '0';
		}

		return view('catalogo.index')->with('pageTitle',trans('pages.catalogo'))->with('esplab',$esplab)->with('espcli',$espcli)->with('amostras',$amostras);
	}

	public function showLista()
	{	
		return view('catalogo.lista')->with('pageTitle',trans('pages.lista'));
	}	

}
