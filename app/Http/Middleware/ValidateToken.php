<?php namespace App\Http\Middleware;
use App\Util\SoapManager as SoapManager;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class ValidateToken {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!(Session::has('email') AND Session::has('token'))) {
			
			Session::flush();			
			return redirect('/');

		}

		$param = [
            'Username' => Session::get('email'),
            'Token' =>  Session::get('token')
		];

		$sm = new SoapManager;
		$resultado = $sm->execute('LNLink.Validacion','ValidateToken',$param);

		if ($resultado->ValidateTokenResult == '0') {

			Session::flush();			
			return redirect('/');

		}

		if (!Session::has('eln')) {

			$resultado = $sm->execute('LNLink.Catalogo','ListaPruebas',['Token'=>$param['Token']]);
			
			Session::put('eln',$resultado->ListaPruebasResult);

		}

		if (!Session::has('gln')) {

			$resultado = $sm->execute('LNLink.Catalogo','GetGrupos',['Token'=>$param['Token']]);

			if (isset($resultado->GetGruposResult)) {
				Session::put('gln',$resultado->GetGruposResult);
			}else{
				Session::put('gln','0');
			}			

		}	

		if (!Session::has('lln')) {

			$resultado = $sm->execute('LNLink.Catalogo','GetLista',['Token'=>$param['Token']]);
			
			if (isset($resultado->GetListaResult)) {
				if ($resultado->GetListaResult =='0') {
				Session::put('lln','0');
				Session::put('lcount',0);	
				}else{
					Session::put('lln',$resultado->GetListaResult);
					$aux = explode('#',	$resultado->GetListaResult);
					Session::put('lcount',count($aux));
				}
			}else{
				Session::put('lln','0');
				Session::put('lcount',0);
			}
		}

		if (!Session::has('pcount')) {

			$resultado = $sm->execute('LNLink.Registro','Peticiones',['Token'=>$param['Token']]);

			if (isset($resultado->PeticionesResult)) {
				$aux = explode('^',$resultado->PeticionesResult);
				array_pop($aux);
				Session::put('pcount',count($aux));
			}else{
				
				Session::put('pcount',0);
			}

		}



		return $next($request);
	}

}
