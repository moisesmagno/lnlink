<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class Lista {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Session::get('lista') != '9000;1') {

			return redirect('/'.trans('consulta'));
			
		}

		return $next($request);
	}

}
