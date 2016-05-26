<?php 
//languages translate
function __($key){
	static $out;
	$lang = config('app.lang');
	if(!$out){
		$r = db('langs')->find(['lang'=>$lang]);
		foreach($r as $v){
			$out[trim($v['title'])] = trim($v['body']);
		}
	}
	return $out[$key]?:$key;
}
 


function db_config($key){
	return db('configs')->findOne(['title'=>$key])['body'];
}