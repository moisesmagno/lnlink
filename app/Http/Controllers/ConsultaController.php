<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ConsultaController extends Controller {

	 public function __construct()
    {
        $this->middleware('validateToken');
        $this->middleware('consulta', ['only' => ['showIndex']]); 
        $this->middleware('incidencia', ['only' => ['showIncidencias']]);     
    }

	public function showIndex()
	{
	
		return view('consulta.index')->with('pageTitle',trans('pages.consulta'));
	}

	public function showIncidencias()
	{
		return view('consulta.incidencias')->with('pageTitle',trans('pages.incidencias'));
	}

}
