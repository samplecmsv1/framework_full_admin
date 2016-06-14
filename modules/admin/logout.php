<?php
namespace modules\admin;

class logout extends base{
	
	public $accessDeny = [
		'index'
	];
	
	
	function init(){
		parent::init();
	}
	
	 
	
	function index(){
		cookie_delete(['adminId','adminUser']);
		flash('success','退出成功');
		redirect(url('admin/login/index'));
	}
}