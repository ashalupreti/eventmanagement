<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create events table if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        event_name VARCHAR(255) NOT NULL,
        event_date DATE NOT NULL,
        event_time TIME NOT NULL,
        event_location VARCHAR(255) NOT NULL,
        event_description TEXT NOT NULL,
        event_image VARCHAR(255)
    )";
    if ($conn->query($createTableSql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }

    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];
    $event_description = $_POST['event_description'];

    // Handle Image Upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["event_image"]["name"]);
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file);
        $event_image = $target_file;
    } else {
        $event_image = null;
    }

    // Insert event into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, event_time, event_location, event_description, event_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $event_name, $event_date, $event_time, $event_location, $event_description, $event_image);

    if ($stmt->execute() === TRUE) {
        echo "New event added successfully!";
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
