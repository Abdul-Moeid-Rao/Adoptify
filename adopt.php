<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "adoptify_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petName = $conn->real_escape_string($_POST['petName']);
    $adopterName = $conn->real_escape_string($_POST['adopterName']);
    $adopterEmail = $conn->real_escape_string($_POST['adopterEmail']);
    $adopterPhone = $conn->real_escape_string($_POST['adopterPhone']);
    $adopterMessage = $conn->real_escape_string($_POST['adopterMessage']);

    // Use prepared statements for safer database queries
    $stmt = $conn->prepare("INSERT INTO adopters (pet_name, adopter_name, adopter_email, adopter_phone, adopter_message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $petName, $adopterName, $adopterEmail, $adopterPhone, $adopterMessage);

    if ($stmt->execute()) {
        // Remove pet from available list
        $deleteStmt = $conn->prepare("DELETE FROM pets WHERE name = ?");
        $deleteStmt->bind_param("s", $petName);

        if ($deleteStmt->execute()) {
            // echo "Adoption request submitted successfully!";
            echo "<script>
        alert('Adoption request submitted successfully! We will connect you soon...');
        window.location.href = 'index.html';
        </script>";
        } else {
            error_log("Error removing pet: " . $conn->error);
            // echo "An error occurred. Please try again.";
            echo "<script>
        alert('An error occurred. Please try again.');
        window.location.href = 'index.html';
        </script>";
        }
        $deleteStmt->close();
    } else {
        error_log("Error: " . $stmt->error);
        // echo "An error occurred. Please try again.";
        echo "<script>
        alert('An error occurred. Please try again.');
        window.location.href = 'index.html';
        </script>";
    }
    $stmt->close();
}

$conn->close();
?>
