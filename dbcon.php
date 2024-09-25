<?php

try {
    $dsn = 'mysql:host=localhost;dbname=chapel_users';
    $username = 'root';
    $password = '';
    
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo 'Connection successful!';
} catch (PDOException $e) {
    // Handle connection errors
    die('Connection failed: ' . $e->getMessage());
}

?>
