<?php
namespace package\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class tag extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('jQuery-Tags-Input');
		$this->scriptLink[] = $baseUrl.'src/jquery.tagsinput.js';
		$this->cssLink[] = $baseUrl.'src/jquery.tagsinput.css';
		
		$this->script[] = "
			
				$('".$this->ele."').tagsInput({
					width: 'auto',
					defaultText:'添加标签',
					//	autocomplete_url:'test/fake_json_endpoint.html'
				});
			";
		
		
	}
	
}

 