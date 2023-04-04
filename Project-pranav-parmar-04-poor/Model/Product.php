<?php

require_once 'core/Table.php';
	
class Model_Product extends Model_Core_Table
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_AVTIVE_LBL = 'Active';
	const STATUS_INAVTIVE_LBL = 'inactive';
	const STATUS_DEFAULT = 2;



	public $tablename = 'product';
	public $primaryKey = 'product_id';



	//set //get 

	// fetchRow($query) return $result pass query optional creat query and return 
	// fetchAll($query)   " "
	// insert($data[])  pass query on controller 
	// update($data[], $condition[]) (pass array an conditoin coloumn , value here are 	where and base on and)
	// delete($condition[]) setuation (array,key) array = where and int= 

}	

?>