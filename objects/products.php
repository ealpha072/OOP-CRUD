<?php 
    class Product{
        private $conn;
        public $tablename = 'products';

        //object properties
        public $id;
        public $name;
        public $price;
        public $description;
        public $category_id;
        public $timestamp;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create($query='', $params=[]){
            $query = "INSERT INTO " . $this->tablename . " SET name=:name, price=:price, description=:description, category_id=:category_id, created=:created";
            $stmt = $this->conn->prepare($query);
            // posted values
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->timestamp = date('Y-m-d H:i:s');
    
            // set parameters
            $params = [
                ':name'=>$this->name,
                ':price'=>$this->price,
                ':description'=>$this->description,
                ':category_id'=>$this->category_id,
                'created'=>$this->timestamp
            ];
            
            if($stmt->execute($params)){
                return true;
            }else{
                return false;
            }
        }

        public function readAll($limit, $offset)
        {
            $query = "SELECT name, price, description, category_id FROM ".$this->tablename." ORDER BY
            name ASC LIMIT {$limit} OFFSET {$offset}";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }
?>