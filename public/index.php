<?php
define('WEB',__DIR__);
define('BASE',realpath(__DIR__.'/../'));  
include '../vendor/autoload.php';
use core\router;

//默认的namespace 自动会加上的
router::$module = 'modules';

view_module_path('src/modules');

import(__DIR__.'/../boot.php');
 



echo router::run();  
