<?php
class dataBase{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname="unbundl";
    public $conn="";

    function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        $sql = "CREATE DATABASE inquery_details";

        // if ($this->conn->query($sql) === TRUE) {
        //     echo "<script>alert('Database created successfully')</script>";
        //     $this->conn->close();
        // } else {
        //     echo "<script>alert('Database already created ')</script>";
        //     $this->conn->close();
        // }
    }

    public function adminDbConn(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

}
?>