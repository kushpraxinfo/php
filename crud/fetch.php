<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>

    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <style>
        .add {
            display: flex;
            justify-content: center;

        }
    </style>
</head>
<body> 
    <a href="index.php">
    <button class="add">Add User</button>
    </a>

<table id="table_id" class="displ   ay">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Vehicle Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database Connection
        $conn = mysqli_connect("localhost", "root", "", "database");

        // Check Connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch Data
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);

        // Check if any data exists
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
        <td>" . $row['fname'] . "</td>
        <td>" . $row['lname'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['vehical'] . "</td>
        <td>
            <a href='edit.php?u_id=" . $row['u_id'] . "'>
                <button><i class='fa-solid fa-pen-to-square'></i></button>
            </a>
            <a href='delete.php?u_id=" . $row['u_id'] . "' onclick=\"return confirm('Are you sure you want to delete?');\">
                <button><i class='fa-solid fa-trash'></i></button>
            </a>
        </td>
      </tr>";

            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }

        // Close Connection
        mysqli_close($conn);
        ?>
    </tbody>
</table>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#table_id').DataTable(); // Correct ID used here
});
</script>

</body>
</html>
