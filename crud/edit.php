<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "database");

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if u_id is set in URL
if (isset($_GET['u_id'])) {
    $u_id = intval($_GET['u_id']); // Convert to integer for security

    // Fetch User Data
    $sql = "SELECT * FROM user WHERE u_id = $u_id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit();
    }
}

// Handle Form Submission
if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $vehical = $_POST['vehical'];

    // Update Query
    $update_sql = "UPDATE user SET 
                    fname = '$fname', 
                    lname = '$lname', 
                    email = '$email', 
                    phone = '$phone', 
                    vehical = '$vehical' 
                   WHERE u_id = $u_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "User updated successfully";
        header("Location: fetch.php"); // Redirect to index page
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close Connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="post">
    <label>First Name:</label>
    <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required><br><br>

    <label>Last Name:</label>
    <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>

    <label>Vehicle Type:</label>
    <input type="text" name="vehical" value="<?php echo $row['vehical']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
