<?php 

  if($_SESSION["user_role"] == '0'){
    header("Location:  http://localhost/praxinfo/news-template/admin/post.php");
  }
  
    include 'config.php';
    $userid = $_GET['id'];

    $sql = "DELETE FROM user WHERE user_id = {$userid}";

    if(mysqli_query($conn, $sql)){
        header("Location: http://localhost/praxinfo/news-template/admin/users.php");
    }
    else{
        echo "can't delete user record";
    }
?>