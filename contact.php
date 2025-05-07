<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "adoptify_db";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO contact_requests (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Escape special characters for safe JavaScript usage
        $safeName = addslashes($name);
        $safeEmail = addslashes($email);

        echo "<script>
        alert('Thank you, $safeName! Your message has been sent successfully. We will contact you at $safeEmail.');
        window.location.href = 'index.html';
        </script>";
    } else {
        // Log error (optional)
        error_log("Database error: " . $conn->error);

        // Show generic error message
        echo "<script>
        alert('An error occurred while submitting your message. Please try again later.');
        window.location.href = 'index.html';
        </script>";
    }
}

$conn->close();
?>
