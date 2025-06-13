<?php 
    include 'config.php';
    session_start();

    if(isset($_FILES['fileToUpload'])){
        $errors = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        if(!in_array($file_ext, $allowed_extensions)){
            $errors[] = "This file extension is not allowed. Please choose jpeg or png.";
        }

        if($file_size > 2097152){
            $errors[] = "File must be 2MB or lower.";
        }

        if(empty($errors)){
            move_uploaded_file($file_tmp, "upload/" . $file_name);
        } else {
            print_r($errors);
            die();
        }
    }

    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d, M, Y");
    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post(title, description, category, post_date, author, post_img)
            VALUES ('{$title}', '{$description}', '{$category}', '{$date}', '{$author}', '{$file_name}');";
        
        
    
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

    if(mysqli_multi_query($conn, $sql)){
        header("Location: http://localhost/praxinfo/news-template/admin/post.php");
    } else {
        echo "<div class='alert alert-danger'>Query failed.</div>";
    }
?>
