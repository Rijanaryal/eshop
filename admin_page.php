<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Page</title></head>
<body>
<h2>Welcome Admin, <?= $_SESSION['name']; ?>!</h2>
<p>You are logged in as <strong><?= $_SESSION['email']; ?></strong></p>
<p>Role: <strong><?= $_SESSION['role']; ?></strong></p>
<a href="3js.html">Go to Electro-Bazzar</a> | 
<a href="logout.php">Logout</a>
</body>
</html>
