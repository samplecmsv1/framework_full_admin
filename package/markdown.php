<?php namespace package;
use Parsedown;
/*
https://github.com/erusev/parsedown
*/
/*
* author: sun kang 
* email:  sunkang@wstaichi.com
*/
 
class markdown{

	public $m;
	function __construct(){
		$this->m = new Parsedown();
	}

	function txt($txt){ 
		return $this->m->text($txt);  
	}
 	


 	 





}