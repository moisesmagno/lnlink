<?php namespace App\Http\Middleware;

use Closure;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;



class Language {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Session::has('userlang')) {

			App::setLocale(Session::get('userlang'));
			
		}else{

			$idioma = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);

			$var = substr($idioma, 0, 2);

			switch($var){
				case 'pt': //Caso seja português
					App::setLocale('br');
					Session::put('userlang','br');
					break;
				case 'es': //Caso seja espanhol
					
					if($idioma == 'es' OR $idioma == 'es,es' OR $idioma == 'es-es' OR $idioma == 'es-ES'){
						App::setLocale('es');
						Session::put('userlang','es');
						break;	
					}else{
						App::setLocale('eslatam');
						Session::put('userlang','eslatam');
						break;	
					}	
				case 'en': //Caso seja inglês
					App::setLocale('en');
					Session::put('userlang','en');
					break;
				case 'fr': //Caso seja fraces
					App::setLocale('fr');
					Session::put('userlang','fr');
				break;
				default:
					App::setLocale('en');
					Session::put('userlang','en');
				break;
			}

		}	

		return $next($request);
	}

}
