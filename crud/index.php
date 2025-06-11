<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="assest/style.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="add_val.php" method="post">
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname" required><br><br>

            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phone">Mobile No:</label><br>
            <input type="text" id="phone" name="phone" required><br><br>

            <label>Vehicles:</label><br>
            <input type="checkbox" name="vehicle[]" value="Bike"> Bike <br>
            <input type="checkbox" name="vehicle[]" value="Car"> Car <br>
            <input type="checkbox" name="vehicle[]" value="Boat"> Boat <br><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
