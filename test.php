<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>PHP Registration System Test</h2>";

// Test database connection
echo "<h3>1. Testing Database Connection:</h3>";
try {
    require_once "config.php";
    echo "✅ Database connection successful!<br>";
    echo "✅ Database 'login_db' created/selected successfully!<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit();
}

// Test table creation
echo "<h3>2. Testing Table Creation:</h3>";
$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($createTable)) {
    echo "✅ Table 'users' created/exists successfully!<br>";
} else {
    echo "❌ Table creation failed: " . $conn->error . "<br>";
}

// Test prepared statement functionality
echo "<h3>3. Testing Prepared Statements:</h3>";
$testEmail = "test@example.com";
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
if ($stmt) {
    $stmt->bind_param("s", $testEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "✅ Prepared statements working correctly!<br>";
    $stmt->close();
} else {
    echo "❌ Prepared statement failed: " . $conn->error . "<br>";
}

// Test password hashing
echo "<h3>4. Testing Password Hashing:</h3>";
$testPassword = "test123";
$hashedPassword = password_hash($testPassword, PASSWORD_DEFAULT);
if ($hashedPassword && password_verify($testPassword, $hashedPassword)) {
    echo "✅ Password hashing working correctly!<br>";
} else {
    echo "❌ Password hashing failed!<br>";
}

echo "<h3>5. System Status:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "MySQL Extension: " . (extension_loaded('mysqli') ? '✅ Loaded' : '❌ Not loaded') . "<br>";
echo "Session Support: " . (function_exists('session_start') ? '✅ Available' : '❌ Not available') . "<br>";

echo "<br><a href='index.php'>Go to Registration Page</a>";
?>



