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
            $query = "SELECT id, name, price, description, category_id FROM ".$this->tablename." ORDER BY
            name ASC LIMIT {$limit} OFFSET {$offset}";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function countAll()
        {
            $query = "SELECT id from ".$this->tablename."";
            $stmt =$this->conn->prepare($query);
            $stmt->execute();

            $total_records = $stmt->rowCount();
            return $total_records;
        }

        public function readOne()
        {
            $query = "SELECT id, name, price, description, category_id FROM ".$this->tablename." WHERE id=:id LIMIT 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(array(':id'=>$this->id));
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $results['name'];
            $this->price = $results['price'];
            $this->description = $results['description'];
            $this->category_id = $results['category_id'];
        }

        public function update()
        {
            $query = "UPDATE ".$this->tablename." SET name = :name, price = :price, description = :description,
            category_id  = :category_id WHERE id=:id";
            $stmt = $this->conn->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $params = [
                ':name' =>$this->name,
                ':price' =>$this->price,
                ':description' =>$this->description,
                ':category_id'  =>$this->category_id,
                ':id'=>$this->id
            ];
            
            if($stmt->execute($params)){
                return true;
            }else{
                return false;
            }
        }
    }
?>