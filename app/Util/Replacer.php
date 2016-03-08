<?php namespace App\Util;

class Replacer 
{
	
	public function replace($str)
	{
		$str = str_replace('#','', $str);
		$str = str_replace('^','', $str);
		$str = str_replace('$','', $str);
		$str = str_replace(';','', $str);

		return $str;
	}

}
