<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Insertion Test</h2>";

require_once "config.php";

// Test data
$testName = "Test User";
$testEmail = "test" . time() . "@example.com"; // Unique email
$testPassword = "test123";
$testRole = "user";

echo "<h3>Test Data:</h3>";
echo "Name: $testName<br>";
echo "Email: $testEmail<br>";
echo "Role: $testRole<br>";

// Hash password
$hashedPassword = password_hash($testPassword, PASSWORD_DEFAULT);
echo "Password Hash: " . substr($hashedPassword, 0, 20) . "...<br><br>";

// Test insertion
echo "<h3>Testing Database Insertion:</h3>";

try {
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssss", $testName, $testEmail, $hashedPassword, $testRole);
    
    if ($stmt->execute()) {
        echo "✅ SUCCESS: User inserted successfully!<br>";
        echo "Insert ID: " . $conn->insert_id . "<br>";
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "<br>";
}

// Check if data exists
echo "<h3>Verifying Data in Database:</h3>";
$checkStmt = $conn->prepare("SELECT id, name, email, role, created_at FROM users WHERE email = ?");
$checkStmt->bind_param("s", $testEmail);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "✅ Data found in database:<br>";
    echo "ID: " . $user['id'] . "<br>";
    echo "Name: " . $user['name'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "Role: " . $user['role'] . "<br>";
    echo "Created: " . $user['created_at'] . "<br>";
} else {
    echo "❌ No data found in database<br>";
}

$checkStmt->close();

echo "<br><a href='index.php'>Go to Registration Page</a>";
?>



