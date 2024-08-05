<?php
try {
    // Connect to the SQLite database
    $conn = new PDO("sqlite:logindata.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e)
    // Create the users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $conn->exec($sql);
    echo "Database and table setup successfully.<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>