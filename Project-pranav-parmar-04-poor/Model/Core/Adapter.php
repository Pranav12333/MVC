<?php 

/**
 * 
 */
class Model_Core_Adapter
{
    public $serverName = 'localhost';
    public $userName = 'root';
    public $passWord = '';
    public $dbName = 'Project-pranav-parmar';

    //function to connect with database
    public function connect()
    {
        $connect = mysqli_connect($this->serverName,$this->userName,$this->passWord,$this->dbName);
        return $connect;
    }


    //function to fetch all data
    public function fetchAll($query)
    {
        $connect = $this->connect();
        $result = $connect->query($query);
        if(!$result){
            return false;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    //function to fetch one row
    public function fetchRow($query)
    {
        $connect = $this->connect();
        $result = $connect->query($query);
        if (!$result) {
            return false;
        }
        return $result->fetch_assoc();
    }


    //function to insert data into database table
    public function insert($query)
    {
        $connect = $this->connect();
        $result = $connect->query($query);
        if (!$result) {
            return false;
        }
        return $connect->insert_id;
    }

    
    //function to update data into database table
    public function update($query)
    {
        $connect = $this->connect();
        $result = $connect->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    //function to delete data from database table
    public function delete($query)
    {
        $connect = $this->connect();
        $result = $connect->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

}

?>