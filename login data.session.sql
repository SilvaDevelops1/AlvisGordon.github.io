<?php
// Get the login details from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to the database
$servername = "localhost";
$dbname = "your_database_name";
$dbusername = "your_username";
$dbpassword = "your_password";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

// Prepare the SQL statement
$sql = "SELECT * FROM login_data WHERE username = :username AND password = :password";
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);

// Execute the statement
$stmt->execute();

// Check if a matching record is found
if ($stmt->rowCount() > 0) {
    // Login successful
    echo "Login successful!";
} else {
    // Login failed
    echo "Invalid username or password!";
}

// Close the connection
$conn = null;
?>