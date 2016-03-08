<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Util\SoapManager as SoapManager;

use Illuminate\Http\Request;

class LogisticaController extends Controller {

	 public function __construct()
    {          
        $this->middleware('logistica', ['only' => ['showIndex']]); 
        $this->middleware('validateToken');   
    }

	public function showIndex()
	{	
		$token = Session::get('token');			

		$sm = new SoapManager;		

		$resultado = $sm->execute('LNLink.Logistica','Materiales',['Token'=>$token]);
		$materiais = array();
		$units = array();

		if (isset($resultado->MaterialesResult)) {		

			$aux = explode('^', $resultado->MaterialesResult);
			array_pop($aux);

			foreach ($aux as $row) {
				$aux2 = explode('#', $row);
				array_push($materiais, $aux2[1]);
				array_push($units, $aux2[2]);
			}

		}else{
			$materiais = '0';
			$units = '0';
		}		

		return view('logistica.index')->with('pageTitle',trans('pages.logistica'))->with('materiais',$materiais)->with('units',$units);
	}

}
