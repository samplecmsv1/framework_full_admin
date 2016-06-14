<?php
 

get('/', function(){
	 
 	echo 'its work.';

 	echo "<a href='".url('home/home/index')."'>".url('home/home/index')."</a>";
});

get('demo','home\home@index');

get('admin','admin\home@index');