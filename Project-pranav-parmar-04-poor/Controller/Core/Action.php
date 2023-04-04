<?php
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/Message.php';


class Controller_Core_Action
{
	public $request = null;
	public $adapter = null;
	public $message = null; 


	//redirecting the page
	protected function redirect($path)
	{
		header('Location:http://localhost/Project/'.$path);
		exit();
	}

	//throwing error
	public function errorAction($error)
	{
		throw new Exception($error, 1);
	}

	//set request variable
	protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	//make adapter request if null else return 
	public function getRequest()
	{
		if ($this->request) {
			return $this->request;
		}
		$request = new Model_Core_Request(); 
		$this->setRequest($request);
		return $request;
	}

	//function to require template in controller 
	public function getTemplate($templatePath)
	{
		require_once 'view' . DS . $templatePath;
	}

	//making and set adapter object
	public function setAdapter($adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter !== null) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}


	public function setMessage(Model_Core_Message $message)
	{	
		$this->message = $message;
		return $this;
	}	
	public function getMessage()
	{
		if ($this->message) {
			return $this->message;
		}
		$message = new Model_Core_Message();
		$this->setMessage($message);
		return $message;
 	}

}

?>