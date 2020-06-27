<?php
class Database{
 
// specify database credentials
    private $host = "localhost";
    private $db_name = "cronjob";
    private $username = "root";
    private $password = "root";
    public $conn;
    
	public function getConnection() {
        
		$this->conn = mysqli_connect($this->host,$this->username, $this->password,$this->db_name);	
		if(mysqli_connect_errno()) {
		die("Data connection failed badly" . mysqli_error());
		}
//		else
//		echo "sucessful connected to database...";
	}
    
    public function query($sql) {
		$result = mysqli_query($this->conn,$sql);
		return $result;
	}
}
?>