<?php
/**
 * 
 */
class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		echo '<pre>';
		$query = "SELECT * FROM `admin` ORDER BY `admin_id` DESC;";


		$admins = Ccc::getModel('Admin_Row')->load(2);

		$this->setTemplate('')->render();


		$this->getView()->setTemplate('')->setData([]);

		$this->render();
		
	}


}






?>