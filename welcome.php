<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Electro-Bazzar</title>
    <link rel="icon" type="image/png" href="379907369_731692655641513_7342960460164979974_n.jpg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Montserrat:wght@400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(circle, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
        }
        
        .welcome-container {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 255, 231, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 500px;
            animation: slideIn 0.8s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 36px;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #ff0055, #00ffe7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .welcome-text {
            font-size: 24px;
            margin-bottom: 15px;
            color: #00ffe7;
        }
        
        .user-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .user-info p {
            margin: 8px 0;
            font-size: 16px;
        }
        
        .role-badge {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, #ff0055, #00ffe7);
            color: #000;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        
        .continue-btn {
            background: linear-gradient(135deg, #ff0055, #00ffe7);
            color: #000;
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 20px 10px;
            text-decoration: none;
            display: inline-block;
        }
        
        .continue-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 0, 85, 0.4);
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .loading {
            margin-top: 20px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #00ffe7;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="logo">
            <span style="color: #34ef82;">Electro</span><span style="color: #3039e4;">-Bazzar</span>
        </div>
        
        <div class="welcome-text">Welcome back, <?= htmlspecialchars($name); ?>! 🎉</div>
        
        <div class="user-info">
            <p><strong>Email:</strong> <?= htmlspecialchars($email); ?></p>
            <p><strong>Role:</strong> 
                <span class="role-badge"><?= ucfirst($role); ?></span>
            </p>
        </div>
        
        <a href="real.html" class="continue-btn">
            🛒 Continue Shopping
        </a>
        
        <div style="margin-top: 20px;">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="loading">
            <div class="spinner"></div>
            Redirecting to Electro-Bazzar...
        </div>
    </div>
    
    <script>
        // Auto redirect after 3 seconds
        setTimeout(() => {
            window.location.href = 'real.html';
        }, 3000);
        
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.welcome-container');
            
            // Add floating animation
            setInterval(() => {
                container.style.transform = 'translateY(-5px)';
                setTimeout(() => {
                    container.style.transform = 'translateY(0)';
                }, 2000);
            }, 4000);
        });
    </script>
</body>
</html>


