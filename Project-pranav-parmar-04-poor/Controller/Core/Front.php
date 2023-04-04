<?php
require_once 'Model/Core/Request.php';
/**
 * 
 */
class Controller_Core_Front
{
	public function init()
	{
		$request = new Model_Core_Request();
		$a = $request->getActionName();
		$c = $request->getControllerName();

		$action = $a."Action";
		$className = "Controller_".ucfirst($c);
		$path = "Controller/".ucfirst($c).".php";			
		require_once $path;
		
		$c = new $className();
		$c->$action();

	}

}

?>