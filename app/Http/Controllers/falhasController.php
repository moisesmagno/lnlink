<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FalhasController extends Controller {

	 public function __construct(){}

	public function noScript()
	{
	
		return view('outros.noscript')->with('pageTitle',trans('pages.noscipt'));
	}

}
