<?php

/**
 * authlogin.class.php
 * @author AnCMS <ancmsvn@gmail.com>
 * @link https://github.com/ancm-s/authlogin
 * @license MIT
 */


/**
 * Class authlogin
 */
 
class authlogin{
	
	/**
    * @var string
    */
    private $_email,$_password,$_data;
	
	private $_base_url = 'https://api.facebook.com/restserver.php';
	
	private $_locale = 'en_US'; // more country code: http://lh.2xlibre.net/locales
	
	private $_format = 'json';
	
	protected $_app_secret = '62f8ce9f74b12f84c123cc23437a4a32',$_api_key = '882a8490361da98702bf97a021ddc14d';
	
	/**
	* @constructor
	* @return boolean
	**/
	
	public function __construct($config = array(
	'locale' => 'en_US',
	'format' =>  'json',
	'email' => '', // null string
	'password' => ''
	)){ // default args
	// settings
	return ($this->_email = $config['email']) && ($this->_password = $config['password']) && (!empty($config['format']) && ($this->_format = $config['format'])) && (!empty($config['locale']) && ($this->_locale = $config['locale']));
	}
	
	/**
    * @return object
    */
	
	public function _getObject(){
	return $this->_format  == 'json' ? json_decode($this->_data) : false;
	}
	
	/**
    * @return array
    */
	
	public function _getArray(){
	return $this->_format  == 'json' ? json_decode($this->_data, true) : false;
	}
	
	/**
    * @return string
    */
	
	public function _getXML(){
	return $this->_format  == 'xml' ? $this->_data : false;
	}
	
	
	/**
    * @return string $url
    */
	
	public function _exec(){
	$params = $this->_params();
	$params['sig'] = $this->_createSig($params);
	//print_R($params);exit;
	$url = sprintf('%s?%s',$this->_base_url,http_build_query($params));
	return $this->_data = $this->_cURL($url);
	}
	
	/**
    * @param array $args
    * @return string
    */
	
	protected function _createSig($args = array()){
	$sig = array();
	foreach($args as $key => $value){
		array_push($sig,"$key=$value");
	}
	return md5(implode('',$sig).$this->_app_secret);
    }
	
	/**
    * @return array
    */
	
	private function _params(){
	return array(
    "ancms" => time(),
	"api_key" => $this->_api_key,
	"credentials_type" => "password",
	"email" => trim($this->_email), // remove characters from both side
	"format" => $this->_format,
	"generate_machine_id" => "1",
	"generate_session_cookies" => "1",
	"locale" => $this->_locale,
	"method" => "auth.login",
	"password" => trim($this->_password),// remove characters from both side
	"return_ssl_resources" => "0",
	"v" => "1.0"
    ); 
	}
	
	/**
    * @param string $url
    * @param array $postArray
    * @param string $parse
    * @return string
    */
	
	protected function _cURL($url, $postArray = false, $parse = false){
		$s = curl_init();
		$opts = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FRESH_CONNECT => true
		);
		if($postArray){
			$opts[CURLOPT_POST] = true;
			$opts[CURLOPT_POSTFIELDS] = $postArray;
		}
		curl_setopt_array($s, $opts);
		$return = curl_exec($s);
		curl_close($s);
		if($parse != false){
			if($parse == 'json'){
				$return = json_decode($return);
			}else if($parse == 'str'){
				parse_str($return, $nreturn);
				$return = (object) $nreturn;
			}
		}
		return $return;
	}
	
}
