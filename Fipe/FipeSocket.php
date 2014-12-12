<?php
namespace Fipe;

class FipeSocket{
	
	/**
	* This method perform a get request
	* @param String $host
	* @param String $path
	*
	* @return String;
	*/
	public static function get($host, $path = '/')
	{
		return self::exec($host, $path);
	}
	
	/**
	* This method perform a post request
	* @param String $host
	* @param String $path
	* @param Array $requestData
	*
	* @return String;
	*/
	public static function post($host, $path, $requestData = array()){
		return self::exec($host, $path, $requestData);
	}

	public static function exec($host, $path, $requestData = array())
	{
		$_err = 'lib sockets::'.__FUNCTION__.'(): ';
		
		$response = '';
		if(!empty($requestData)){
			$requestData = http_build_query($requestData);
		}else{
			$requestData = '';
		}
	   
		$fp = fsockopen($host, 80, $errno, $errstr, 60);
		
		if(!$fp){
			throw new \Exception($_err.$errstr.$errno); 
		}else {
			fputs($fp, "POST $path HTTP/1.1\r\n");
			fputs($fp, "Host: $host\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: ".strlen($requestData)."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $requestData."\r\n\r\n");       
			while(!feof($fp)) $response .= fgets($fp,4096);
			fclose($fp);
		} 
		return $response;
	}
}