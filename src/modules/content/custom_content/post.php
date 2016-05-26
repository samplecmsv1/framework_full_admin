<?php
namespace modules\content\custom_content;
use models\base;
class post extends base{
	public $title = "文章";
	public $tb = 'posts';
	public $tbVersion = "version_posts";

	public $fields = [
	 	'category'=>[
	 		'label'=>'分类',
	 		'element'=>'category',
	 		 
	 	],

	 	'body'=>[
	 		'label'=>'内容',
	 		'element'=>'textarea',
	 		
	 	],
	 	'tag'=>[
	 		'label'=>'标签',
	 		'element'=>'txt',
	 		
	 	],
	 	'file'=>[
	 		'label'=>'文件',
	 		'element'=>'file',
	 		
	 	], 
	 	
	 	'slug'=>[
	 		'label'=>'URI标识',
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
		'body'  => 'required',
		'slug'=>'required|unique(posts,slug)',
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
		 
		'slug'  => [
					'required'=>'url不能为空',
					'unique'=>'已存在设置的URL',
			],
	];
	
	 
	
	
}