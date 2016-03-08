<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class IsValidated {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if (Session::has('email')) {
			
			return redirect('/'.trans('routes.consulta'));

		}

		return $next($request);
	

	}

}
