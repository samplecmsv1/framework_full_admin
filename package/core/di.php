<?php
namespace core;

use Pimple\Container;

class di{


	static $container;

	public static function set($name,$c){
		self::init()[$name] = $c;
	}

	public static function get($name){
		return self::init()[$name];
	}
 	

 	public static function init(){
 		if(!self::$container){
			self::$container = new Container();
		}
		return self::$container;
 	}
	 
	
}