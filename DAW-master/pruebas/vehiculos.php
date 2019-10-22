<?php
class Coche{
	private $ruedas;
	var $color;
	var $motor;

	//Constructor
	function Coche(){ 
		$this->ruedas=4;
		$this->color="";
		$this->motor=1600;
	}

	function getRuedas(){
		return $ruedas;
	}

	function setRuedas($ruedas){
		$this->ruedas = $ruedas;
		echo "Ahora tiene " . $this->ruedas . " ruedas";
	}

	function arrancar(){
		echo "Arrancando...<br>";
	}

	function girar(){
		echo "Girando...<br>";
	}

	function frenar(){
		echo "Frenando...<br>";
	}

	function estableceColor($color){
		$this->color = $color;

		echo "El color se ha cambiado a $color";
	}
}

class Camion extends Coche{
	

	//Constructor
	function Camion(){ 
		$this->ruedas=8;
		$this->color="";
		$this->motor=2000;
	}

	function arrancar(){
		parent::arrancar(); //Llama al arrancar de la super clase
	}
	
}

?>