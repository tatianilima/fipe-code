<?php

namespace Fipe;

class FormViewState {

public $viewState;
	public $lastFocus;
	public $eventArgument;
	public $viewStateGgenerator;
	public $eventValidation;

	/**
	* Method lookfor the views params
	*/
	public function initialize(\DomDocument $domDocument){
	
		$viewState = $domDocument->getElementById('__VIEWSTATE');
		if($viewState){
			$this->viewState = $viewState->getAttribute('value');
		}

		$lastFocus = $domDocument->getElementById('__LASTFOCUS');
		if($lastFocus){
			$this->lastFocus = $lastFocus->getAttribute('value');
		}

		$eventArgument = $domDocument->getElementById('__EVENTARGUMENT');
		if($eventArgument){
			$this->eventArgument = $eventArgument->getAttribute('value');
		}

		$viewStateGgenerator = $domDocument->getElementById('__VIEWSTATEGENERATOR');
		if($viewStateGgenerator){
			$this->viewStateGgenerator = $viewStateGgenerator->getAttribute('value');
		}
		
		$eventValidation =  $domDocument->getElementById('__EVENTVALIDATION');
        
		if($eventValidation){
			$this->eventValidation = $eventValidation->getAttribute('value');
		}
		
	}
}