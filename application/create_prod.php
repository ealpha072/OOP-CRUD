<?php
    $page_title = 'Create Product';

    include_once 'header.php';
    include_once '../config/config.php';
    include_once '../objects/categories.php';

    //create new database
    $database = new Database();
    $db = $database->getConn();
    $category = new Categories($db);
    $category->getCategories();

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
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>


<?php
include 'footer.php';
?>