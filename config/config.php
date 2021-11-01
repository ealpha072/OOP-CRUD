<?php

    class Database{

        private $dbhost = "localhost";
        private $dbname = "oop";
        private $username = "root";
        private $password = "";
        public $conn;

        public function getConn(){
            try {
                $this->conn = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname};",$this->username, $this->password);
                echo "Conn good";
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $this->conn;
        }

        /*public function __construct($dbhost='localhost', $username='root',$password='', $dbname='testing'){
            try {
              $this->conn = new PDO("mysql:host={$dbhost};dbname={$dbname};",$username, $password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
              return $this->conn;
              //echo 'Connect okay';
            } catch (Exception $e) {
              throw new Exception($e->getMessage());  
            }
        }*/
    }
?>