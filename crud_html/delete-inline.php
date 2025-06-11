<?php
    $stu_id = $_GET['id'];

    $conn = mysqli_connect("localhost","root","","crud") or die("connection failed");

    $sql = "delete from student where sid = {$stu_id}";

    $result = mysqli_query($conn,$sql);

    header("Location: /praxinfo/crud_html/index.php");
    mysqli_close($conn);
?>