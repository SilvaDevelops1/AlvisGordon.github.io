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
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Check if the username and password match
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $db->query($sql);
    
        if ($result->fetchArray()) {
            echo "Login successful";
        } else {
            echo "Invalid username or password";
        }
    }
    
    // Close the database connection
    $db->close();
    ?>
    
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
    
    <h2>Create Account</h2>
    <form method="POST" action="">
        <label for="newUsername">Username:</label>
        <input type="text" id="newUsername" name="newUsername" required><br><br>
        
        <label for="newPassword">Password:</label>
        <input type="password" id="newPassword" name="newPassword" required><br><br>
        
        <label for="newEmail">Email:</label>
        <input type="email" id="newEmail" name="newEmail" required><br><br>
        
        <input type="submit" value="Create Account">
    </form>
</body>
</html>