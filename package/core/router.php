<?php  namespace core;
use Exception;
/**
*  URI Route 路由 restful 格式   
*  　　
* @author Sun <sunkang@wstaichi.com>
* @license PHP路由
* @copyright http://www.wstaichi.com 
* @time 2014-2015
*/
/**
*  
* 	
*<code>	
* 	$time_start = microtime(true);
*	
*	r::get('/',function(){
*		echo 1;
*	});
*	
*	r::all('login/<name:\w+>','app\login\$name@index','login');  
*	
*	//aa 为url地址，home为生成url链接所用的名称 	
*	r::get('aa',"app\controller\index@index",'home'); 
*	
*	r::get('post/<id:\d+>/<g:\d+>',"app\controller\index@test",'post');
*	
*	r::get('payadmin','app\pay\admin@list');
*	r::get('payadmin/<page:\d+>','app\pay\admin@list');
*
*	生成URL
*
*	echo url('post',['id'=>1,'d'=>3]);
*	
*	
*	r::domain('user2.api.com',function(){
*		r::get('/',function(){
*			echo 111;		
*		});
*
*		r::get('test',function(){
*			echo 'test';		
*		});
*	});
*	 
*支持多条规则
*
*	r::get('post/<id:\d+>|post',function(){    
*	},'@post');
*	r::get('post/<id:\d+>|post',function(){    
*	},'@post|$po');
*
*执行路由
*	
*	try {  
*		$view = r::run();  
*		if($view){
*			echo $view;
*			$time_end = microtime(true);
*			$used = number_format($time_end - $time_start,2);
**			echo "\n<!--total used time:". $used.'s-->';
*		}
*	}catch (Exception $e) {  
*		dump($e->getMessage()); 
*	} 
*
*	
*get/post/all 方法支持
*
*apache	.htaccess 配置 
*
* RewriteEngine On 
* RewriteCond %{REQUEST_FILENAME} !-d
* RewriteCond %{REQUEST_FILENAME} !-f
* RewriteRule ^ index.php [L]
*
*</code>
*
*/
class router{
	//基础URL
	public $base_url;
	protected $method;
	static $router;  
	public $match = '/<(\w+):([^>]+)?>/';
	static $app = [];
	//相对URL
	static $index;
	/**
	*默认路由模块namespace为module
	*/
	static $module = 'm';  
	static $module_path;
 	/** 
	* get('aa',function(){});
	*/
	protected $_url;//当前正则的URL 如 aa
	protected $_value; //当前URL的function 如 function(){}  
	public $host;
	public $class = [];
	static $obj;
	static $current_class;//当前使用的CLASS
	static $current_domain; //当前域名　
	/**
	* 初始化 
	*/
	static function init(){
		if(!isset(static::$obj))
			static::$obj = new Static;
		return static::$obj;
	}
	/**
	* uri   
	*/
	static function uri(){
		$uri = static::_uri();
		if($uri!='/'){
			$uri = substr($uri,1);
		}
		return $uri;
	}
	/**
	*内部函数  
	*/
	static function _uri(){
		//解析URL $uri 返回 /app/public/ 或  / 
		$uri = $_SERVER['REQUEST_URI']; 
		$uri = str_replace("//",'/',$uri);
		$uri = str_replace(static::host(),'',$uri);
		if(strpos($uri,'?')!==false)
			$uri = substr($uri,0,strpos($uri,'?'));
		return $uri;
	}
	/**
	* 构造函数 
	*/
	function __construct(){
		//请求方式 GET POST
 		$this->method = $_SERVER['REQUEST_METHOD'];   
 		$this->host = static::host();   
 	}  
 	/**
	* server_name 　 
	* @return   
	*/
 	static function server_name(){
 		return $_SERVER['SERVER_NAME'];
 	}
 	/**
	* host自动加http://或https://
	* @return string   
	*/
 	static function host(){
 		$top = 'http';
 		if($_SERVER['SERVER_PORT'] == 443 || $_SERVER['HTTPS'] == 1 ||$_SERVER['HTTPS'] == 'on')
 			$top = 'https';
 		return $top."://".static::server_name(); 
 	}
 	/**
	* domain路由
	*
	* @param string $domain 　 
	* @param string $fun 　 
	* @return   call_user_func
	*/
 	static function domain($domain,$fun){ 
 		if($domain!=static::server_name()) return;
 	 	call_user_func($fun); 
 	} 
 	/**
	* 返回当前　模块　控制器　动作　以 / 相连的字符串 
	*/
 	static function string(){
 		$id = static::controller();
 		$m = $id['module']; 
 		$str = $id['id'];
 		$i = $id['action'];
  		if($m)
 			$str = $m.'/'.$str;
 		return $str.'/'.$i;
 	}
 	/**
 	* 取得控制器的 model id action
 	* [_id] => module/admin/admin
    * [action] => login
    * [module] => admin
    * [id] => admin
 	*/ 
 	static function controller(){
 	 	 $ar = static::init()->class; 
 		 $vo['_id'] = $id = str_replace('\\','/',$ar[0]); 
 		 $vo['action'] = $ar[1];  
 		 $arr = explode('/',str_replace(static::$module.'/','',$id));
 		 $vo['module'] = $arr[0];
 		 $vo['id'] = $arr[1];
 		 $vo['controller'] = $vo['id'];   
 		 return $vo;
 	}
 	/**
  	*	对GET POST all 设置router
 	*/
	protected function set_router($url,$do,$method='GET',$name=null){   
 		if(strpos($url,'|')!==false){
 			$arr = explode('|',$url);
 			if(strpos($name,'|')!==false){
 				$names = explode('|',$name);
 			}else{
				$names[0] = $name;
 			}
 			$i = 0;
 			foreach($arr as $v){
 				$this->set_router($v,$do,$method,$names[$i]);
 				$i++;
 			}
 			return;
 		}
 		if(!is_object($do) && !$name){ 
 			if(strpos($do,'@')===false){
 				$do = $do.'@index';
 			} 
			$n = str_replace('@','/',$do);
			$name = str_replace('\\','/',$n);  
		}
 		if(strpos($url,'<')!==false){
			$url = "#^\/{$url}\$#";
		}elseif(substr($url,0,1)!='/'){
			$url = '/'.$url;
		} 
		static::$router[$method][$url] = $do;
		if($name)
			static::$router['__#named#__'][$name] = $url;
		 
	}
	static function url($url,$par = []){
		return static::init()->create_url($url,$par);
	}
	/**
	*	自动生成URL
	*/
	protected function create_url($url,$par = []){
		$url = str_replace('.','/',$url);
		$id = 'route_url'.$url.json_encode($par);
		if(static::$app[$id]) return static::$app[$id];
		$r = static::$router['__#named#__'][$url]; 
		 
		preg_match_all($this->match, $r, $out);
		//[<id:\d+>]
		$a = $out[0];
		//['id']
		$b = $out[1];
		if($b){
			$i = 0;
			foreach($b as $v){
				$r = str_replace($a[$i],$par[$v],$r);
				unset($par[$v]);
				$i++;
			}
		}  
		if($r=='/') goto GT;
		if(substr($r,0,2) == '#^')
			$r = substr($r,4,-2);  
		if(substr($r,-1)=='/')
			$r = substr($r,0,-1);  
		if(!$r) $r = $url; 
		GT:
		if($par) 
			$r = $r."?".http_build_query($par);  
 		$url = $this->base_url.$r;
 		$url = str_replace("//",'/',$url);
 		static::$app[$id] = $url; 
	 	return $url;	 
	}
  
