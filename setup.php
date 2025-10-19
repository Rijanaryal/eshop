<?php
require_once "config.php";

// Create database if it doesn't exist
$createDatabase = "CREATE DATABASE IF NOT EXISTS login_db";
if ($conn->query($createDatabase)) {
    echo "Database 'login_db' created or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("login_db");

// Create users table
$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($createTable)) {
    echo "Table 'users' created or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert a test admin user (password: admin123)
$testEmail = "admin@test.com";
$checkAdmin = $conn->query("SELECT id FROM users WHERE email = '$testEmail'");

if ($checkAdmin->num_rows == 0) {
    $hashedPassword = password_hash("admin123", PASSWORD_DEFAULT);
    $insertAdmin = "INSERT INTO users (name, email, password, role) VALUES ('Admin User', '$testEmail', '$hashedPassword', 'admin')";
    
    if ($conn->query($insertAdmin)) {
        echo "Test admin user created successfully!<br>";
        echo "Email: admin@test.com<br>";
        echo "Password: admin123<br>";
    } else {
        echo "Error creating admin user: " . $conn->error . "<br>";
    }
} else {
    echo "Admin user already exists.<br>";
}

echo "<br><a href='index.php'>Go to Login Page</a>";

$conn->close();
?>



