<?php   namespace core;
/**
*  字符串操作 
*  
*  　　
* @author Sun <sunkang@wstaichi.com>
* @license 
* @copyright  
* @time 2014-2015
*/
/**
*<code>
*字符串
* echo $v = Str::size(1024*10);  //返回　１0KB
* $v = '10 KB'; 中间必须有空格
* dump(Str::size_to($v,'mb'));exit;    0.01
*</code>
* 	  
*/
class ForCookieSessionArrayValue
{ 
	
	/**
	* 保存cookie或session,数组或字符串全转成字符串		
	*/
	static function cookie($arr){
		if(is_object($arr)){
			$arr = (array)$arr;
		}
		if(is_array($arr)){
			foreach($arr as $k=>$v){
				if(is_object($v) || ($v instanceof Closure) ){
			 		$v =  call_user_func_array ($v,[]);
			 	}
			 	$new[$k] = $v;
		 	}
		 	$arr = $new;
	 	}
		 if(is_array($arr)){
		 	 $str = base64_encode(serialize($arr));
		 }else{
		 	$str  = base64_encode($arr);
		 }
		 return $str;
	}
	/**
	* 取得cookie或session
	*/
	static function re_cookie($str){
		 $str  = base64_decode($str);
		 if(static::is_serialized($str)){
		 	$str = static::maybe_unserialize($str);
		 }
		 return $str;
	}
	 /***********************************************************************************************/
	 /**
	 * 以下全英文注释代码来自　
	 * @link https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
	 * 对字符串数组操作很实用
	 */
	 /**
     * Check value to find if it was serialized.
     *
     * If $data is not an string, then returned value will always be false.
     * Serialized data is always a string.
     * @link https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
     * @param  mixed $data Value to check to see if was serialized
     * @return boolean
     */
    static function is_serialized($data)
    {
        // If it isn't a string, it isn't serialized
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        // Is it the serialized NULL value?
        if ($data === 'N;') {
            return true;
        }
        // Is it a serialized boolean?
        elseif ($data === 'b:0;' || $data === 'b:1;') {
            return true;
        }
        $length = strlen($data);
        // Check some basic requirements of all serialized strings
        if ($length < 4 || $data[1] !== ':' || ($data[$length - 1] !== ';' && $data[$length - 1] !== '}')) {
            return false;
        }
        return @unserialize($data) !== false;
    }
     /**
     * Unserialize value only if it is serialized.
     * @link https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
     * @param  string $data A variable that may or may not be serialized
     * @return mixed
     */
    static function maybe_unserialize($data)
    {
        // If it isn't a string, it isn't serialized
        if (!is_string($data)) {
            return $data;
        }
        $data = trim($data);
        // Is it the serialized NULL value?
        if ($data === 'N;') {
            return null;
        }
        $length = strlen($data);
        // Check some basic requirements of all serialized strings
        if ($length < 4 || $data[1] !== ':' || ($data[$length - 1] !== ';' && $data[$length - 1] !== '}')) {
            return $data;
        }
        // $data is the serialized false value
        if ($data === 'b:0;') {
            return false;
        }
        // Don't attempt to unserialize data that isn't serialized
        $uns = @unserialize($data);
        // Data failed to unserialize?
        if ($uns === false) {
            $uns = @unserialize(static::fix_broken_serialization($data));
            if ($uns === false) {
                return $data;
            } else {
                return $uns;
            }
        } else {
            return $uns;
        }
    }
    /**
     * Unserializes partially-corrupted arrays that occur sometimes. Addresses
     * specifically the `unserialize(): Error at offset xxx of yyy bytes` error.
     *
     * NOTE: This error can *frequently* occur with mismatched character sets
     * and higher-than-ASCII characters.
     *
     * Contributed by Theodore R. Smith of PHP Experts, Inc. <http://www.phpexperts.pro/>
     * @link https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
     * @param  string $brokenSerializedData
     * @return string
     */
     static function fix_broken_serialization($brokenSerializedData)
    {
        $fixdSerializedData = preg_replace_callback('!s:(\d+):"(.*?)";!', function($matches) {
            $snip = $matches[2];
            return 's:' . strlen($snip) . ':"' . $snip . '";';
        }, $brokenSerializedData);
        return $fixdSerializedData;
    }
	/**
     * Checks to see if the page is being server over SSL or not
     *
     * @return boolean
     */
    public static function is_https()
    {
        return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
    }
 
}