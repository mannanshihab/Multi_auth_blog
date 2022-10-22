<?php
include 'config.php';

$post_id = $_GET['id'];
$category_id = $_GET['category_id'];

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$category_id}";

if(mysqli_multi_query($conn, $sql)){
    header("location:{$webroot}/admin/post.php");
}else{
    echo "Can't delete the user";
}

?>