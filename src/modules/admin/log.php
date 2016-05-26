<?php
namespace modules\admin;


use package\pager as PagerHelper;

class Log extends base{
	
	public $accessDeny = [
		'*'
	];
	public $obj;
	//跳转
	public $jump = 'admin/user/index';
	//分页
	public $per_page = 10;
	//列表页排序 
	public $sort = ['created'=>-1];
	//列表页查寻条件
	public $condition = [];
	//当前视图
	public $view = '';
	//禁用AUTO CONTROLLER
	public $disable = true;
	function init(){
		parent::init();
	//	$this->obj = new Model;
		
	}
	
	function index(){
		$log = explode("\n",log_read());
		$data = PagerHelper::arrayPage('admin/log/index',50,$log);
		return $this->render('/log',$data);
	}
	
	
	
	 
	
	 
}