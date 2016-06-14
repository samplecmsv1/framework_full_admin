<?php

session_start();
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
import(__DIR__.'/src/core_function.php');
import(__DIR__.'/function.php');
 

if(in_array(ip(),['127.0.0.1','::1'])){
	ini_set('display_errors',1);
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
}

view_minify(true);



//log_open();

import(__DIR__.'/route.php');	

 
 