<?php
namespace package\widgets;

 
class  editor extends base{
	
	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('editor.md');
		 
		$this->scriptLink[] = $baseUrl.'editormd.min.js';
		$this->cssLink[] = $baseUrl.'css/editormd.min.css';
		
		if(!$this->ele){
			return;
		}
 		$this->option['path'] = $baseUrl.'/lib/';
 		$op = $this->toJson($this->option);
 		
 		 
 			$js = '
				var editor'.$this->id.' = editormd("'.$this->ele.'", '.$op.');
			';
 		 
		$this->script[] = $js;
		
	}
	
}

 