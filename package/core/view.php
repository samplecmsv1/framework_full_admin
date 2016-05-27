<?php  namespace core;
/**
*  视图
*   
*  　　
* @author Sun <sunkang@wstaichi.com>
*   
* @time 2014-2016
*/  
/** 
*<code> 
*	
*在public/index.php 需要定义 
*define('WEB',__DIR__);
*define('BASE',realpath(__DIR__.'/../')); 
*
*
*v::cache(60);
* View 视图
* layout举例  文件名为default.layout.php
 *   
 *<?php echo $this->view['content'];?>
 *  
* View中使用
*
* <?php $this->layout('default');?>
*
*<?php echo $this->start('content');?>
*test
* <?php  $this->extend('payment');?>
*<?php echo $this->end();?> 
 *</code>
 */
class view
{  
	/**
	* 默认theme 
	*/
	static $theme = 'default'; 
 	protected $block;
	protected $block_id;   
	protected $theme_dir; 
	protected $view_dir;
	protected $view_file;
	protected $theme_file; 
	protected $view;
	static $modulePath;
	//记录最早一次的make 页面
	static $keep_dir;
	/**
	* 仅是静态变量
	*/
	static $par = []; 
	static $obj;   
	/**
	* 是否合并HTML输出
	*/
	static $minify = false;
	protected $base_path;
	/**
	* 生成HTML静态文件的文件夹名
	*/
	static $htmlcache = "htmlcache";
	/**
	* theme最上层目录名
	*/
	static $theme_path = "themes";
	//页面缓存时间
	static $cache = false;
	static $cacheFileName;
	/**
	* 设置值　
	* @param string $name  
	* @param string $value  　 
	* @return void 
	*/
	static function set($name,$value){
		static::$par[$name] = $value;
	}
	/**
	* 设置主题/取得当前主题名
	*/
	static function theme($name = null){ 
		if(!$name)
			return static::$theme;
		static::$theme = $name;
	}
 
	/**
	* 构造函数
	*/
	function __construct(){    
		$this->base_path = BASE;
		$this->view_dir = $this->base_path.'/views'; 
		$this->theme_dir = WEB.'/'.static::$theme_path.'/'.static::$theme;   
		static::$modulePath = router::$module_path;
	}  
 
	/**
	* 加载view 同级内容
	* @param string $name  
	* @param array $par  　 
	* @return void 
	*/
	function extend($name,$par = []){ 
		
		$this->__ex($name); 
		$same_level_file = static::$keep_dir;
		if($same_level_file){
			$a = substr($same_level_file,0,strrpos($same_level_file,'/')+1).$name.'.php'; 
		}
		$file = $this->find([$this->theme_file,$this->view_file,$a]); 
		if(file_exists($file)){
			extract($par, EXTR_OVERWRITE); 
			include $file;
		}
		
	}
	
	/**
	*返回theme所在的url
	*/
	static function themeUrl(){
		return router::init()->base_url.''.static::$theme_path.'/'.static::$theme;
	}
 
