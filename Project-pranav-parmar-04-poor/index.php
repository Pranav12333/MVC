<?php
require_once 'Controller/Core/Front.php';
define('DS',DIRECTORY_SEPARATOR);

/**
 * 
 */
class Ccc
{
	public static function init()
	{
		$front = new Controller_Core_front();
		$front->init();

	}
}
Ccc::init();
?>




