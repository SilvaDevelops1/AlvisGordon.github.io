<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$servername = "localhost";
$dbname = "login data";
$dbusername = "Alvis";
$dbpassword = "T.A0704$k";

try {
    $conn = new PDO("sqlite:${workspaceFolder:website}/logindata.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $conn->exec($sql);

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