<?php
namespace Fipe;

class Parser{

	public static function toDomDocument($urlOrData){
		$domDocument = new \DomDocument();
		
		if(filter_var($urlOrData, FILTER_VALIDATE_URL)){
			@$domDocument->loadHtmlFile($urlOrData);
		}else{
			@$domDocument->loadHtml($urlOrData);
		}
		
		return $domDocument;
	}
}