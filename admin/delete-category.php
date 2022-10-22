<?php
include 'config.php';
include 'auth.php';

$category_id = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id = {$category_id}";

if(mysqli_query($conn, $sql)){
    header("location:{$webroot}/admin/category.php");
}else{
    echo "Can't delete the category";
}

?>