	/**
	* get request
	*/
	static function get($url,$do,$name=null){
		static::init()->set_router($url,$do,'GET',$name); 
	}
	/**
	* post request
	*/
	static function post($url,$do,$name=null){
		static::init()->set_router($url,$do,'POST',$name); 
	}
	/**
	* put request
	*/
	static function put($url,$do,$name=null){
		static::init()->set_router($url,$do,'PUT',$name); 
	}
	/**
	* put request
	*/
	static function delete($url,$do,$name=null){
		static::init()->set_router($url,$do,'DELETE',$name); 
	}
	/**
	* get/post request
	*/
	static function all($url,$do,$name=null){
		static::init()->set_router($url,$do,'POST',$name); 
		static::init()->set_router($url,$do,'GET',$name);  
	}
	/**
	* 执行路由 
	*/
	static function run(){
		return static::init()->exec();
	}
	/**
	* 内部函数,	执行解析URL 到对应namespace 或 closure 
	*/
	protected function exec(){  
		//解析URL $uri 返回 /app/public/ 或  /  
		$uri = static::_uri(); 
		//取得入口路径
		$index = $_SERVER['SCRIPT_NAME'];
		$index = substr($index,0,strrpos($index,'/')); 
		$action = substr($uri,strlen($index)); 
		 
		
		
	 	$this->base_url = $index?$index.'/':'/'; 
	 	/**
	 	*	对于未使用正则的路由匹配到直接goto
	 	*/
		$this->_value = static::$router[$this->method][$action]; 
		
		$data = []; 
		if($this->_value) goto TODO; 
		if(!static::$router[$this->method]) goto NEXT;
		foreach(static::$router[$this->method] as $pre=>$class){  
			if(preg_match_all($this->match, $pre, $out)){
				//转成正则   
                foreach($out[0] as $k=>$v){ 
                	$pre = str_replace($v,"(".$out[2][$k].")",$pre);
                }  
                $pregs[$pre] = ['class'=>$class,'par'=>$out[1]]; 
			}  
		}
		NEXT:
		/**
		*	匹配当前URL是否存在路由
		*/   
		if($pregs){
			foreach($pregs as $p=>$par){ 
				$class = $par['class'];
				if(preg_match($p,$action, $new)){ 
					unset($new[0]);
	               	//根据请求设置值 $_POST $_GET
	                $data = $this->set_request_value($this->array_combine($par['par'],$new));    
	                $this->_url = $pre;
	                $this->_value = $class;  
	                goto TODO;  
                } 
               
			}
		} 
	 	if($this->_value){ 
	 		TODO:
	 		// 如果是 closure 
	 		if(is_object($this->_value) || ($this->_value instanceof Closure) )
	 			return call_user_func_array($this->_value,$data); 
	 		// 对 namespace 进行路由
	 		$this->_value = str_replace('/','\\',$this->_value); 
	 		$cls = explode('@',$this->_value);   
 			$class = $cls[0];
 			if($data){
 				foreach($data as $k=>$v){
 					$class = str_replace("$".$k,$v,$class);
 				}
 			} 
 			$ac = $cls[1]; 
 			
 			$class = $this->routeClassMatch($class);
 			return $this->load_route($class,$ac,$data);
	 	}  
	 	 
 		$action = trim(str_replace('/',' ',$action));
	 	$a = explode(' ',$action);
	 	$class = static::$module."\\".$a[0]."\\".$a[1];
	 	$ac = $a[2]?:'index'; 
	 	$class = $this->routeClassMatch($class);
	 	return $this->load_route($class,$ac,$data); 
	}
	function routeClassMatch($class){ 
		  $class = str_replace(static::$module.'\\', '', $class);
		  $a = substr($class,0,strpos($class,'\\'));
		  $b = substr($class,strpos($class,'\\')+1);
		  $cls = static::$module.'\\'.$a."\\".$b;
		  return $cls; 
	}
	/**
	* 建议内部使用
	*/
	static function get_class(){
		return static::$current_class;
	}
	/**
	* 内部函数，支持框架内部框架
	*/
	protected function load_route($class,$ac,$data){  
		$this->class = [$class,$ac];		
		static::$current_class = $class;
		$this->class_exists($class,$ac);
		$obj = new $class;    
		return call_user_func_array([$obj,$ac],$data); 
		 
	}
	/**
	* 内部函数 
	*/
	protected function class_exists($class,$ac){
		if(!class_exists($class)) {
			header("HTTP/1.1 404 Not Found");
 			throw new Exception(' Class not exists: '.$class,404);
		}
	 	if(!method_exists($class,$ac)){
	 		header("HTTP/1.1 404 Not Found");
	 		throw new Exception("$ac   not exists",404);
	 	}
	} 
	 
	/**
	* 内部函数 ，对array_combine优化
	*/
	protected function array_combine($a=[],$b=[]){   
		 $i = 0;
		 foreach($b as $v){
		 	$out[$a[$i]] = $v;
		 	$i++;
		 } 
		 return $out; 
	}
	/**
	*	内部函数 ,根据请求设置值
	*/
	protected function set_request_value($data){  
			switch($this->method){
           		case 'GET': 
           			$_GET = array_merge($data,$_GET);
           			break;
           		case 'POST':
           			$_POST = array_merge($data,$_POST);
           			break;
           		case 'PUT':
           			$_PUT = array_merge($data,$_PUT); 
           			break;
           		case 'DELETE':
           			$_PUT = array_merge($data,$_DELETE); 
           			break;
           	} 
           	return $data;
	}
}