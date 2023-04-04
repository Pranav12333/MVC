<?php

require_once 'Core/Action.php';
require_once 'Model/Customer.php';



/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{

	public $customeres = array();
	public $address = array();

	//fubnction to set customeres
	public function setCustomeres($customeres)
	{
		$this->customeres = $customeres;
	}

	//function to get customeres
	public function getCustomeres()
	{
		return $this->customeres;
	}

	//fubnction to set address
	public function setAddress($address)
	{
		$this->address = $address;
	}

	//function to get address
	public function getAddress()
	{
		return $this->address;
	}	

	//function to show customer page
	public function gridAction()
	{
		$customerModel = new Model_Customer();
		$customerModel->setTableName('customer');
		$customerModel->setPrimaryKey('customer_id');
		$query = 'SELECT * FROM `customer`';
		$customeres = $customerModel->fetchAll($query);
		$this->setCustomeres($customeres);
		$this->getTemplate('customer/grid.phtml');
	}
	
	//function to show add customer page
	public function addAction()
	{
		$this->getTemplate('customer/add.phtml');
	}
	
	//function to insert customer data into database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to fetch data !!!');
		}

		$customer = $request->getPost('customer');
		$customer["created_at"] = date("Y-m-d h:i:sa");
		$customerModel = new Model_Customer();
		$customerModel->setTableName('customer');
		$customerModel->setPrimaryKey('customer_id');
		//$query = 'INSERT INTO `customer` (`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`created_at`) VALUES ("'.$customer['first_name'].'","'.$customer['last_name'].'","'.$customer['email'].'","'.$customer['gender'].'","'.$customer['mobile'].'","'.$customer['status'].'","'.$dateTime.'")';
		$result = $customerModel->insert($customer);
		if (!$result) {
			$this->errorAction('Failed to insert customer data !!!');
		}
		$this->redirect("index.php?c=customer&a=grid");
	}
	
	//function to show edit customer page
	public function editAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getParams('customer_id');
		if (!$customerId) {
			$this->errorAction('Invalid request !!!');
		}

		$query = 'SELECT * FROM `customer` WHERE `customer_id` = "'.$customerId.'"';
		$customerModel = new Model_Customer();
		$customerModel->setTableName('customer');
		$customerModel->setPrimaryKey('customer_id');
		$customer = $customerModel->fetchRow($query);
		if (!$customer) {
			$this->errorAction('Invalid request!!!');
		}
		$this->setCustomeres($customer);
		$this->getTemplate('customer/edit.phtml');
	}
	
	//function to update customer data into database
	public function updateAction()
	{
		$dateTime = date("Y-m-d h:i:sa");
		$request = $this->getRequest();
		$customerId = $request->getParams('customer_id');
		if (!$request->isPost() || !$customerId) {
			$this->errorAction('Failed to fetch data !!!');
		}


		$customer = $request->getPost('customer');
		$customer["updated_at"] = date("Y-m-d h:i:sa");
		/*$query = 'UPDATE `customer` SET `first_name`="'.$customer['first_name'].'",
`last_name`="'.$customer['last_name'].'",`email`="'.$customer['email'].'",`mobile`="'.$customer['mobile'].'",`gender`="'.$customer['gender'].'",`status`="'.$customer['status'].'",`updated_at`="'.$dateTime.'" WHERE `customer_id` = "'.$customerId.'"';*/

		$customerModel = new Model_Customer();
		$customerModel->setTableName('customer');
		$customerModel->setPrimaryKey('customer_id');
		$result = $customerModel->update($customer,$customerId);
		if (!$result) {
			$this->errorAction('Failed to update customer data !!!');
		}

			$this->redirect('index.php?c=customer&a=grid');
	}
	
	//function to delete customer data from database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getParams('customer_id');
		if (!$customerId) {
			$this->errorAction('Invalid request !!!');
		}

		//$query = 'DELETE FROM `customer` WHERE `customer_id` = "'.$customerId.'"';
		$customerModel = new Model_Customer();
		$customerModel->setTableName('customer');
		$customerModel->setPrimaryKey('customer_id');
		$result = $customerModel->delete($customerId);
		if (!$result) {
			$this->errorAction('Failed TO delete Customer data');
		}
			$this->redirect('index.php?c=customer&a=grid');
	}
	
	//function to show customer address data
	public function addressAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getParams('customer_id');
		if (!$customerId) {
			$this->errorAction('Invalid request !!!');
		}
		
		$query = 'SELECT * FROM `customer_address` WHERE `address_id` = "'.$customerId.'"';
		$customerAddressModel = new Model_Customer();
		$customerAddressModel->setTableName('customer_address');
		$customerAddressModel->setPrimaryKey('address_id');
		$address = $customerAddressModel->fetchRow($query);
		if (!$address) {
			$this->errorAction('Invalid request !!!');
		}

		$this->setAddress($address);		
		$this->getTemplate('customer/address.phtml');
	}
}



?>
