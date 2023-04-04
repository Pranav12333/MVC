<?php
require_once 'Model/Core/Table.php';
/**
 * 
 */
class Model_Product_Media extends Model_Core_Table
{
	//update
 	public	function update($data , $condition)
	{
		$set="";
		foreach ($data as $column => $value){
			$set .='`'.$column.'`="'.$value.'"';
		}

		$set = rtrim($set,",");
		$where = "";
		if (!array_key_exists('product_id',$condition)) {
			if (!array_key_exists('product_id',$condition)) {
			$ids = join(',',$condition);
			$where = '`'.$column.'`='
			}
			else{
				foreach($condition as $column => $value){
                    $where .= '`'.$column.'` = "'.$value.'" AND ' ;
				}
			}

		}

	}
}





?>