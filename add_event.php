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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event - Event Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- Navigation Bar -->
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="view_events.php">View Events</a></li>
                <li><a href="add_event_form.php">Add Event</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Add Event Form -->
    <section class="add-event-section">
        <h1>Add a New Event</h1>
        <form action="add_event.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required>
            </div>
            <div class="form-group">
                <label for="event_time">Event Time:</label>
                <input type="time" id="event_time" name="event_time" required>
            </div>
            <div class="form-group">
                <label for="event_location">Event Location:</label>
                <input type="text" id="event_location" name="event_location" required>
            </div>
            <div class="form-group">
                <label for="event_description">Event Description:</label>
                <textarea id="event_description" name="event_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="event_image">Event Image:</label>
                <input type="file" id="event_image" name="event_image" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Add Event</button>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Event Management System | Designed with passion</p>
    </footer>

</body>

</html>