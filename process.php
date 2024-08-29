<?php
$servername = "localhost"; // Replace with your server name if different
$username = "root"; // Replace with your database username
$password = "password"; // Replace with your database password
$dbname = "ashis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO text (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Thank you for contacting us, $name. We will get back to you shortly.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }

    $stmt->close();
}

$conn->close();
?>
