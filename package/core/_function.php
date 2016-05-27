<?php 
   
$class_alias = [
	'core\arr'=>'cache',
	'core\config'=>'config',
	'core\cookie'=>'cookie',
	'core\crypt'=>'crypt', 
	'core\curl'=>'curl',
	'core\dir'=>'dir',
	'core\file'=>'file',
	'core\di'=>'di',
	'core\log'=>'log',
	'core\paginate'=>'paginate',
	'core\router'=>'router',
	'core\session'=>'session',
	'core\str'=>'str',
	'core\tree'=>'tree',
	'core\view'=>'view',
	'core\widget'=>'widget',
];

foreach($class_alias as $k=>$v){
	class_alias($k, $v);	
}



 


function import($file){
	static $m;
	$id = md5($file);
	if(!$m[$id]){
		include $file;
		$m[$id] = true;
	}
	 
}

function obj($class){
	static $m;
	if(!$m[$class]){
		$m[$class] = new $class;
	}
	return $m[$class];
}
function url($url,$par=[]){
 	return router::url($url,$par);
}
  
function url_string(){
	return router::string();
}

function host(){
	return router::host();
}

function url_array(){
	return router::controller();
}
 
function get($url,$fun){
	router::get($url,$fun);
}

function post($url,$fun){
	router::post($url,$fun);
}

function put($url,$fun){
	router::put($url,$fun);
}

function delete($url,$fun){
	router::delete($url,$fun);
}

function get_post($url,$fun){
	router::all($url,$fun);
}


function view($file,$par = []){
	$view = view::make($file,$par);
	return $view;
}
function view_set($name,$value){
	return view::set($name,$value);
}
function view_cache($timeSecond = 3600){
	return view::cache($timeSecond);
}
function view_minify($flag = true){
	return view::$minify = $flag;
}
function view_module_path($path){
	router::$module_path = $path;
}
function theme($name = null){
	return view::theme($name);
}
function theme_url($url = null){
	if($url && substr($url,0,1)!='/'){
		$url = '/'.$url;
	}
	return view::themeUrl().$url;
}

function base_url(){
	$s = $_SERVER['SCRIPT_NAME'];
	if(substr_count($s,'/')>1){
		return substr($s,0,strrpos($s,'/')+1);
	}
	return '/';
}



function dump($str){
	print_r('<pre>');
	print_r($str);
	print_r('</pre>');
}




//公用函数

function redirect($url,$e301 = false){
	if($e301 === true){
		header( "HTTP/1.1 301 Moved Permanently" );
	}
	header("location:$url");
	exit;
}

function is_post(){
	return $_SERVER['REQUEST_METHOD']=='POST'?true:false;
}
function is_ajax(){
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		return true;
	}
	else
	{
		return false;
	}
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function ip($type = 0)
{
	$type      = $type ? 1 : 0;
	static $ip = null;
	if (null !== $ip) {
		return $ip[$type];
	}
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos = array_search('unknown', $arr);
		if (false !== $pos) {
			unset($arr[$pos]);
		}
		$ip = trim($arr[0]);
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	// IP地址合法验证
	$long = sprintf("%u", ip2long($ip));
	$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
	return $ip[$type];
}

function page($url,$count,$perSize = 10){
	$paginate = new paginate($count,$perSize);
	$paginate->url = $url;
	$limit = $paginate->limit;
	$offset = $paginate->offset;
	return ['limit'=>$limit,'offset'=>$offset,'link'=>$paginate->show()];
}

function log_open($par = []){
	log::open($par);
}
function log_info($str){
	log::info($str);
}
function log_sys($str){
	log::system($str);
}
function log_error($str){
	log::error($str);
}
function log_write($name,$str){
	log::$name($str);
}
function log_read(){
	return log::read();
}
function log_clean(){
	return log::clean();
}


///////////////////////////////////////
// file
///////////////////////////////////////

function file_cpdir($dir, $to,$name = null){
	 file::cpdir($dir,$to,$name);
}
function file_find($dir,$find='*'){
	return file::find($dir,$find);
}
function file_rmdir($dir){
	return file::rmdir($dir);
}
/**
 * 取文件名　返回类似 1.jpg
 *
 *
 * @param string $name
 * @return string
 */
function file_name($name){
	return file::name($name);
}
/**
 * 返回后缀 如.jpg
 *
 *
 * @param string $url 　
 * @return string
 */
function file_ext($url){
	return file::ext($url);
}
function file_class($class = null){
	return File::file_name($class);
}
function file_dir($url){
	return file::dir($url);
}


///////////////////////////////////////
// cookie seesion crypt
///////////////////////////////////////
 
function config($name,$value = null){
	if(!$value){
		return config::get($name);
	}
	config::set($name,$value);
}
//$name string
function cookie($name = null,$value = null,$expire = 0){
	if($value){
		return cookie::set($name,$value,$expire);
	}
	return cookie::get($name);
}
//$name string|array
function cookie_delete($name){
	return cookie::delete($name);
}
//$name string
function session($name,$value = null){
	if($value){
		return session::set($name,$value);
	}
	return session::get($name);
}
//$name string|array
function session_delete($name){
	return session::delete($name);
}
function flash($name,$value = null){
	return session::flash($name,$value);
}
function has_flash($name){
	return session::has_flash($name);
}
function encode($value,$key = null){
	$c = new crypt;
	if($key){
		$par['key'] = $key;
	}
	return $c->encode($value,$par);
}
function decode($value,$key = null){
	$c = new crypt;
	if($key){
		$par['key'] = $key;
	}
	return $c->decode($value,$par);
}

///////////////////////////////////////
// widget
///////////////////////////////////////
/**
 * 使用WIDGET
 * @param unknown $name
 * @param array $par
 */
function widget($name,$par = []){
	widget::start($name,$par);
	
}

function widget_render_css(){
	return widget::render(['css']);
}


function widget_render_js(){
	return widget::render(['js','js_code','css_code']);
}


/**
 * 渲染WIDGET
 * 
 */
function widget_render($types = ['css','js','js_code','css_code']){
	return widget::render($types);	
	
}


