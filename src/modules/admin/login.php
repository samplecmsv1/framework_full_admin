<?php
namespace modules\admin;

use models\login as LoginModel;
class login extends base{
	
	public $accessDeny = [
		 
	];
	
	public $obj;

	protected function load_data(){
		$this->_load_data('langs');
		$this->_load_data('configs');
	}


	protected function _load_data($name){
		$file = BASE.'/data/'.$name.'.json';
		if(db($name)->findOne()){
			return;
		}
		if(!file_exists($file)){
			return;
		}
			$d = json_decode(file_get_contents($file));
			foreach($d as $v){
				$v = unserialize($v);
				unset($v['_id']);
				$in[] = $v;
			}
			db($name)->insert($in);
			
	}

	
	function init(){
		parent::init();
		$this->obj = new LoginModel;
		$this->load_data();
	}
	
	function  create(){
		if(!$this->obj->findOne(['user'=>'admin'])){
			$ok = $this->obj->insert(['user'=>'admin','pwd'=>'admin']);
		}
		dump($ok);
	}
	
	function index(){
		$data = [];
		if($_POST && is_ajax()){
			$user = trim($_POST['user']);
			$pwd = trim($_POST['pwd']);
			$data = [
					'status'=>0,
					'msg'=>'登录失败',
					'label'=>'提示信息',
			];
			if($user && $this->obj->tryLogin($user,$pwd)){
				$data = [
						'status'=>1,
						'msg'=>'登录成功了',
						'label'=>'提示信息',
						'url'=>url('admin/config/index')
				];
			}
			exit(json_encode($data));
			
		}
		return $this->render('/login',$data);
	}
}