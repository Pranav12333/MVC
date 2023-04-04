<?php

require_once 'Core/Action.php';
require_once 'Model/Product.php';
// require_once 'Model/Core/Row.php';



class Controller_Product extends Controller_Core_Action
{

	protected $products = array();

	public function setProducts($products)
	{
		$this->products = $products;
	}

	public function getProducts()
	{
		return $this->products;
	}



	//function to show main grid file
	public function gridAction()  
	{
		$query = 'SELECT * from `product`';
		$productModel = new Model_Product();
		$productModel->setTableName('product');
		$productModel->setPrimaryKey('product_id');
		$products = $productModel->fetchAll($query);
		$this->setProducts($products);
		$this->getTemplate('product/grid.phtml');
	}
	
	//function to show add peoduct page
	public function addAction()
	{
		$this->getTemplate('product/add.phtml');
	}
	
	//function to show edit product page 
	public function editAction()
	{
		$request = $this->getRequest();
		$productId = (int) $request->getParams('product_id');
		if (!$productId) {
			$this->errorAction('Failed to get form data !!!');
		}

		$query = 'SELECT *  FROM `product` WHERE `product_id` = "'.$productId.'"';
		$productModel = new Model_Product();
		$productModel->setTableName('product');
		$productModel->setPrimaryKey('product_id');
		$product = $productModel->fetchRow($query);
		if (!$product) {
			$this->errorAction('Invalid request !!!');
		}

		$this->setProducts($product);
		$this->getTemplate('product/edit.phtml');
	}
	
	//function to insert product in database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to get form data !!!');
		}

		$product = $request->getPost('product');
		$product["created_at"] = date("Y-m-d h:i:sa");
		$productModel = new Model_Product();
		$productModel->setTableName('product');
		$productModel->setPrimaryKey('product_id');
		$result = $productModel->insert($product);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}

		$this->redirect('index.php?c=product&a=grid');
	}
	
	//function to update product in database
	public function updateAction()
	{
		$request = $this->getRequest();
		$productId = (int) $request->getParams('product_id');
		if (!$request->isPost() || !$productId) {
			$this->errorAction('Failed to get form data !!!');
		}

		$product = $request->getPost('product');
		$product["updated_at"] = date("Y-m-d h:i:sa");
		
		$productModel = new Model_Product();
		$productModel->setTableName('product');
		$productModel->setPrimaryKey('product_id');
		$result = $productModel->update($product,$productId);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}

		$this->redirect("index.php?c=product&a=grid");
	}
	
	//function to delete product in database
	public function deleteAction()
	{
		$request = $this->getRequest();
		$productId = (int) $request->getParams('product_id');
		if (!$productId) {
			$this->errorAction('Invalid request !!!');
		}

		$productModel = new Model_Product();
		$productModel->setTableName('product');
		$productModel->setPrimaryKey('product_id');
		$result = $productModel->delete($productId);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}
		$this->redirect('index.php?c=product&a=grid');
	}
}



?>