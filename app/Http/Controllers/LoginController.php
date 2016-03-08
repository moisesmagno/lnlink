<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Util\SoapManager as SoapManager;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest as LoginRequest;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {


	 public function __construct()
    {
        $this->middleware('isValidated', ['only' => ['showIndex','login']]);   
    }

	public function showIndex()
	{	

		return view('login.index')->with('pageTitle','Login');
	}

	public function login(LoginRequest $request)
	{	

		$email = $request->input('email');
		$password = $request->input('password'); 		

		$param = [
            'Username' => $email,
            'Password' => $password
		];

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Validacion','ValidateUser',$param);

		if ($resultado->ValidateUserResult == '0') {
			Session::flash('loginerror',1);
			return redirect('/');

		}else{
		
		$aux = explode('#', $resultado->ValidateUserResult);		

			Session::put('status',$aux[0]);
			Session::put('usuario', $aux[1]); //
			Session::put('cliVinculado',$aux[2]);
			Session::put('codPais',$aux[3]);
			Session::put('lang',$aux[4]);
			Session::put('token',$aux[5]);
		
		$aux2 = explode('|',$aux[6]);

			Session::put('consulta',$aux2[0]);
			Session::put('incidencia',$aux2[1]);
			Session::put('regManual',$aux2[2]);
			Session::put('regIntegracao',$aux2[3]);
			Session::put('regConsulta',$aux2[4]);
			Session::put('catalogo',$aux2[5]);
			Session::put('logistica',$aux2[6]);
			Session::put('gerenciamento',$aux2[7]);
			Session::put('relGestaoPerformance',$aux2[8]);
			Session::put('evoDiverParamRemMes',$aux2[9]);
			Session::put('comprimentoPrazo',$aux2[10]);
			Session::put('ocorrenciaOrigemMes',$aux2[11]);
			Session::put('evoAtivRem',$aux2[12]);
			Session::put('relFinanceiros',$aux2[13]);
			Session::put('faturaConExam',$aux2[14]);
			Session::put('conFaturaMes',$aux2[15]);
			Session::put('lista',$aux2[16]);
			Session::put('bandeja',$aux2[17]);
			Session::put('email',$email);			

			return redirect('/'.trans('routes.consulta'));
		}
	}
	
}
