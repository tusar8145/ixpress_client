<?php
class Database
{
      
    private $host = "dbaas-db-5751461-do-user-13243543-0.b.db.ondigitalocean.com:25060";
    private $db_name = "ixpress_db_main";
    private $username = "ixpress_user";
    private $password = "AVNS_8WD5OLBckXkgKHBpDKU";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>

 