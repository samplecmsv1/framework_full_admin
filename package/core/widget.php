<?php
namespace core;
class widget{
	static $arr;
	static $namespace = "package\widgets\base";
	function start($name,$par){
		$core = self::$namespace;
		if(!class_exists($core)){
			return;
		}
		return $core::render($name,$par);
	}
	
	function render($types = ['css','js','js_code','css_code']){		
			static::before_render();
			foreach($types as $v){
				echo static::$arr[$v];
			}
		
	}
	
	function before_render(){
		$core = self::$namespace;

		if(!class_exists($core)){
			return;
		}
		
		$full = $core::$exists['_unique'];
		$full = $core::level($full);
		
		if(!$full){
			return;
		}
		foreach ($full as $obj){
			if($obj->scriptLink){
				foreach($obj->scriptLink as $v){
					$js .=  "<script type=\"text/javascript\" src='".$v."'></script>\n";
				}
			}
			if($obj->script){
				foreach($obj->script as $v){
					$jsCode .= $v."\n";
				}
			}
		
			if($obj->cssLink){
				foreach($obj->cssLink as $v){
					$css.="<link rel=\"stylesheet\" href=\"".$v."\">\n";
				}
			}
			if($obj->css){
				foreach($obj->css as $v){
					$cssCode .= $v."\n";
				}
			}
		
		}
		if($js){
			static::$arr['js'] = $js;
		}
		if($css){
			static::$arr['css'] = $css;
		}
		if($jsCode){
			$script = "<script type=\"text/javascript\">\n$(function(){\n";
			$script .=$jsCode;
			$script .="\n});\n</script>\n";
			static::$arr['js_code'] = $script;
		}
		
		if($cssCode){
			$script = "<style>\n";
			$script .= $cssCode;
			$script .="\n</style>\n";
			static::$arr['css_code'] = $script;
		}
	}
	
	
	
}