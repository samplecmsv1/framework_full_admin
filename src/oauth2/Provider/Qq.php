<?php namespace src\oauth2\Provider; 
use src\oauth2\Provider;
use src\oauth2\Token\Access;
/**
 *  
 * @author Sun < sunkang@wstaichi.com >
 * @Coprighty  http://wstaichi.com
 */
 

class Qq extends Provider
{
	public function url_authorize()
	{
		return 'https://graph.qq.com/oauth2.0/authorize';
	}

	public function url_access_token()
	{
		return 'https://graph.qq.com/oauth2.0/token';
	}
	
	

	public function get_user_info($access_token)
	{
		$url = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;  
		$sContent = file_get_contents($url);
		preg_match('/callback\(\s+(.*?)\s+\)/i', $sContent,$aTemp);	
		$aResult = json_decode($aTemp[1],true);
		$openid =  $aResult["openid"];
		$url = "https://graph.qq.com/user/get_user_info?";
		$url .="access_token=".$access_token;
		$url .="&oauth_consumer_key=".$this->client_id;
		$url .="&openid=".$openid;
		$url .="&format=json";  
		$sContent = file_get_contents($url); 
		if($sContent!==FALSE){
			$aResult = json_decode($sContent,true); 
			if($aResult["ret"]==0){
				$users = $aResult;
				$users['uid'] = $openid;
				return $users;
			}else{
				return;
			}
		}else{
			return;
		}
		
		 
		
	}
}