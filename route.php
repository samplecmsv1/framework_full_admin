<?php
$theme = $_GET['t'];

$arr = [
	'a'=>'jekyll_hyde',
	'b'=>'jekyll_lanyon',
	'c'=>'jekyll_left',
	'd'=>'jekyll_skinny',

];
$t = $arr[$theme]?:'home';

theme($t);



get('/|posts', function(){
	 
 	$t = strip_tags(db_config('home_title'));
 	$data['title'] = $t;
	return view('index',$data);
});

get('post/<slug:\w+>', function($slug){
	$t = strip_tags(db_config('home_title'));
	$data['title'] = $t;
	$data['post'] = data\post::get($slug);
	
	return view('post',$data);
});

get('about', function(){
	$t = strip_tags(db_config('home_title'));
	$data['title'] = $t;
	return view('about',$data);
});


get('admin','admin\home@index');