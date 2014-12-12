<?php
namespace Fipe;

class ObjectRequested {

	public $id;
	public $nome;
	
	public function __construct($id, $nome)
	{
		$this->id = $id;
		$this->nome = $nome;
	}
}