<?php

namespace AppBundle\Twig;


class FilterVistas extends \Twig_Extension {

	public function getFilters(){

		return array( new \Twig_SimpleFilter("addText",array($this,'addText'))
			);
	}


public function addText($string,$numero){

return $string." texto añadido ".$numero;

}

public function getName(){

	return "filter_vista";
}



}