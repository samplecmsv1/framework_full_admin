<?php
namespace modules\admin;

class config extends base{
	
	public $accessDeny = [
		'*'
	];
	
	public function init(){

		parent::init();
		$this->model = obj('models\config');
	}


	function index(){
			
			$r = $this->model->pager();
			 
			return view('config',$r);
	}
	
	function edit(){
		$data = [];
		
		$id = $_GET['id'];
		if($id){
			$model = $this->model;
			$data['output'] = $model->one(['_id'=>new \MongoId($id)]);
		}
		if(is_post()){
			$model = $this->model;
			if($id){
				$r = $model->updateValidate();
					 
				if($r['errors']){
					$data['error'] = $r['errors'];
				}else{
					flash('success',__('Update Action Success'));
					redirect(url('admin/config/index',$_GET));
					
				}
			}else{
				$r = $model->insertValidate();
				if($r['errors']){
					$data['error'] = $r['errors'];
				}else{
					flash('success',__('Create Action Success'));
					redirect(url('admin/config/index',$_GET));
					
				}
			}
			
		}
	
	
		return view('config_edit',$data);
	}


	
	 
	
	
}