<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect MySQL DB</title>
</head>
<body>
    <?php
    // Database credentials
    $servername = "localhost";
    $username = "root"; // Default username for MySQL
    $password = "khoa123"; // Default password for MySQL
    $dbname = "testdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully<br>";

    // Insert data
    // $sql = "INSERT INTO users (id, name, email) VALUES (3, 'Khoa Nguyen', 'khoanguyen@example.com')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully<br>";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // Retrieve data
    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>

