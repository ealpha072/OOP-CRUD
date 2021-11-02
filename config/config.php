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
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $this->conn;
        }
    }
?>