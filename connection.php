<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "chapel_calendar";

try {
    // Create a new PDO instance
    $con = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connection successful!";
} catch (PDOException $e) {
    // Catch any connection error and display the message
    echo "Connection failed: " . $e->getMessage();
}
?>