	/**
	* 内部函数,查找文件是否存在，存在后直接include 
	*@param array $arr
	*/
	protected function find($arr = []){
		foreach($arr as $file){
			if($file && file_exists($file))  
				return $file;
		} 
		echo "<h1>view file not exists</h1>";
		print_r('<pre>');
		print_r($arr);
		print_r('</pre>');
		exit;
	}
	/**
	* 内部函数
	*@param string $name
	*/
	protected function __ex($name){ 
		$this->view_file = $this->view_dir.'/'.$name.'.php';  
 		if($this->theme_dir){
			$this->theme_file = $this->theme_dir.'/'.$name.'.php';
		} 
	}
	/**
	* 内部函数View缓存
	* @param string $time  
	* @return void 
	*/
	static function cache($time = NULL){
		if($time>=0 || $time == null) static::$cache = $time;
		if(static::$cache===false) return;
 		$url = static::cacheHtml();
		if(file_exists($url)){
			if(static::$cache == null ||  static::$cache==0){
				$data = file_get_contents($url);
				if($data){
					echo $data;
					exit;
				}
			}
 			$d = filemtime($url);
			if(static::$cache && $d+static::$cache >= time()){
				$data = file_get_contents($url);
				if($data){
					echo $data;
					exit;
				}
			} 
 		} 
	}
	/**
	* 内部函数缓存HTML
	*/
	static function cacheHtml(){
		if(static::$cache===false) return;
 		$uri = $_SERVER['REQUEST_URI']; 
		$uri = str_replace("//",'/',$uri);
		$uri = str_replace(router::host(),'',$uri); 
		if(!$uri||$uri=='/') $uri = "index";
		if(static::$cacheFileName){
			$url = WEB."/".static::$htmlcache."/".static::$cacheFileName.".html"; 
		}else{
			$url = WEB."/".static::$htmlcache."/".$uri.".html"; 
		}
		$url = str_replace('//','/',$url); 
		$dir = file::dir($url); 
		if(!is_dir($dir)) mkdir($dir,0777,true);
		 
		return $url;
	} 
  	/**
	* 渲染页面
	* @param string $name  
	* @param array $par  
	* @return void 
	*/
	static function make($name, $par = [])
	{ 
		if(is_object($par)) $par = (array)$par;
		$view = new Static; 
		$data = $view->render($name, $par);
 		if(static::$cache!==false && static::$cache >= 0){
			$url = static::cacheHtml();
			ob_start();
		  	echo $data;
		  	$data = trim(ob_get_contents());   
			ob_end_clean(); 
			$data = $data."\n<!--date:".date('Y-m-d H:i:s')."-->\n";
			file_put_contents($url,$data); 
		}
		return $data;
	}
	/**
	*	渲染视图同make
	*/
	function render($name, $par = [])
	{  
		if(static::$par) $par = $par+static::$par;
	 	$name = str_replace('.','/',$name);
		if(substr($name,0,1)=='/'){
			$this->view_dir = $this->view_dir;
			$this->theme_dir = $this->theme_dir;
			$name = substr($name,1);
		} 
		$this->__ex($name); 
		
		$m = router::controller()['module'];
		unset($n2);
		if($m){
			if(strpos($name,'/')!==false){
				$name  = substr($name,strpos($name,'/')+1);
			}
			$n2 = BASE.'/'.static::$modulePath.'/'.$m.'/views/'.$name.'.php';
		}
		$this->block['content'] = $this->find([$this->theme_file,$this->view_file,$n2]);
		if(!static::$keep_dir){
			static::$keep_dir = $this->block['content'];
		}    
		ob_start();
		extract($par, EXTR_OVERWRITE); 
		include $this->block['content']; 
		if(file_exists($this->block['layout']) ){
  			include $this->block['layout'];   
  		}
		$data = trim(ob_get_contents());   
		ob_end_clean();
		if(true === static::$minify){
			$replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n([\S])/"                => ' $1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => ' ',
                "/ +/"                      => ' ',
            );
            $data =  preg_replace(
                array_keys($replace), array_values($replace), $data
            );

		} 
		if(static::$cache!== false && static::$cache >= 0){
			$url = static::cacheHtml();   
			file_put_contents($url,$data); 
		} 
		
		

		return $data;  
	} 
	 
	/**
	* 加载layout
	* @param string $name  
	* @param array $par  
	* @return void 
	*/
	function layout($name , $par = [] ){  
		$d = $name = str_replace('.','/',$name);   
		$view = $this->view_dir.'/'.$name.'.layout.php';
		$theme = $this->theme_dir.'/'.$name.'.layout.php';
		//上一层是否存在layout,目的是多个模块共用同一个theme下的laout
		$pre = substr($this->theme_dir,0,strrpos($this->theme_dir,'/')).'/'.$name.'.layout.php';
		//加载view下的layout
		$default_layout = $this->base_path.'/views/'.static::$theme.'/'.$d.'.layout.php';   
		if(strpos($name,'/')!==false){
			unset($pre,$default_layout);
		} 
		$this->block['layout'] = $this->find([$theme,$view,$pre,$default_layout]);
	}
	
	/**
	*打开 加载指定的 content
	*@param string $name
	*@param array $par
	*@return void
	*/
	function start($name , $par = []){
		$this->block_id = $name;  
		ob_start();
		ob_implicit_flush(false);  
		extract($par, EXTR_OVERWRITE); 
	}
	/**
	* 关闭 加载指定的 content
	*/
	function end(){   
		$this->view[$this->block_id] = ob_get_clean();
	} 
 
}