<?php
Class URI{
	var $uri;
	var $segments = array();
	var $params   = array();
	
	public function __construct(){
		$this->uri = $_SERVER['QUERY_STRING'];
	}
	
	public function getURI(){
		if ( isset($this->uri) ){
			foreach ( explode('/', $this->validate_URI( $this->uri )) as $val )
			{
				if ( $val != '' )
				{
						$var = explode('&', $val);
						$this->segments[] = $var[0];
				}
			}
			return $this->segments;
		}
	}
	
	public function validate_URI( $URI ){
		if (!EMPTY ( $URI )){
			$find = array("'",";","*","(",")","^","%");
			return str_replace($find ,"/", $URI);
		}
	}	
	
	public function getParams( $segments ){
	
	}
	
}
?>