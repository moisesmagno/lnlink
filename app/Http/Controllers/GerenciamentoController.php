<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class GerenciamentoController extends Controller {

	 public function __construct()
    {
       $this->middleware('gerenciamento', ['only' => ['showRelatorio']]); 
       $this->middleware('validateToken');    
    }

	public function showRelatorio()
	{
		return view('gerenciamento.relatorio')->with('pageTitle',trans('pages.gerenciamento'));
	}

}
