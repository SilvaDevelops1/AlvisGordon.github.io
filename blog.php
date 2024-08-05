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
    $db = new SQLite3('login data.db');
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->lastErrorMsg());
    }
    
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['form_type']) && $_POST['form_type'] == 'login') {
            // Retrieve form data
            $username = $_POST["username"];
            $password = $_POST["password"];
            $newEmail = $_POST["email"];
            // Check if the username and password match
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $db->query($sql);
        
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
            $sql = "INSERT INTO users (username, password, email) VALUES ('$newUsername', '$newPassword', '$newEmail')";
            if ($db->exec($sql)) {
                echo "Account created successfully. You can now log in.";
            } else {
                echo "Error: " . $db->lastErrorMsg();
            }
        }
    }
    
    // Close the database connection
    $db->close();
?>
