<?php 
/**
 *  Copyright (C) 2019 email-validation-api.com
 *
 *  PHP version 7.2 and <
 *
 *  This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *  You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @category  API
 * @author    email-validation-api.com (api.email.validation@gmail.com)
 * @copyright 2019 email-validation-api.com
 * @license   http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @version   1.0
 * @link      https://email-validation-api.com/documentation/
 * 
 */
 
/*


	The following piece of code is an exemple of use of the service.

	
	include_once 'MasterClass_email-validation-api.com.php';
	$validation = new emailvalidationapi('YOUR_API_KEY', 'json', 'jeancharles@hotmail.com');
	echo $validation->performRequest();
	echo '<br/>';
	echo $validation->performRequest('jeanjaque@hotmail.com');
	

/**/

class emailvalidationapi { 
	
	protected $apiKey = ''; 
    public $lookupEmail = '';
    public $outputFormat = 'json';
	public $FormatsAllowed = ['json', 'xml', 'csv', 'serializedphp'];
	/*
		Constructor with optional parameters to set API Key, output format and lookup IP
		You can get an API Key for free on: http://ip-to-geolocation.com/ip-geolocation-api-register-0.html
		The paid plan gives unlimited requests
	*/
	public function __construct($key='', $format='json', $email='') {
        $this->setAPIKey($key);
        $this->setLookupEmail($email);
		$this->setOutputFormat($format);
    }
	/*
		Method to set an API Key to be used when requests are performed
		Parameter: API Key
		Return null
	*/
	public function setAPIKey($key){
		$this->apiKey = $key;
	}
	/*
		Method to set an IP address to lookup
		Parameter: IP address IPv4 or IPv6 
		return null
	*/
	public function setLookupEmail($email){
		if( !filter_var($email, FILTER_VALIDATE_EMAIL ) ) throw new Exception('The Email address is not well formated');
		$this->lookupEmail = $email;
	}
	/*
		Method to set an output format to be returned by the request
		Parameter: format type, one from the list 
		return null
	*/
	public function setOutputFormat($format){
		if( !in_array($format, $this->FormatsAllowed) ) throw new Exception('The output format requested ('.$format.') is not included in the formats list supported ('.implode(',', $this->FormatsAllowed).')');
		$this->outputFormat = $format;
	}
	/*
		Method to perform a request
		Parameter: (optional) IP address to lookup
		return: String, the geolocation in the format desired or json by default
		for more details, check out the documentation: https://ip-to-geolocation.com/documentation/
	*/
	public function performRequest($email=null){
		if( $email!=null ){
			$this->setLookupEmail($email);
		}
		if( $this->apiKey=="" ) throw new Exception('The API Key has not been set. (Method to use: setAPIKey("123...") )');
		if( $this->lookupEmail=="" ) throw new Exception('The Email address to lookup has not been set. (Method to use: setLookupEmail("user@domain.com") )');
		$plainTextOutput = file_get_contents('http://email-validation-api.com/api/'.$this->outputFormat.'/?key='.$this->apiKey.'&email='.$this->lookupEmail);
		return $plainTextOutput;
	}
	
}





	










?>