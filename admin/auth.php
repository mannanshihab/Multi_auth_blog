<?php
if($_SESSION["user_role"]== '0'){
    header("location:{$webroot}/admin/post.php");
}
?>