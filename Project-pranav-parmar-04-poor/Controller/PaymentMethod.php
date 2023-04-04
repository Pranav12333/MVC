<?php

require_once 'Core/Action.php';
require_once 'Model/PaymentMethod.php';


/**
 * 
 */
class Controller_PaymentMethod extends Controller_Core_Action
{
	public $payments = array();

	//fubnction to set payments
	public function setPayments($payments)
	{
		$this->payments = $payments;
	}

	//function to get payments
	public function getPayments()
	{
		return $this->payments;
	}

	//function to show payment page
	public function gridAction()
	{
		$query = 'SELECT * FROM `payment_method`';
		$paymentModel = new Model_PaymentMethod();
		$paymentModel->setTableName('payment');
		$paymentModel->setPrimaryKey('payment_method_id');
		$payments = $paymentModel->fetchAll($query);
		$this->setPayments($payments);
		$this->getTemplate('PaymentMethod/grid.phtml');
	}
	
	//function to show add payment page
	public function addAction()
	{
		$this->getTemplate('PaymentMethod/add.phtml');
	}
	
	//function to insert data in payment database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to fetch data !!!');
		}
		$payment = $request->getPost('paymentmethod');
		$payment["created_at"] = date("Y-m-d h:i:sa");
		//$query = 'INSERT INTO `payment`(`name`,`status`,`created_at`) VALUES ("'.$payment['name'].'","'.$payment['status'].'","'.$dateTime.'")';
		$paymentModel = new Model_PaymentMethod();
		$paymentModel->setTableName('payment_method');
		$paymentModel->setPrimaryKey('payment_method_id');
		$result = $paymentModel->insert($payment);
		if (!$result) {
			$this->errorAction('Failed to insert data !!!');
		}else{
			$this->redirect('index.php?c=paymentmethod&a=grid');
		}
	}
	
	//function to show payment edit page 
	public function editAction()
	{
		$request = $this->getRequest();
		$paymentId = $request->getParams('paymentmethod_id');
		if (!$paymentId) {
			$this->errorAction('Invalid request !!!');
		}
		$query = 'SELECT * FROM `payment_method` WHERE `payment_method_id` = "'.$paymentId.'"';
		$paymentModel = new Model_PaymentMethod();
		$paymentModel->setTableName('payment_method');
		$paymentModel->setPrimaryKey('payment_id');
		$payment = $paymentModel->fetchRow($query);
		if (!$payment) {
			$this->errorAction('Invalid request !!!');
		}
		$this->setPayments($payment);
		$this->getTemplate('PaymentMethod/edit.phtml');
	}
	
	//function to update payment
	public function updateAction()
	{
		$request = $this->getRequest();
		$paymentId = $request->getParams('payment_method_id');
		if (!$request->isPost() || !$paymentId) {
			$this->errorAction('Invalid request !!!!');
		}
		$payment = $request->getPost('paymentmethod');
		$payment["updated_at"] = date("Y-m-d h:i:sa");
		//$query = 'UPDATE `payment` SET `name` = "'.$payment['name'].'",`status` = "'.$payment['status'].'",`updated_at` = "'.$dateTime.'" WHERE `payment_id` = "'.$paymentId.'"';
		$paymentModel = new Model_PaymentMethod();
		$paymentModel->setTableName('payment_method');
		$paymentModel->setPrimaryKey('payment_method_id');
		$result = $paymentModel->update($payment,$paymentId);
		if (!$result) {
			$this->errorAction('Failed to update data !!!');
		}else{
			$this->redirect('index.php?c=paymentmethod&a=grid');
		}
	}
	
	//function to delete payment from database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$paymentId = $request->getParams('paymentmethod_id');
		if (!$paymentId) {
			$this->errorAction('Invalid request !!!');
		}
		//$query = 'DELETE FROM `payment` WHERE `payment_id` = "'.$paymentId.'"';
		$paymentModel = new Model_PaymentMethod();
		$paymentModel->setTableName('payment_method');
		$paymentModel->setPrimaryKey('payment_method_id');
		$result = $paymentModel->delete($paymentId);
		if (!$result) {
			$this->errorAction('Failed to delete data');
		}else{
			$this->redirect('index.php?c=Paymentmethod&a=grid');
		}
	}
}



?>