<?php
include 'config.php';
include 'auth.php';

$user_id = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = {$user_id}";

if(mysqli_query($conn, $sql)){
    header("location:{$webroot}/admin/users.php");
}else{
    echo "Can't delete the user";
}

?>