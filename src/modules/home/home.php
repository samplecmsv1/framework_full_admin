<?php

namespace modules\home;
use data\post;
class home{
	
	function __construct(){
		config('app.lang',$_GET['lang']);
	}

	public function index(){
		$t = strip_tags(db_config('home_title'));
	 	$data['title'] = $t;
		return view('index',$data);
	}


	public function learn(){
		$t = strip_tags(db_config('home_title'));
	 	$data['title'] = $t;
	 	$data['posts'] = post::get_all(['tag'=>'uk']);
		return view('learn',$data);
	}


	public function post(){
			$t = strip_tags(db_config('home_title'));
			$data['title'] = $t;
			$slug = $_GET['slug'];
			$data['post'] = post::get(['slug'=>$slug]);
			return view('post',$data);
	}
	
	public function connect(){
		$t = strip_tags(db_config('home_title'));
		$data['title'] = $t;
		return view('connect',$data);
	}

	public function classes(){
		return view('classes');
	}

	public function taichi(){
		return view('taichi');
	}

}