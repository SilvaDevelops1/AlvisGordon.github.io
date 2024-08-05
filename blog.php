<?php
// Database connection
try {
    $conn = new PDO("sqlite:logindata.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ensure the users table exists
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        email TEXT NOT NULL
    )";
    $conn->exec($sql);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'create_account') {
        // Retrieve form data
        $newUsername = $_POST["newUsername"];
        $newPassword = $_POST["newPassword"];
        $newEmail = $_POST["newEmail"];
        
        // Optionally, hash the password before storing it
        // $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Insert data into the database
        try {
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':password', $newPassword);
            $stmt->bindParam(':email', $newEmail);
            $stmt->execute();

            echo "Account created successfully. You can now log in.<br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'login') {
        // Retrieve form data
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Optionally, verify the password if it was hashed
        // $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        // $stmt->bindParam(':username', $username);
        // $stmt->execute();
        // $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // if ($user && password_verify($password, $user['password'])) {
        
        // Check if the username and password match (not using hashing for simplicity)
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Login successful. Welcome to the blog!<br>";
        } else {
            echo "Invalid username or password.<br>";
        }
    }
}

// Close the database connection
$conn = null;
?>