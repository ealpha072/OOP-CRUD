<?php
    //header info
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

    if(isset($_POST['update'])){
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->category_id = $_POST['category_id'];

        if($product->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "Product was updated.";
            echo "</div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Product was updated.";
            echo "</div>";
        }
    }


    echo "<div class='right-button-margin'>
            <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
    </div>";
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
  
        <tr>
            <td>Category</td>
            <td>
                <!-- categories select drop-down will be here -->
                <?php 
                    $category->getCategories();
                    $stmt = $category->getCategories();
                    echo "<select class='form-control' name='category_id'>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $category_id = $row['id'];
                            $category_name = $row['name'];

                            if($product->category_id == $category_id){
                                echo "<option value='$category_id' selected>$category_name</option>";
                            }else{
                                echo "<option value='$category_id'>$category_name</option>";
                            }
                        }
                    echo "</select>";
                ?>
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </td>
        </tr>
  
    </table>
</form>

<?php include_once 'footer.php';?>