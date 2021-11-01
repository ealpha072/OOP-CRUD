<?php
    class Categories{
        private $conn; 
        private $tablename = 'categories';

       public function __construct($db)
       {
            $this->conn = $db;
       }

       public function getCategories()
       {
            try {
                $query = 'SELECT id, name FROM '.$this->tablename.' ORDER BY name';
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            } catch (Throwable $th) {
                //throw $th;
                throw new Exception($th->getMessage());                
            }
       }

       public function readName()
        {
            $query = "SELECT name from ".$this->tablename."WHERE id=:id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(array(':id'=>$this->id));
            return $stmt;
        }
    }
?>