<?php
define('WEB',__DIR__);
define('BASE',realpath(__DIR__.'/../'));  
include '../vendor/autoload.php';
use core\router;

//设置显示错误 
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();




//默认的namespace 自动会加上的
router::$module = 'modules';

view_module_path('modules');

import(__DIR__.'/../boot.php');
 



$run =  router::run();  
 


echo $run;



  
