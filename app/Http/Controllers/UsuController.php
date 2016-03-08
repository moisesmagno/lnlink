<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlterarSenhaRequest as AlterarSenhaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Util\SoapManager as SoapManager;

use Illuminate\Http\Request;

class UsuController extends Controller {

	 public function __construct()
    {
        $this->middleware('validateToken', ['only' => ['showIndex','alterarSenha','logout']]);     
    }

	public function showIndex()
	{
	
		return view('outros.alterar-senha')->with('pageTitle',trans('pages.alterarsenha'));
	}

	public function alterarSenha(AlterarSenhaRequest $request)
	{
		
		$senhaatual = $request->input('senhaatual');
		$senhanova = $request->input('senhanova');

		$token = Session::get('token');
		$username = Session::get('email');		

		$sm = new SoapManager;

		$resultado = $sm->execute('LNLink.Validacion','ChangePass',['Username'=>$username,'Token'=>$token,'PasswordOld'=>$senhaatual,'PasswordNew'=>$senhanova]);	

		if (isset($resultado->ChangePassResult)) {
			if ($resultado->ChangePassResult == '1') {
				Session::flash('altsen','1');
				return redirect(trans('routes.alterarsenha'));
			}else{
				Session::flash('failsen','0');
				return redirect(trans('routes.alterarsenha'));
			}			
		}else{
			Session::flash('failsen','0');
			return redirect(trans('routes.alterarsenha'));
		}	
	}
	

	public function logout()
	{
		$token = Session::get('token');
		$sm = new SoapManager;
		$resultado = $sm->execute('LNLink.Validacion','CloseSession',['Token'=>$token]);

		if (isset($resultado->CloseSessionResult)) {
			if ($resultado->CloseSessionResult == '1') {
				Session::flush();
				return redirect('/');	
			}		
		}

	}

	public function alterarIdioma($idioma)
	{

		if (in_array($idioma, ['br','en','es','eslatam','fr'])) {
			Session::put('userlang',$idioma);
		}		
		
		return Redirect::back();

	}

}
