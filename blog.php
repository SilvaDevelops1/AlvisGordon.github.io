<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
<?php
    // Connect to the SQLite database
    $db = new SQLite3('logindata.db');
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->lastErrorMsg());
    }
    
    // Create the users table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $db->exec($createTableQuery);

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['form_type']) && $_POST['form_type'] == 'login') {
            // Retrieve form data
            $username = $_POST["username"];
            $password = $_POST["password"];
        
            // Check if the username and password match
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT);
            $result = $stmt->execute();
        
            if ($result->fetchArray()) {
                echo "Login successful. Welcome to the blog!";
                // Display blog content or redirect to another page
            } else {
                echo "Invalid username or password";
            }
        } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'create_account') {
            // Retrieve form data
            $newUsername = $_POST["newUsername"];
            $newPassword = $_POST["newPassword"];
            $newEmail = $_POST["newEmail"];
        
            // Insert data into the database
            $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            $stmt->bindValue(':username', $newUsername, SQLITE3_TEXT);
            $stmt->bindValue(':password', $newPassword, SQLITE3_TEXT);
            $stmt->bindValue(':email', $newEmail, SQLITE3_TEXT);

            if ($stmt->execute()) {
                echo "Account created successfully. You can now log in.";
            } else {
                echo "Error: " . $db->lastErrorMsg();
            }
        }
    }
    
    // Close the database connection
    $db->close();
?>
</body>
</html>