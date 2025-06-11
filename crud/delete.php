<?php
$conn = mysqli_connect("localhost", "root", "", "database");

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$u_id = $_GET['u_id'];

$sql = "DELETE FROM user WHERE u_id='$u_id'";


if(mysqli_query($conn,$sql)){
    echo "succe";
    header("Location: fetch.php");
}

?>