<?php include "header.php";  include 'auth.php';
    if(isset($_POST['submit'])){
        include 'config.php';
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
        $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
        
    
        $sql = "UPDATE `category` 
                SET `category_name` = '{$category_name}'
                WHERE `category`.`category_id` = '$category_id';";
        
        $result = mysqli_query($conn, $sql) or die ("query fail");
        header("location:http://localhost/EasyFie/news-site/admin/category.php");
    }
    
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                    <?php
                        include 'config.php';
                        $category_id = $_GET['id'];
                        $sql = "SELECT * FROM category WHERE category_id = {$category_id}";
                        $result = mysqli_query( $conn, $sql);
                        $category =  mysqli_fetch_assoc($result);
                       
                    ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?= $category ['category_id']?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?= $category ['category_name']?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
