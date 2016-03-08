<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class Consulta {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Session::get('consulta') != '1000;1') {
			
			if (Session::get('regManual') == '3000;1') {
				
				return redirect(trans('routes.registro').'/'.trans('routes.manual'));

			}elseif (Session::get('catalogo') == '6000;1') {
				
				return redirect(trans('routes.catalogo'));

			}elseif(Session::get('logistica') == '7000;1'){

				return redirect(trans('routes.logistica'));

			}elseif(Session::get('gerenciamento') == '8000;1'){

				return redirect(trans('routes.gerenciamento'));

			}else{

				abort(404);

			}

		}			

		return $next($request);
	}

}
