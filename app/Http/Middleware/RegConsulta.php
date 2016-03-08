<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class RegConsulta {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Session::get('regConsulta') != '5000;1') {

			return redirect('/'.trans('consulta'));
			
		}

		return $next($request);
	}

}
