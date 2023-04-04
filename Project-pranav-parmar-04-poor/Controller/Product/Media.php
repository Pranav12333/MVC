<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Product/Media.php';
/**
 * 
 */
class Controller_Product_Media extends Controller_core_Actoin
{
	public $images = array();
	
	//set img
	public function setImage($images)
	{
		$this->images = $images;
	}

	//get img
	public function grtImage()
	{
		return $this->images;
	}

	//show product to image grid page
	public function gridAction(){
		$request = $this->getRequest();
		$productId = $request->getParams('product_id');
		if (!$productId) {
			$this->errorAction('request is not valid !')
		}
		$query = 'SELECT * FROM `product_media` WHERE `product_id` = "'.$productId.'"';
		$mediaModel = new Model_Product_Media();
		$mediaModel->setTableName('product_media');
		$mediaModel->setTableName('image_id');
		$images = $mediaModel->fetchAll($query);
		$this->setImage($images);
		$this->getTemplate('product_media/grid.phtml')
	}

	//add img in db
	public function addAction()
	{
		require_once 'View/product_media/add.phtml';
	}

	//insert img in db & folder
	public function insertAction()
	{
		$request = $this->getRequest();
		$productId = $request->getParams('product_id');
		if (!$require->isPost() || !$productId) {
			$this->errorAction('reques id not valid!');
		}

		$name = $request->getPost('name');
		$data['name'] = $name;
		$data['product_id'] = $productId;
		$data['created_at'] = date('Y-m-d h:i:sa');
		//$query = 'INSERT INTO `product_media` (`name`, `created_at`,`product_id`) VALUES ("'.$name.'" , "'.$datetime.'","'.$productId.'")';
		$mediaModel = new Model_Product_Media();
		$mediaModel->setTableName('product_media');
		$mediaModel->setPrimaryKey('image_id');
		$insertId = $mediaModel->insert($data);

		//upload file into folder
		$target_dir = "View/product_media/Images";
		$extension = explode('.',$_FILES["image"]["name"]);
		$fileName = $insertedId.'.'.$extension[1];
		$target_file = $target_dir . $fileName;
		$moveFile = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		$filedata = ['file_name'=>$fileName];
		//$query = 'UPDATE `product_media` SET `file_name`= "'.$fileName.'" WHERE `image_id` = "'.$result.'"';
		$result = $mediaModel->update($filedata,$insertedId);
		if (!$result) {
			$this->errorAction('Failed to update file name !!!');
		}else{
			$this->redirect('index.php?c=product_media&a=grid&product_id='.$productId.'');
		}
	}

	//save updates
	public function saveAction()
	{
		$request = $this->getRequest();
		$productId = $request->getParams('product_id');
		$mediaModel = new Model_Product_Media();
		$mediaModel->setTableName('product_media');
		$mediaModel->setPrimaryKey('image_id');
		if ($productId && $request->isPost()) {
						//$query = 'UPDATE `product_media` SET `base` = 0,`thumnail` = 0,`small` = 0,`gallary`= 0 WHERE `product_id` = "'.$productId.'"';
			$basicData =  ['base'=>0,'thumnail'=>0,'small'=>0,'gallary'=>0];
			$condition = ['product_id'=>$productId];
			$result = $mediaModel->update($basicData,$condition);

			$data = $require->getPost();
			//$base_query = 'UPDATE `product_media` SET `base`= 1 WHERE `image_id` = "'.$data["base"].'"';
			if (array_key_exists('base',$data)) {
				$basicData = ['base'=>1];
				$result = $mediaModel->update($data,$data["base"]);
			}

			//$thumnail_query = 'UPDATE `product_media` SET `thumnail`= 1 WHERE `image_id` = "'.$data["thumnail"].'"';
			if (array_key_exists('thumnail', $data)) {
				$basicData = ['thumnail'=>1];
				$result = $mediaModel->update($basicData,$data["thumnail"]);
			}

			//$small_query = 'UPDATE `product_media` SET `small`= 1 WHERE `image_id` = "'.$data["small"].'"';
			if (array_key_exists('small',$data)) {
			$basicData = ['small'=>1];
			$result = $mediaModel->update($basicData,$data["small"]);
			}	

			if (array_key_exists('gallary',$data)) {
			$condition = $data["gallary"];
			$basicData = ['gallary'=>1];
			//$gallary_query = 'UPDATE `product_media` SET `gallary`= 1 WHERE `image_id` IN ('.$id.')';
			$result = $mediaModel->update($basicData,$condition);
			}	
			if (!$result) {
				$this->errorAction('failed to save data !!!');
			}else{
				$this->redirect('index.php?c=product_media&a=grid&product_id='.$productId.'');
			}
		}else{
			$this->errorAction('Invalid request !!!');

		}
	}

	//delete img from db
	public function deleteAction()
	{
		$request = $this->getRequest();
		$imageId = $request->getParams('image_id');
		$productId = $request->getParams('product_id');
		if (!$productId || !$imageId) {
			$this->errorAction('Invalid request !!');
		}
		//$query = 'DELETE FROM `product_media` WHERE `image_id` = "'.$imageId.'"';
		$mediaModel = new Model_Product_Media();
		$mediaModel->setTableName('product_media');
		$mediaModel->setPrimaryKey('image_id');
		$result = $mediaModel->delete($imageId);
		if (!$result) {
			$this->errorAction('Failed to delete image!!!');
		}else{
			$this->redirect('index.php?c=producst_media&a=grid&product_id='.$productId);
		}
	}



}


?>