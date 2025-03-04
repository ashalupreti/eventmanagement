<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all events
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events - Event Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="view_events.php">View Events</a></li>
                <li><a href="add_event.php">Add Event</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Events Section -->
    <section class="events-section">
        <h1>Upcoming Events</h1>
        <div class="events-list">
            <?php
            // Check if there are any events
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event-item'>";
                    echo "<h2>" . $row["event_name"] . "</h2>";
                    echo "<p><strong>Location:</strong> " . $row["event_location"] . "</p>";
                    echo "<p><strong>Date:</strong> " . $row["event_date"] . "</p>";
                    echo "<p><strong>Time:</strong> " . $row["event_time"] . "</p>";
                    echo "<p><strong>Description:</strong> " . $row["event_description"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No events available.</p>";
            }
            $conn->close();
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Event Management System | Designed with passion</p>
    </footer>

</body>
</html>