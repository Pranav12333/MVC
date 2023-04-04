<?php
require_once 'Model/Core/Request.php';
class Url
{
	
	public function getCurrentUrl()
	{
		echo "<pre>";
		print_r($_SERVER);

	}
	
	public function getUrl( $controller = null , $action = null , $param = null, $resetParam = null )
	{

		$request = new Model_Core_Request();
		
		$final = [];


		if ($controller) {
			$final['c'] = $controller;
		}
		else{
			$final['c'] = $request->getController();
		}

		if ($action) {
			$final['action'] = $action;
		}
		else{
			$final['action'] = $request->getActionName();
		}

		$queryString = http_build_query($final);


		echo $requestUri = trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
		echo"<br>";
		$url =	$_SERVER['$REQUEST_SCHEME']."://". $_SERVER['HTTP_HOST'] . $requestUri . $queryString;
		return $url;		
	}




}

?>