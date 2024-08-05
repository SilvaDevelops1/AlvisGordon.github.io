<?php
$servername = "localhost";
$dbname = "logindata.db";
$dbusername = "Alvis";
$dbpassword = "T.A0704$k";

try {
    // Connect to the SQLite database
    $conn = new PDO("sqlite:logindata.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $conn->exec($sql);

    echo "Database and table setup successfully.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
}
?>
