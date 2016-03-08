<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Util\ExamFinder as ExamFinder;

class RegistroController extends Controller {

	 public function __construct()
    {        
        $this->middleware('bandeja', ['only' => ['showBandeja']]); 
        $this->middleware('regConsulta', ['only' => ['showConsulta']]);
        $this->middleware('regIntegracao', ['only' => ['showIntegracao']]); 
        $this->middleware('regManual', ['only' => ['showManual']]);  
        $this->middleware('validateToken');   
    }

	public function showBandeja()
	{	
		return view('registro.bandeja')->with('pageTitle',trans('pages.bandeja'));
	}

	public function showConsulta()
	{
		return view('registro.consulta')->with('pageTitle',trans('pages.consultaEnviados'));
	}

	public function showIntegracao()
	{
		return view('registro.integracao')->with('pageTitle',trans('pages.integracao'));
	}

	public function showManual()
	{

		$genPet = '0';
		$gln = Session::get('gln');
		$lln = Session::get('lln');
		$ef = new ExamFinder;

		if (Session::has('editPet')) {
			Session::forget('editPet');
		}

		if (Session::has('genPet')) {
			$auxGenPet = Session::get('genPet');
			$examesGenPet = explode(',', $auxGenPet);
			$genPet = $ef->findGenPet($examesGenPet);
			Session::forget('genPet');
		}

		if ($gln == '0') {

			$grupos = '0';
			$exames = '0';
			
		}else{

			$aux2 = explode('^',$gln);
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
			
			$exames = $ef->find($examesUsados);		

		}

		if ($lln == '0') {
			$listaExames = '0';
		}else{
			$auxLista = explode('#', $lln);			
			$listaExames = $ef->find($auxLista);
		}
		return view('registro.manual')->with('pageTitle',trans('pages.manual'))->with('grupos',$grupos)->with('exames',$exames)->with('listaExames',$listaExames)->with('genPet',$genPet);
	}


}
