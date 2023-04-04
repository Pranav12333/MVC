<?php

require_once 'Controller/Core/Action.php';
require_once 'Model/category.php';

class Controller_Category extends Controller_Core_Action
{
	public $Categories = array();
	public $parentCategory = array();

	//set categories
	public function setCategories($categories)
	{
		$this->categories = $categories;
		return $this;
	}

	//get categories
	public function getCategories()
	{
		return $this->categories;
	}


	//set parentCategory
	public function setParentCategory($parentCategory)
	{
		$this->parentCategory = $parentCategory;
	}

	//get parentCategory
	public function getParentCategory()
	{
		return $this->parentCategory;
	}

	//show category grid page
	public function gridAction()
	{
		$CategoryModel = new Model_Category();
		$CategoryModel->setTableName('category');
		$CategoryModel->setPrimaryKey('category_id');
		$query = 'SELECT * FROM `category`';
		$categories = $CategoryModel->fetchAll($query);
		$this->setCategories($categories);
		$this->getTemplate('category/grid.phtml');

	}

	//add category page
	public function addAction()
	{
		$CategoryModel = new Model_Category();
		$CategoryModel->setTableName('category');
		$CategoryModel->setPrimaryKey('category_id');
		$query = 'SELECT * FROM `category`';
		$categories = $CategoryModel->fetchAll($query);
		$this->setCategories($categories);
		$this->getTemplate('category/add.phtml');
	}

	//insert in database
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			$this->errorAction('Failed to get from data!');
		}

		$category = $request->getPost('category');
		$category["created_at"] = date("y-m-d h:i:sa");
		$CategoryModel = new Model_Category();
		$CategoryModel->setTableName('category');
		$CategoryModel->setPrimaryKey('category_id');
		$query = 'SELECT * FROM `category`';
		$categories = $CategoryModel->fetchAll($query);

		// $paretnId = $category['parent_id']
		// $query = 'INSERT INTO `category` (`name`,`status`,`parent_id`,`description`,`created_at`) VALUES ("'.$category['name'].'","'.$category['status'].'","'.$paretnId.'","'.$category['description'].'","'.$dateTime.'")';
		$result = $CategoryModel->insert($category);
		if (!$request) {
			$this->errorAction("Failed to insert data");
		}

		$this->redirect("index.php?c=category&a=grid");
	}

	//show edit category page 
	public function editAction()
	{
		$request = $this->getRequest();
		$categoryId = $request->getParams('category_id');
		if (!$categoryId) {
			$this->errorAction('Invalid request!');
		}

		$CategoryModel = new Model_Category();
		$CategoryModel->setTableName('category');
		$CategoryModel->setPrimaryKey('category_id');
		$query =  'SELECT * FROM `category` WHERE `category_id` = "'.$categoryId.'"';
		$category = $CategoryModel->fetchRow($query);
		if (!$categoryId) {
			$this->errorAction('Invalid request!');
		}
		$this->setCategories($category);
		$this->getTemplate('category/edit.phtml');
	}

	//update data in db
	public function updateAction()
	{
		$request = $this->getRequest();
		$categoryId = (int) $request->getParams('category_id');
		if (!$request->isPost() || !$categoryId) {
			$this->errorAction('Failed to get form data !!!');
		}

		$category = $request->getPost('category');
		$category["updated_at"] = date("Y-m-d h:i:sa");
		
		$categoryModel = new Model_category();
		$categoryModel->setTableName('category');
		$categoryModel->setPrimaryKey('category_id');
		$result = $categoryModel->update($category,$categoryId);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}

		$this->redirect("index.php?c=category&a=grid");
	}

	// delete data from db
	public function deleteAction()
	{
		$request = $this->getRequest();
		$categoryId = (int) $request->getParams('category_id');
		if (!$categoryId) {
			$this->errorAction('Invalid request !!!');
		}

		$categoryModel = new Model_category();
		$categoryModel->setTableName('category');
		$categoryModel->setPrimaryKey('category_id');
		$result = $categoryModel->delete($categoryId);
		if (!$result) {
			$this->errorAction('Failed to delete data !!!');
		}
		$this->redirect('index.php?c=category&a=grid');
	}


}
?>