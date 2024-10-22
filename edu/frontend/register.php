<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$db_username = "root";  // Default user
$db_password = "mamu123123";
$dbname = "SDlab";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    //$email = $_POST['email'];
    $password = $_POST['password'];

    // Password hashing for security
    $hashed_password = md5($password);

    // Insert user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='notes.html'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>