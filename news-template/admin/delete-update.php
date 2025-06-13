<?php
include "config.php";

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// If no ID, block action
if($post_id === 0){
    header("Location: post.php");
    exit;
}

// First, get post image and category
$sql1 = "SELECT post_img, category FROM post WHERE post_id = {$post_id}";
$result1 = mysqli_query($conn, $sql1) or die("Query failed: fetch post");

if(mysqli_num_rows($result1) > 0){
    $row = mysqli_fetch_assoc($result1);
    $image_path = "upload/" . $row['post_img'];
    $category_id = $row['category'];

    // Delete post
    $sql2 = "DELETE FROM post WHERE post_id = {$post_id};";
    // Update category post count
    $sql2 .= "UPDATE category SET post = post - 1 WHERE category_id = {$category_id}";

    if(mysqli_multi_query($conn, $sql2)){
        // Delete image file
        if(file_exists($image_path)){
            unlink($image_path);
        }
        header("Location: post.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Failed to delete the post.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Post not found.</div>";
}
?>
