<?php namespace models;
class menu extends _tree{
	
	public $tb = 'menu';
	public $tbVersion = "version_menu";
	public $allowFields = [
		'title',
		'pid',
		'status',
		'slug',
		'sort'
	];
	
	public $int = [
		 'status','sort'	
	];
	
	public $validate = [
		'title'  => 'required',
		'slug'  => 'required|unique(menu,slug)',
	];
	
	public $validateMessage = [
		'title'  => [
					'required'=>'菜单名不能为空',
				],
		'slug'  => [
				'required'=>'标识不能为空',
				'unique'=>'已存在标识',
		],
	];


	function pager(){
		
		$data = parent::pager([
	 			'url'=>'admin/menu/index',
	 			'size'=>10,
	 			'sort'=>[
	 				'_id'=>-1
	 			],
	 			'condition'=>[
	 				//'status'=>1	
	 			],
	 	]);
	 	return $data;

	}
	
	 
}