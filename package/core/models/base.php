<?php
/**
 * @author  SUN KANG [sunkang@wstaichi.com]
 * @copyright 
 * @version 1.0
 */
namespace core\models;
use core\models\core\base as b;
 
class  base extends b{
	 
	 function __construct(){
	 	parent::__construct();
	 	$this->data = $_POST;
	 }
	 
	
	
}