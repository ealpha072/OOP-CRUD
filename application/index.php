<?php
    //page title
    $page_title = 'Read product';

    //include files
    include_once 'header.php';
    include_once '../config/config.php';
    include_once '../objects/categories.php';
    include_once '../objects/products.php';

    //create new database
    $database = new Database();
    $db = $database->getConn();
    //pagination
    $page_number = 2;
    $limit = 5;
    $offset = ($limit * $page_number) - $limit;
    //pass conn to objects
    $category = new Categories($db);
    $product = new Product($db);

    $stm = $product->readAll($limit, $offset);
    $count = count($stm->fetchAll(PDO::FETCH_ASSOC));

    if($count > 0){
        echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
                echo "<th>Product</th>";
                echo "<th>Price</th>";
                echo "<th>Description</th>";
                echo "<th>Category</th>";
                echo "<th>Actions</th>";
            echo "</tr>";
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
                echo $row['name'];
            }
            
    }



?>