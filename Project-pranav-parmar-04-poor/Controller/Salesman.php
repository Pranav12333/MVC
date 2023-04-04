<?php

require_once 'Core/Action.php';
require_once 'Model/Salesman.php';

/**
 * 
 */
class Controller_Salesman extends Controller_Core_Action
{
	public $salesmen = array();
	public $address = array();

	//fubnction to set salesmen
	public function setSalesmen($salesmen)
	{
		$this->salesmen = $salesmen;
	}

	//function to get salesmen
	public function getSalesmen()
	{
		return $this->salesmen;
	}



	//function to show salesman page
	public function gridAction()
	{
		$salesmanModel = new Model_salesman();
		$salesmanModel->setTableName('salesman');
		$salesmanModel->setPrimaryKey('salesman_id');
		$query = 'SELECT * FROM `salesman`';
		$salesmen = $salesmanModel->fetchAll($query);
		$this->setSalesmen($salesmen);
		$this->getTemplate('salesman/grid.phtml');
	}
	
	//function to show add salesman page
	public function addAction()
	{
		$this->getTemplate('salesman/add.phtml');
	}
	
	//function to insert salesman data into database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Invalid request !!!');
		}
		
		$salesman = $request->getPost('salesman');
		$salesman["created_at"] = date("Y-m-d h:i:sa");
		$salesmanModel = new Model_salesman();
		$salesmanModel->setTableName('salesman');
		$salesmanModel->setPrimaryKey('salesman_id');
		//$query = 'INSERT INTO `salesman` (`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`) VALUES ("'.$salesman['first_name'].'","'.$salesman['last_name'].'","'.$salesman['email'].'","'.$salesman['gender'].'","'.$salesman['mobile'].'","'.$salesman['status'].'","'.$salesman['company'].'","'.$dateTime.'")';
		$result = $salesmanModel->insert($salesman);
		if (!$result) {
			$this->errorAction('Failed to insert salesman data !!!');
		}

		$this->redirect('index.php?c=salesman&a=grid');
	}
	
	//function to show edit salesman page
	public function editAction()
	{
		$request = $this->getRequest();
		$salesmanId = $request->getParams('salesman_id');
		if (!$salesmanId) {
			$this->errorAction('Invalid request !!!');
		}

		$query = 'SELECT * FROM `salesman` WHERE `salesman_id` = "'.$salesmanId.'"';
		$salesmanModel = new Model_salesman();
		$salesmanModel->setTableName('salesman');
		$salesmanModel->setPrimaryKey('salesman_id');
		$salesman = $salesmanModel->fetchRow($query);
		if (!$salesman) {
			$this->errorAction('Invalid request!!!');
		}
		$this->setSalesmen($salesman);

		$this->getTemplate('salesman/edit.phtml');
	}


	//function to update salesman data into database
	public function updateAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Invalid request !!!');
		}

		$salesman = $request->getPost('salesman');
		$salesman["updated_at"] = date("Y-m-d h:i:sa");
		$salesmanId = $request->getParams('salesman_id');
		if (!$salesmanId) {
			$this->errorAction('Invalid request !!!');
		}

		/*$query = 'UPDATE `salesman` SET `first_name`="'.$salesman['first_name'].'",
										`last_name`="'.$salesman['last_name'].'",
										`email`="'.$salesman['email'].'",
										`mobile`="'.$salesman['mobile'].'",
										`gender`="'.$salesman['gender'].'",
										`status`="'.$salesman['status'].'",
										`company`="'.$salesman['company'].'",
										`updated_at`="'.$dateTime.'" WHERE `salesman_id` = "'.$salesmanId.'"';*/
		$salesmanModel = new Model_Salesman();
		$salesmanModel->setTableName('salesman');
		$salesmanModel->setPrimaryKey('salesman_id');
		$result = $salesmanModel->update($salesman,$salesmanId);
		if (!$result) {
			$this->errorAction('Failed to update salesman data !!!');
		}

			$this->redirect('index.php?c=salesman&a=grid');
	}
	
	//function to delete salesman data from database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$salesmanId = $request->getParams('salesman_id');
		if (!$salesmanId) {
			$this->errorAction('Invalid request !!!');
		}

		//$query = 'DELETE FROM `salesman` WHERE `salesman_id` = "'.$salesmanId.'"';
		$salesmanModel = new Model_Salesman();
		$salesmanModel->setTableName('salesman');
		$salesmanModel->setPrimaryKey('salesman_id');
		$result = $salesmanModel->delete($salesmanId);
		if (!$result) {
			$this->errorAction('Failed TO delete salesman data');
		}
			$this->redirect('index.php?c=salesman&a=grid');
		}
	
}


?>