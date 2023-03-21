<?php
// Connect to the database
$servername = "localhost";
$username = "dev640";
$password = "dev640password";
$dbname = "dev640socialapp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle incoming messages
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = $_POST["author"];
    $recipient = $_POST["recipient"];
    $pm = $_POST["pm"];
    $time = date("Y-m-d H:i:s");
    $message = $_POST["message"];
    $sql = "INSERT INTO messages (author, recipient, pm, time, message) VALUES ('$author', '$recipient', '$pm', '$time', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve messages from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p>Message ID: " . $row["message_id"] . "</p>";
        echo "<p>Author: " . $row["author"] . "</p>";
        echo "<p>Recipient: " . $row["recipient"] . "</p>";
        echo "<p>PM: " . $row["pm"] . "</p>";
        echo "<p>Time: " . $row["time"] . "</p>";
        echo "<p>Message: " . $row["message"] . "</p>";
    }
} else {
    echo "No messages";
}

$conn->close();
?>
