<?php namespace src\oauth2\Provider; 
use src\oauth2\Provider;
use src\oauth2\Token\Access;
/**
 *  
 * @author Sun < sunkang@wstaichi.com >
 * @Coprighty  http://wstaichi.com
 */
 

class Renren extends Provider
{
	public function url_authorize()
	{
		return 'https://graph.renren.com/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'https://graph.renren.com/oauth/token';
	}
	public function url_access()
	{
		return 'https://api.renren.com/v2/user';
	}
	
	

	 
}