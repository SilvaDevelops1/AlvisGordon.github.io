<?php
// Get the login details from the form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Connect to the database
$servername = "localhost";
$dbname = "login datae";
$dbusername = "Alvis";
$dbpassword = "T.A0704$k";

try {
    $conn = new PDO("sqlite:${workspaceFolder:website}/logindata.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $conn->exec($sql);

    // Insert user data into the table
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "User data saved successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>