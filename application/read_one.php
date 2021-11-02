<?php    
    $page_title = 'Update Product';

    include_once 'header.php';
    include_once '../config/config.php';
    include_once '../objects/categories.php';
    include_once '../objects/products.php';


    $id = (isset($_GET['id'])) ? $_GET['id'] : die('Missing id info');

    //create new database
    $database = new Database();
    $db = $database->getConn();
 
    //pass conn to objects
    $category = new Categories($db);
    $product = new Product($db); 

    $product->id = $id;
    $product->readOne();

    echo "<table class='table table-hover table-responsive table-bordered'>";
  
        echo "<tr>";
            echo "<td>Name</td>";
            echo "<td>{$product->name}</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Price</td>";
            echo "<td>$</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Description</td>";
            echo "<td>{$product->description}</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Category</td>";
            echo "<td>";
                // display category name
                $category->id=$product->category_id;
                $category->readName();
                echo $category->name;
            echo "</td>";
        echo "</tr>";
  
    echo "</table>";

?>

<?php include_once 'footer.php'; ?>