<?php 
use core\db\mongo;
use core\di;
use core\config;


di::set('mongo',function($c){
	$config = config('db');
	mongo::$server = "mongodb://".$config['host'];
	mongo::$options = array('db'=>$config['db']);
	return new mongo;
});

function db($collection){
	return di::get('mongo')->table($collection);
}



function model($class){
	return obj('models\\'.$class);
}



///////////////////////////////////////
// 过滤MONGODB ARRAY中的KEY为$的 $_GET POST COOKIE REQUEST
///////////////////////////////////////
function clean_mongo_array_injection(){
	$in = array(& $_GET, & $_POST, & $_COOKIE, & $_REQUEST);
	while (list ($k, $v) = each($in))
	{
		if(is_array($v)){
			foreach ($v as $key => $val)
			{
				if(strpos($key,'$')!==false){
					unset($in[$k][$key]);
					$key = str_replace('$','',$key);
				}
				$in[$k][$key] = $val;
				$in[] = & $in[$k][$key];
			}
		}
	}
}
clean_mongo_array_injection();
 
 