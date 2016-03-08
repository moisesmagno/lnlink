<?php namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;

class ValidateUser {

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
		
		return $next($request);
	}

}
