<?php 
require_once 'Core/Action.php';
require_once 'Model/ShippingMethod.php';
/**
 * 
 */
class Controller_ShippingMethod extends Controller_Core_Action
{
	public $shippings = array();

	//fubnction to set shippings
	public function setShippings($shippings)
	{
		$this->shippings = $shippings;
	}

	//function to get shippings
	public function getShippings()
	{
		return $this->shippings;
	}
	
	//funcion to show shipping grid page 	
	public function gridAction()
	{
		$query = 'SELECT * FROM `shipping_method`';
		$shippingModel = new Model_ShippingMethod();
		$shippingModel->setTableName('shipping_method');
		$shippingModel->setPrimaryKey('shipping_method_id');
		$shippings = $shippingModel->fetchAll($query);
		$this->setShippings($shippings);
		$this->getTemplate('ShippingMethod/grid.phtml');
	}
	
	//function to show add page 
	public function addAction()
	{
		$this->getTemplate('ShippingMethod/add.phtml');
	}
	
	//functhion to insert shipping data into database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to fetch data !!!');
		}
		$shipping = $request->getPost('shipping_method');
		$product["created_at"] = date("Y-m-d h:i:sa");
		//$query = 'INSERT INTO `shipping`(`name`,`amount`,`status`,`created_at`) VALUES ("'.$shipping['name'].'","'.$shipping['amount'].'","'.$shipping['status'].'","'.$dateTime.'")';

		$shippingModel = new Model_ShippingMethod();
		$shippingModel->setTableName('shipping_method');
		$shippingModel->setPrimaryKey('shipping_method_id');
		$result = $shippingModel->insert($shipping);
		if (!$result) {
			$this->errorAction('Failed to insert data !!');
		}else{
			$this->redirect('index.php?c=ShippingMethod&a=grid');
		}
	}
	
	//function to show edit page
	public function editAction()
	{
		$request = $this->getRequest();
		$shippingId = $request->getParams('shippingmethod_id');
		if (!$shippingId) {
			$this->errorAction('Invalid request !!!');
		}
		$query = 'SELECT * FROM `shipping_method` WHERE `shipping_method_id` = "'.$shippingId.'"';
		$shippingModel = new Model_ShippingMethod();
		$shippingModel->setTableName('shipping_method');
		$shippingModel->setPrimaryKey('shipping_method_id');
		$shipping = $shippingModel->fetchRow($query);
		if (!$shipping) {
			$this->errorAction('Invalid request !!!');
		}
		$this->setShippings($shipping);
		$this->getTemplate('ShippingMethod/edit.phtml');
	}
	
	//function to update shipping data into database
	public function updateAction()
	{
		$request = $this->getRequest();
		$shippingId = $request->getParams('shipping_method_id');
		if (!$request->isPost() || !$shippingId) {
			$this->errorAction('Failed to fetch data !!!');
		}
		$shipping = $request->getPost('shipping_method');
		$shipping["updated_at"] = date("Y-m-d h:i:sa");
		//$query = 'UPDATE `shipping` SET `name` = "'.$shipping['name'].'",`amount` = "'.$shipping['amount'].'",`status` = "'.$shipping['status'].'",`updated_at` = "'.$dateTime.'" WHERE `shipping_id` = "'.$shippingId.'"';
		$shippingModel = new Model_ShippingMethod();
		$shippingModel->setTableName('shipping_method');
		$shippingModel->setPrimaryKey('shipping_method_id');
		$result = $shippingModel->update($shipping,$shippingId);
		if (!$result) {
			$this->errorAction('Failed to update data !!!');			
		}else{
			$this->redirect('index.php?c=ShippingMethod&a=grid');
		}
	}
	
	//function to delete shipping data from database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$shippingId = $request->getParams('shippingmethod_id');
		if (!$shippingId) {
			$this->errorAction('Failed to fetch data !!!');
		}
		//$query = 'DELETE FROM `shipping` WHERE `shipping_id` = "'.$shippingId.'"';
		$shippingModel = new Model_ShippingMethod();
		$shippingModel->setTableName('shipping_method');
		$shippingModel->setPrimaryKey('shipping_method_id');
		$result = $shippingModel->delete($shippingId);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}else{
			$this->redirect('index.php?c=shippingmethod&a=grid');
		}
	}
}


?>