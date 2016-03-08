<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
		'App\Http\Middleware\Language',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',		
		'isValidated' => 'App\Http\Middleware\IsValidated',
		'validateToken' => 'App\Http\Middleware\ValidateToken',
		'validateUser' => 'App\Http\Middleware\ValidateUser',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',

		//FiltroPaginas
		'bandeja' => 'App\Http\Middleware\Bandeja',
		'consulta' => 'App\Http\Middleware\Consulta',
		'catalogo' => 'App\Http\Middleware\Catalogo',
		'gerenciamento' => 'App\Http\Middleware\Gerenciamento',
		'incidencia' => 'App\Http\Middleware\Incidencia',
		'lista' => 'App\Http\Middleware\Lista',
		'logistica' => 'App\Http\Middleware\Logistica',
		'regConsulta' => 'App\Http\Middleware\RegConsulta',
		'regIntegracao' => 'App\Http\Middleware\RegIntegracao',
		'regManual' => 'App\Http\Middleware\RegManual',	

	];

}
