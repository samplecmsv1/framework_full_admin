<?php
namespace package\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class bootstrap extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('bootstrap');
		$this->scriptLink[] = $baseUrl.'js/bootstrap.js';
		$this->cssLink[] = $baseUrl.'css/bootstrap.css';
		

		/*$this->script[] = "
			
				$('".$this->ele."').redactor({
					fixed: true
				});
			";*/
		
	}
	
}

 