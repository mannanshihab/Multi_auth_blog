<?php include "header.php"; 
 include 'auth.php';
if(isset($_POST['submit'])){
    include 'config.php';
    $userid = mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['first_name']);
    $lname = mysqli_real_escape_string($conn,$_POST ['last_name']) ;
    $user = mysqli_real_escape_string($conn,$_POST ['username']);
    $password = mysqli_real_escape_string($conn,md5($_POST ['password']));
    $role = mysqli_real_escape_string($conn,$_POST ['role']);

    $sql = "UPDATE `user` SET `first_name` = '{$fname}', 
                                `last_name` = '{$lname}', 
                                `username` = '{$user}', 
                                `role` = '{$role}', 
                                `password` = '{$password}' 
                                WHERE `user`.`user_id` = '$userid';";
    
    $result = mysqli_query($conn, $sql) or die ("query fail");
    header("location:http://localhost/EasyFie/news-site/admin/users.php");
}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                    <?php
                        include 'config.php';
                        $user_id = $_GET['id'];
                        $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
                        $result = mysqli_query( $conn, $sql);
                        $user =  mysqli_fetch_assoc($result);
                       
                    ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?= $user ['user_id']?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control" value="<?= $user ['first_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="<?= $user ['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?= $user ['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $user['role'] ?>">
                            <?php
                                if($user['role'] == 1){
                                    echo"<option value='0'>Modarator</option>
                                    <option value='1'selected>Admin</option>";
                                }else{
                                    echo 
                                    "<option value='0'selected>Modarator</option>
                                    <option value='1' >Admin</option>";
                                }
                            ?>
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
