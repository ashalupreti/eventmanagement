<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="add_event_form.php">Add Event</a></li>
        <li><a href="index.php">View Events</a></li>
    </ul>
</nav>

<!-- Add Event Form -->
<div class="add-event-form">
    <h2>Add a New Event</h2>
    <form action="add_event.php" method="POST" enctype="multipart/form-data">
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" required>
        
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>
        
        <label for="event_time">Event Time:</label>
        <input type="time" id="event_time" name="event_time" required>
        
        <label for="event_location">Event Location:</label>
        <input type="text" id="event_location" name="event_location" required>
        
        <label for="event_description">Event Description:</label>
        <textarea id="event_description" name="event_description" required></textarea>
        
        <label for="event_image">Event Image:</label>
        <input type="file" id="event_image" name="event_image" accept="image/*">

        <button type="submit" name="submit">Add Event</button>
    </form>
</div>

</body>
</html>