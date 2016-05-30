<?php
namespace modules\content\models;

class friendlink extends base{
	public $title = "友情链接";
	public $tb = 'frind_links';
	public $tbVersion = "version_frind_links";

	public $fields = [
	 	 
	 	'body'=>[
	 		'label'=>'联系信息',
	 		'element'=>'textarea',
	 		
	 	],
	 	'url'=>[
	 		'label'=>'网址',
	 		'element'=>'txt',
	 		
	 	],
	 	  

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
		'title'  => 'required',
		'url'=>'required|unique(frind_links,url)',
	];
	/**
	 * 验证错误提示信息
	 * @var array $validateMessage
	 */
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空啊啊',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
		 
		'url'  => [
					'required'=>'url不能为空',
					'unique'=>'已存在设置的URL',
			],
	];
	
	 
	
	
}