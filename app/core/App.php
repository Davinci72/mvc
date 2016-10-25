<?php 
class App
{
	protected $controller 	= 'home';
	protected $method 		= 'index';
	protected $params		=[];
	public function __construct()
	{
		$url = $this->parseUrl();
		if(file_exists('../app/controllers/'.$url[0].'.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once('../app/controllers/'.$this->controller.'.php');
		$this->controller = new $this->controller;
		//$this->debugStuff($this->controller);
		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		$this->params = $url ? array_values($url) : [] ;
		//$this->debugStuff($this->params);
		call_user_func_array([$this->controller,$this->method], $this->params);

	}
	public function parseUrl()
	{
		if(isset($_GET['url']))
		{
			return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
		}
	}
	public function debugStuff($stuff){
		echo '<pre>';
		echo '<strong><h1>Print : </h1></strong>';
		print_r($stuff);
		echo '<strong><h1>Echo : </h1></strong><br />';
		if(is_object($stuff)){ echo 'Variable is an object : <br />'; }
		echo '<strong><h1>Var Dump : </h1></strong><br />';
		var_dump($stuff);

	}
}