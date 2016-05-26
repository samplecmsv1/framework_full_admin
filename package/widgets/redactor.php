<?php
namespace package\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class redactor extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('redactor');
		$this->scriptLink[] = $baseUrl.'redactor.js';
		$this->cssLink[] = $baseUrl.'redactor.css';
		$this->script[] = "
			
				$('".$this->ele."').redactor({
					fixed: true
				});
			";
		
	}
	
}

 