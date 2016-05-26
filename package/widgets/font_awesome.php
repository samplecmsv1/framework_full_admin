<?php
namespace package\widgets;
/**  
 * 
 * @author SUN KANG
 *
 */
 
class  font_awesome extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('Font-Awesome-4.6.3');
		 
		$this->cssLink[] = $baseUrl.'css/font-awesome.css';
		 
		
	}
	
}

 