<?php



class Model_Core_Table_Row
{
	public $data = [];
	public $key = 'product_id';
	public $tablename = '';

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key){
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function setData($data)
	{
		$this->data = $data;
		return $this
	}

	public function getData($key=null)
	{
		if ($key == null) {
			return $this->data;
		}
		if(array_key_exists($key, $this->data))
		{
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if(array_key_exists($key,$this->data)){
			unset($this->data[$key]);
		}
		return $this;
	}
	public function __save(){
		return $this->data;
	}

	public function fetchAll($query){
		return $this->getTable()->fetchAll($query);
		return $result;
	}
	
	public function fetchRow($query){
		$result = $this->getTable()->fetchRow($query);
		return $result;
	}	

	public function insert(){

	}

	public function load($id, $column = null)
	{
		if(!$column){

		}
	}






}



?>