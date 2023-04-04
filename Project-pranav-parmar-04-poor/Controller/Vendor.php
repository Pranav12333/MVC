<?php 
require_once 'Core/Action.php';
require_once 'Model/Vendor.php';
/**
 * 
 */
class Controller_Vendor extends Controller_Core_Action
{
	public $vendors = array();
	public $address = array();

	//fubnction to set vendors
	public function setVendors($vendors)
	{
		$this->vendors = $vendors;
	}

	//function to get vendors
	public function getVendors()
	{
		return $this->vendors;
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

	//function to show vendor page
	public function gridAction()
	{
		$query = 'SELECT * FROM `vendor`';
		$vendorModel = new Model_Vendor();
		$vendorModel->setTableName('vendor');
		$vendorModel->setPrimaryKey('vendor_id');
		$vendors = $vendorModel->fetchAll($query);
		$this->setVendors($vendors);
		$this->getTemplate('vendor/grid.phtml');
	}
	
	//function to show add vendor page
	public function addAction()
	{
		$this->getTemplate('vendor/add.phtml');
	}
	
	//function to insert vendor data into database
	public function insertAction()
	{

		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to fetch data !!!');
		}

		$vendor = $request->getPost('vendor');
		$vendor["created_at"] = date("Y-m-d h:i:sa");
		$vendorModel = new Model_Vendor();
		$vendorModel->setTableName('vendor');
		$vendorModel->setPrimaryKey('vendor_id');
		//$query = 'INSERT INTO `vendor` (`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`) VALUES ("'.$vendor['first_name'].'","'.$vendor['last_name'].'","'.$vendor['email'].'","'.$vendor['gender'].'","'.$vendor['mobile'].'","'.$vendor['status'].'","'.$vendor['company'].'","'.$dateTime.'")';
		$result = $vendorModel->insert($vendor);
		if (!$result) {
			$this->errorAction('Failed to insert vendor data !!!');
		}

			$this->redirect('index.php?c=vendor&a=grid');
	}
	
	//function to show edit vendor page
	public function editAction()
	{
		$request = $this->getRequest();
		$vendorId = $request->getParams('vendor_id');
		if (!$vendorId) {
			$this->errorAction('Invalid request !!!');
		}

		$query = 'SELECT * FROM `vendor` WHERE `vendor_id` = "'.$vendorId.'"';
		$vendorModel = new Model_Vendor();
		$vendorModel->setTableName('vendor');
		$vendorModel->setPrimaryKey('vendor_id');
		$vendor = $vendorModel->fetchRow($query);
		if (!$vendor) {
			$this->errorAction('Invalid request!!!');
		}
		$this->setVendors($vendor);
		$this->getTemplate('vendor/edit.phtml');
	}
	
	//function to update vendor data into database
	public function updateAction()
	{
		$request = $this->getRequest();
		$vendorId = $request->getParams('vendor_id');
		if (!$request->isPost() || !$vendorId) {
			$this->errorAction('Failed to fetch data !!!');
		}

		$vendor = $request->getPost('vendor');
		$vendor["updated_at"] = date("Y-m-d h:i:sa");
		/*$query = 'UPDATE `vendor` SET `first_name`="'.$vendor['first_name'].'",
										`last_name`="'.$vendor['last_name'].'",
										`email`="'.$vendor['email'].'",
										`mobile`="'.$vendor['mobile'].'",
										`gender`="'.$vendor['gender'].'",
										`status`="'.$vendor['status'].'",
										`company`="'.$vendor['company'].'",
										`updated_at`="'.$dateTime.'" WHERE `vendor_id` = "'.$vendorId.'"';*/
		$vendorModel = new Model_Vendor();
		$vendorModel->setTableName('vendor');
		$vendorModel->setPrimaryKey('vendor_id');
		$result = $vendorModel->update($vendor,$vendorId);
		if (!$result) {
			$this->errorAction('Failed to update vendor data !!!');
		}
			$this->redirect('index.php?c=vendor&a=grid');

	}
	
	//function to delete vendor data from database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$vendorId = $request->getParams('vendor_id');
		if (!$vendorId) {
			$this->errorAction('Invalid request !!!');
		}

		//$query = 'DELETE FROM `vendor` WHERE `vendor_id` = "'.$vendorId.'"';
		$vendorModel = new Model_Vendor();
		$vendorModel->setTableName('vendor');
		$vendorModel->setPrimaryKey('vendor_id');
		$result = $vendorModel->delete($vendorId);
		if (!$result) {
			$this->errorAction('Failed TO delete vendor data');
		}	
		$this->redirect('index.php?c=vendor&a=grid');

	}
	

}


?>