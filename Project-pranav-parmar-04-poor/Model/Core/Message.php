<?php
require_once 'Model/Core/Session.php';


class Model_Core_Message{
protected $session = null;
const SUCCESS = 'success';
const FAILURE = 'failure';
const NOTICE = 'notice';

public function __construct(){
	$this->getSession ;
}




public function addMessage($message , $type = 'success')
	{
		if(!type){
			$type = self::SUCCESS;
		}

		if (!$this->getSession()->has('message')) {
			$this->getSession()->set('message',[]);
		}
		$messages = $this->getMessages();
		$messages[$type] = $message;
		$this->getSession()->set($message);
		return $this;		

	}
	
	public function clearMessage()
	{
		this->getSession()->unset('message');
		return $this;
	}
	
	public function getMessage()
	{

		if ($this->getSession()->has('message')) {
			return null;
		}

		return $this->getSession;
	}
}


?>