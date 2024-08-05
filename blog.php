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
    
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $newUsername = $_POST["newUsername"];
        $newPassword = $_POST["newPassword"];
    
        // Insert data into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
        if ($db->exec($sql)) {
            echo "Account created successfully";
        } else {
            echo "Error: " . $db->lastErrorMsg();
        }
    }
    
    // Close the database connection
    $db->close();
    ?>
</body>
</html>