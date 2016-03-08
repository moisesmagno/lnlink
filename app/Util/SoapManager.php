<?php namespace App\Util;

use SoapClient;

class SoapManager 
{
	
	 function execute($webService, $method, $parameters)
    {
        $URL  = 'https://extranet.labconous.com/csp/lab/'.$webService.'.cls?wsdl=1';

		//CREATE THE CLIENT INSTANCE
        $client = new SoapClient($URL);
        $result = $client->__soapCall($method, array($parameters));
        return $result;
    }

}
