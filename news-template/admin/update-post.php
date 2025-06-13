<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1 class="admin-heading">Update Post</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">

<?php
include 'config.php';


if (isset($_POST['submit'])) {
    $post_id = $_POST['post_id'];
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = $_POST['category'];
    $old_image = $_POST['old_image'];
    $image = $old_image;

    
    if (!empty($_FILES['new-image']['name'])) {
        $img_name = $_FILES['new-image']['name'];
        $img_tmp = $_FILES['new-image']['tmp_name'];
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($img_ext, $allowed)) {
            move_uploaded_file($img_tmp, "upload/$img_name");
            $image = $img_name;
        }
    }

    
    $cat_query = mysqli_query($conn, "SELECT category FROM post WHERE post_id = $post_id");
    $old_cat = mysqli_fetch_assoc($cat_query)['category'];

    
   $sql = "UPDATE post SET title='$title', description='$desc', category=$category, post_img='$image' WHERE post_id=$post_id;";


    //  Adjust category post count if changed
    if ($old_cat != $category) {
        $sql .= "UPDATE category SET post = post - 1 WHERE category_id = $old_cat;";
        $sql .= "UPDATE category SET post = post + 1 WHERE category_id = $category;";
    }

    if (mysqli_multi_query($conn, $sql)) {
        header("Location: post.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Update failed</div>";
    }
}

//  Fetch post to display
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM post WHERE post_id = $id");
    if ($res && mysqli_num_rows($res)) {
        $post = mysqli_fetch_assoc($res);
?>

<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
    <input type="hidden" name="old_image" value="<?= $post['post_img'] ?>">

    <div class="form-group">
        <label>Title</label>
        <input type="text" name="post_title" class="form-control" value="<?= $post['title'] ?>" required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="postdesc" class="form-control" rows="5" required><?= $post['description'] ?></textarea>
    </div>

    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category" required>
            <?php
            $cats = mysqli_query($conn, "SELECT * FROM category");
            while ($cat = mysqli_fetch_assoc($cats)) {
                $selected = ($post['category'] == $cat['category_id']) ? "selected" : "";
                echo "<option value='{$cat['category_id']}' $selected>{$cat['category_name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Post Image</label>
        <input type="file" name="new-image">
        <img src="upload/<?= $post['post_img'] ?>" height="150px">
    </div>

    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
</form>

<?php
    } else {
        echo "<div class='alert alert-danger'>Post not found</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request</div>";
}
?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
