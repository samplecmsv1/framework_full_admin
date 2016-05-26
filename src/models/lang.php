<?php
namespace models;

class lang extends base{
	public $tb = 'langs';
	public $tbVersion = "version_langs";
	/**
	 * 允许保存到数据库的字段 
	 * @var array $allowFields
	 */
	public $allowFields = [
		'title',
		'lang',
		'body',
		'status',
	];
	/**
	 * INT类型的字段说明
	 * @var unknown
	 */
	public $int = [
			'status'
	];
	/**
	 * 验证规则 
	 * @var unknown
	 */
	public $validate = [
		'title'=>'required|unique(langs,title)',
		'body'  => 'required',
	];
	/**
	 * 验证错误提示信息
	 * @var array $validateMessage
	 */
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空啊啊',
					'unique'=>'已存在设置标题',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
		 
		 
	];
	
	
  
	function pager(){

		$data = parent::pager([
	 			'url'=>'admin/lang/index',
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