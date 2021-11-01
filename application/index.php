<?php
    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    // set number of records per page
    $records_per_page = 5;
    
    // calculate for the query LIMIT clause
    $from_record_num = ($records_per_page * $page) - $records_per_page;
  
    // retrieve records here

    //page title
    $page_title = 'Read Products';

    include_once 'header.php';
    include_once '../config/config.php';
    include_once '../objects/products.php';
    include_once '../objects/categories.php';
    //create new database
    $database = new Database();
    $db = $database->getConn();

    //pass conn to objects
    $category = new Categories($db);
    $product = new Product($db); 

    //getAll products from database
    $query = $product->readAll($from_record_num, $records_per_page);
    $results = $query->rowCount();


    
    echo "<div class='right-button-margin'>
            <a href='create_product.php' class='btn btn-default pull-right'>Create Product</a>
        </div>
    ";

?>

<?php include 'footer.php'; ?>