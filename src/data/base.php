<?php 
namespace data;
use MongoDate as md;
use db;
class base{
	static $tb = 'posts';
	static function get_all($condition){  
		$data = db(static::$tb)->find($condition+[
				'status'=>1
			]);
		return $data;
	}

	static function get($condition){
		$data = db(static::$tb)->findOne($condition+[
				'status'=>1
			]);
		return $data;
	}

	static function get_banner(){
		return static::get_all(['tag'=>'banner']);
	}

	static function get_tag(){
		return static::get_all(['tag'=>['$exists'=>true,'$ne'=>'banner']]);
	}

	static function get_group_by_date(){
			 
		   	$condition = [
		   		[
		   			'$group'=>[
		   				'_id'=>[
		   					'y'=>['$year'=>['$add'=>['$created',28800000]]],
		        			'm'=>['$month'=>['$add'=>['$created',28800000]]],
		        			//'d'=>['$dayOfMonth'=>['$add'=>['$created',28800000]]],
		   				],

		   				'count'=>['$sum'=>1],
		   			],
		   			 
		   		],
		   	];


			$all = db(static::$tb)->aggregateCursor(
					$condition
			);

			return $all;
	}


	static function get_data_by_date($date = "2016-05"){
 		$start = strtotime($date."-01 00:00:00");
		$end = strtotime('+1 month',$start);
 		return static::get_all(['created'=>[
					 '$gte'=>new md($start),
					 '$lt'=>new md($end),
				]  ]);
	}



}