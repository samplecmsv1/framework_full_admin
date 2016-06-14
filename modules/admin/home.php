<?php
namespace modules\admin;

class home extends base{
	
	public $accessDeny = [
		'*'
	];
	 


	function index(){


			return view('index');
	}


	
	 
	
	
}