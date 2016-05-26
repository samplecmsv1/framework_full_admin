<?php
//输入一个网址，返回带http的完整的域名。 如 www.baidu.com/1.jpg 返回 www.baidu.com
function get_domain($url){
	$url = strip_tags($url);
	$arr = parse_url($url);
	
	$path = $arr['path'];
	$scheme = $arr['scheme'];
	$host = $arr['host'];
	if(!$arr['scheme']){
		$scheme = 'http';
	}
	if(!$arr['host']){
		if(strpos($path,'/')!==false){
			$host = substr($path,0.,strpos($path,'/'));
		}else{
			$host = $path;
		}
	} 
	
	return $scheme.'://'.$host;
	
}


function my_date($post){
	return date('Y-m-d',$post['created']->sec);
}