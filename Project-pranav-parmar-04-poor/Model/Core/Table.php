<?php 
/**
 * 
 */
class Model_Core_Table
{
	public $tablename = null;
	public $primaryKey = null;
	public $adapter = null;

	//set table name
	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	//get table name
	public function getTableName()
	{
		return $this->tableName;
	}

	//set primary key name
	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	//get primary key name
	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	//make and set adapter object
	public function setAdapter($adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter !== null) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	//fetchRow Method
	public function fetchRow($query)
	{
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($query);
		return $result;
	}

	//fetchAll Method
	public function fetchAll($query)
	{
		$adapter = $this->getAdapter();
		$result = $adapter->fetchAll($query);
		return $result;
	}

	public function load($id)
	{
		$adapter = $this->getAdapter();
		$query = 'SELECT * FROM `'.$this->getTableName().'` WHERE `'.$this->getPrimaryKey().'` = "'.$id.'"';
		$result = $adapter->fetchRow($query);
		return $result;
	}

	//insert Method
	public function insert($data)
	{
		$columns = "`".implode("`, `", array_keys($data)) . "`";
		$values = "'" . implode("', '", array_values($data))."'";
		$query = 'INSERT INTO `'.$this->tableName.'` ('.$columns.') VALUES ('.$values.')';
  		$adapter = $this->getAdapter();
		$result = $adapter->insert($query);
		return $result;
	}

	//update Method
	public function update($data, $condition)
	{
		$set = "";
		foreach ($data as $column => $value){
			$set .= '`'.$column.'` = "'.$value.'",';   
	}

		$set = rtrim($set, ", ");
		$where = "";
		if (is_array($condition)) {
			foreach ($condition as $column => $value) {
				$where .= '`'.$column.'` = "'.$value.'" AND ' ;
			}
		}else{
			$where = '`'.$this->primaryKey.'` = "'.$condition.'"'; 
		}

		$where = rtrim($where, " AND ");		
		$query = 'UPDATE `'.$this->tableName.'` SET '.$set.' WHERE '.$where;
		$adapter = $this->getAdapter();
		$result = $adapter->update($query);
		return $result;
	}

	//delete method
	public function delete($condition)
	{
		$where = "";
		if (is_array($condition)) {
			foreach ($condition as $column => $value) {
				$where .= '`'.$column.'` = "'.$value.'" AND ' ;
			}
		}else{
			$where = '`'.$this->primaryKey.'` = "'.$condition.'"'; 
		}

		$where = rtrim($where, " AND ");
		$query = 'DELETE FROM `'.$this->tableName.'` WHERE '.$where;
		$adapter = $this->getAdapter();
		$result = $adapter->delete($query);
		return $result;
	}
}

?>