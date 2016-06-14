<?php
namespace controllers;

class admin extends base  {
	  
	 public $obj;
	 public $loginUrl = "/admin/login/index";
	 
	 function init(){
	 	parent::init();
	 	theme('admin');
	 }
	 
	 function _check(){
	 	return cookie('adminId');
	 }
	 
	 
}
