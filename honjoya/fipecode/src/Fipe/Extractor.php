<?php
namespace Fipe;

class Extractor{

	/**
	* Method extract all select value and Text
	* 
	* @param SplObjectStorage $storage 
	* @param String $elementID
	* @param DomDocument $domDocument
	*
	* @return SplObjectStorage
	*/
	public static function fromTagSelect(\SplObjectStorage $storage, $elementID ,\DomDocument  $domDocument){
		
		if(!$domDocument){
			return $storage;
		}
		
	    $domElement = $domDocument->getElementById($elementID);
	
		if($domElement == null || $storage == null){
			return $storage;
		}
		
		foreach($domElement->getElementsByTagName('option') as $option){
			$storage->attach(new ObjectRequested($option->getAttribute('value'), $option->textContent));
		}
		
		return $storage;
	}
    
    /**
    * Method perform the parse of cotation
    * @param \DomDocument
    * @return array
    */
    public static function cotation(\DomDocument $domDocument){
    	$arrayKeys = array(
    		'lblCodFipe' => 'codigo_tabela_fipe',
    		'lblMarca' => 'marca',
    		'lblModelo' => 'modelo',
    		'lblAnoModelo' => 'ano_modelo',
    		'lblValor' => 'valor_medio',
    		'lblReferencia' => 'mes_referencia'
    	);

    	$response = array();

    	foreach ($arrayKeys as $key => $name) {
    		$documentElement = $domDocument->getElementById($key);
    		if($documentElement){
        		$response[$name] = $documentElement->textContent;
        	}
    	}

    	return $response;
    }
}
