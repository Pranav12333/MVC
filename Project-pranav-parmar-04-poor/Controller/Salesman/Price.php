<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman/Price.php';


/**
 * 
 */
class Controller_Salesman_Price extends Controller_core_Actoin
{
	public $prices = array();

	//set price
	public function setPrices($prices)
	{
		$this->prices = $prices;;
	}
	//get price
	public function getPrices()
	{
		return $this->prices;
	}

	// set salesman
	public function setSalesman($salesman)
	{
		$this->salesman = $salesman;		
	}

	//get salesman
	public function getSalesman()
	{
		return $this->salesman;		
	}

	//show grid
	public function gridAction()
	{
		$request = $this->getRequest();
		$salesmanId = $request->getParams('salesman_id');
		if (!$salesmanId) {
			$this->errorAction('Invalid request !!!');
		}
		$query = 'SELECT * FROM `salesman` WHERE 1';
		$priceModel = new Model_Salesman_Price();
		$priceModel->setTableName('salesman_price');
		$priceModel->setPrimaryKey('entity_id');
		$salesmen = $priceModel->fetchAll($query);
		$this->setSalesmen($salesmen);
		$join_query = 'SELECT SP.entity_id, SP.salesman_price, P.sku_id, P.cost, P.price, P.product_id FROM `product` P LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = '.$salesmanId.'';
		$salesman_prices = $priceModel->fetchAll($join_query);
		$this->setPrices($salesman_prices);
		$this->getTemplate('salesman_price/grid.phtml');
	}

	//update salesman price
	public function updateAction()
	{
		$request = $this->getRequest();
		$changed_prices = $request->getPost('salesman_price');
		$salesmanId = $request->getParams('salesman_id');
		if (!$request->isPost() || !$salesmanId) {
			$this->errorAction('request is not valid !');
		}		
		foreach ($changed_prices as $key => $value){
			$search_query = 'SELECT `entity_id` FROM `salesman_price` WHERE `product_id` = '.$key.' AND `salesman_id` = '.$salesmanId.'';
			$priceModel = new Model_Salesman_Price();
			$priceModel->setTableName('salesman_price');
			$priceModel->setPrimaryKey('entity_id');
			$result = $priceModel->fetchAll($search_query);
				if ($result) {
					// code...
					//$updateQuery = 'UPDATE `salesman_price` SET `salesman_price` = "'.$value.'" WHERE `product_id` = '.$key.' AND `salesman_id` = '.$salesmanId.'';
					$data = ['salesman_price'=>$value,'product_id'=>$key];
					$condition = ['salesman_id'=>$salesmanId,'product_id'=>$key];
					$result = $priceModel->update($data,$condition);	
				}
				else{
					if($value != '') {
						//$insertQuery = 'INSERT INTO `salesman_price` (`product_id`, `salesman_id`, `salesman_price`) VALUES ('.$key.','.$salesmanId.','.$value.')';
						$data = ['salesman_price'=>$value,'product_id'=>$key,'salesman_id'=>$salesmanId];
						$result = $priceModel->insert($data);
					}
				}
		}
		$this->redirect('index.php?c=salesman_price&a=grid&salesman_id'.$salesmanId);
	}

	//remove salesman price
	public function deleteAction()
	{
		$request = $this->getRequest();
		$entityId = $request->getParams('entity_id');
		$salesmanId = $request->getParams('salesman_id');
		if (!$salesmanId || !$entityId) {
			$this->errorAction('Invalid request !!!');
		}
		//$query = 'DELETE FROM `salesman_price` WHERE `entity_id` = '.$entityId.'';
		$priceModel = new Model_Salesman_Price();
		$priceModel->setTableName('salesman_price');
		$priceModel->setPrimaryKey('entity_id');
		$result = $priceModel->delete($entityId);
		if (!$result) {
			$this->errorAction('Failed to delete salesman price');
		}else{
			$this->redirect('index.php?c=salesman_price&a=grid&salesman_id='.$salesmanId);
		}
	}
}







?>