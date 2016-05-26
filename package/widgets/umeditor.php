<?php
namespace package\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class umeditor extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('umeditor');
		
		
		$str = '<script id="container" class="editor" name="content" type="text/plain"><span class="start_content">这里写你的初始化内容</span></script>';

		$this->cssLink[] = $baseUrl.'themes/default/css/umeditor.min.css';
		$this->scriptLink[] = $baseUrl.'umeditor.config.js';
		$this->scriptLink[] = $baseUrl.'umeditor.min.js';
		$this->scriptLink[] = $baseUrl.'lang/zh-cn/zh-cn.js';


		$this->script[] = "
			 
        	window.um = UM.getEditor('".$this->ele."', {
					 toolbar: ['source bold italic underline strikethrough | orecolor backcolor | removeformat |',
		            'fontfamily fontsize' ,
		            '| justifyleft justifycenter justifyright justifyjustify |',
		            'link unlink | image video  | map']
				});
			";
		
		echo $str;

	}
	
}

 