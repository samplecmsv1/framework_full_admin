<?php
namespace modules\admin;
use models\menu as PostModel;
class menu extends base{
	
	public $accessDeny = [
		'*'
	];
	public $obj;
	//跳转
	public $jump = 'admin/menu/index';
	//分页
	public $per_page = 10;
	//列表页排序 
	public $sort = ['created'=>-1];
	//列表页查寻条件
	public $condition = [
	 
	];
	//当前视图
	public $view = '/menu';
	
	function init(){
		parent::init();
		$this->obj = new PostModel;
	}
	
	
	function view(){
		parent::view();
		$this->data['category'] = $this->obj->getTree($this->data['data']->pid);
		return $this->render($this->view,$this->data);
	}
	
	 
}