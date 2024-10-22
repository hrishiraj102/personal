<?php

session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "mamu123123";
$dbname = "SDlab";


$conn = new mysqli($servername, $db_username, $db_password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = md5($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        $_SESSION['username'] = $username;

        header("Location: file_system.php");
        exit(); 
    } else {
        echo "Invalid username or password!";
    }
}

$conn->close();
?>