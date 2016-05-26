<?php
namespace modules\admin;

class base extends \controllers\admin_auto{
	
	public $accessDeny = [
		'*'
	];
	 
	 function init(){
	 	parent::init();
	 	theme('admin');
	 }
	
	
}