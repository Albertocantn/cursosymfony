<?php
 namespace AppBundle\Twig;

 class HelperVistas extends \Twig_Extension {


    public function getFunctions(){


    	return array('generateTable' => new \Twig_Function_Method($this,'generateTable'));
    }


    public function generateTable($array){

    	$table="<table class='table' border='1' >";

for ($i=0; $i <count($array); $i++) { 
    
     $table.="<tr>";

	for ($j=0; $j<count($array[$i]); $j++) { // EL DOS ES POR EL NUMERO DE CAMPOS QUE TIENE CADA UNO DE LOS ARRAYS

		// CONVERTIR UN ARRAY ASOCIATIVO EN UN ARRAY CON INDICES NUMERICOS
		$array_numerico=array_values($array[$i]);

		// FIN DE LA CONVERSION

		$table.="<td>".$array_numerico[$j]."</td>";

		
	}

      $table.="</tr>";


	}

	$table.="</table>";

	return $table;


    }

 	public function getName(){

 		return "AppBundle";
 	}



 }