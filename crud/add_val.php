<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "database");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Form Data
$fname  = $_POST['fname'];
$lname  = $_POST['lname'];
$email  = $_POST['email'];
$phone  = $_POST['phone'];

// Checkbox Values Handling
if (isset($_POST['vehicle'])) {
    $vehicle = implode(", ", $_POST['vehicle']); // Convert array to comma-separated string
} else {
    $vehicle = ""; // If no checkbox selected, save empty value
}

// SQL Query
$sql = "INSERT INTO user (fname, lname, email, phone, vehical) 
        VALUES ('$fname', '$lname', '$email', '$phone', '$vehicle')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Data stored successfully!</h3>";
} else {
    echo "ERROR: " . mysqli_error($conn);
}

// Close Connection
mysqli_close($conn);
?>
