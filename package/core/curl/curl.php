<?php namespace core\curl;

class curl {
 	static $obj;
 	/** 
 	*	静态方法实现
 	*/ 
 	public static function __callStatic($name, $arguments) 
    {    
    	static::$obj = new lib;    
    	return call_user_func_array( array(static::$obj , $name) , $arguments);  
    } 
 	 
 	  
}
