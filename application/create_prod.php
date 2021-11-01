<?php
    $page_title = 'Create Product';

    include_once 'header.php';
    include_once '../config/config.php';
    include_once '../objects/categories.php';
    include_once '../objects/products.php';

    //create new database
    $database = new Database();
    $db = $database->getConn();

    //pass conn to objects
    $category = new Categories($db);
    $product = new Product($db); 

    if(isset($_POST['create-prod'])){
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->category_id = $_POST['category_id'];

        $condtion = $product->create();

        if($condtion){
            echo "<div class=\"alert alert-success\" role=\"alert\">Success Produc added to databse.</div>";
        }else{
            echo '<div class="alert alert-danger" role="alert">Error!!Failed to add to database.</div>';
        }
    }

    echo "<div class='right-button-margin'>
            <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
        </div>";
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>
                <?php 
                    $category->getCategories();
                    $stmt = $category->getCategories();
                    echo "<select class='form-control' name='category_id'>";
                        echo "<option>Select category...</option>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            echo "<option value=\"{$id}\">{$name}</option>";
                        }
                    echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary" name="create-prod">Create</button>
            </td>
        </tr>

    </table>
</form>


<?php
include 'footer.php';
?>