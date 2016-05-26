<?php 
namespace data;
use MongoDate as md;
use db;
class post{


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


			$all = db('posts')->aggregateCursor(
					$condition
			);

			return $all;
	}


	static function get_data_by_date($date = "2016-05"){
 		$start = strtotime($date."-01 00:00:00");
		$end = strtotime('+1 month',$start);
		$data = db('posts')->find([
				'created'=>[
					 '$gte'=>new md($start),
					 '$lt'=>new md($end),
				],
			])->sort(['_id'=>-1]);
			
	 


 
		return $data;
	}



}