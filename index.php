<?php
session_start();    

$errors = [
  'login' => $_SESSION['login_error'] ?? '',
  'register' => $_SESSION['register_error'] ?? ''
];

$success = [
  'register' => $_SESSION['register_success'] ?? ''
];

$active_form = $_SESSION['active_form'] ?? 'login';

unset($_SESSION['login_error'], $_SESSION['register_error'], $_SESSION['register_success'], $_SESSION['active_form']);

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : ''; 
}
function showSuccess($success) {
    return !empty($success) ? "<p class='success-message'>$success</p>" : ''; 
}
function isActive($formName, $active_form) {
    return $formName === $active_form ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro-Bazzar | Premium Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #00ff91;
            --secondary-color: #00aaff;
            --accent-color: #eb0d76;
            --dark-bg: #0a0a1a;
            --darker-bg: #050514;
            --light-text: #ffffff;
            --gray-text: #b0b0d0;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --premium-gold: #ffd700;
            --premium-silver: #c0c0c0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: 
                radial-gradient(ellipse at 20% 20%, #1a1a3a 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, #2a1a4a 0%, transparent 50%),
                linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--light-text);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Floating background elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 15%;
            animation-delay: -2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 15%;
            left: 15%;
            animation-delay: -4s;
        }

        .floating-element:nth-child(4) {
            width: 70px;
            height: 70px;
            top: 60%;
            right: 20%;
            animation-delay: -1s;
        }

        .floating-element:nth-child(5) {
            width: 90px;
            height: 90px;
            top: 30%;
            left: 5%;
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0) rotate(0deg); 
            }
            50% { 
                transform: translateY(-20px) rotate(5deg); 
            }
        }

        .container {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 2;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 34px;
            font-weight: 700;
            letter-spacing: 1px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--premium-gold) 50%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-container {
            background: var(--glass-bg);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            overflow: hidden;
        }

        .form-box {
            padding: 35px 30px;
            display: none;
        }

        .form-box.active {
            display: block;
            animation: fadeUp 0.6s ease forwards;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--light-text);
            margin-bottom: 8px;
            text-align: center;
        }

        .form-subtitle {
            color: var(--gray-text);
            text-align: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: var(--premium-silver);
            font-weight: 500;
            font-size: 14px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-text);
            font-size: 18px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-text);
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 2;
            background: none;
            border: none;
            outline: none;
        }

        .password-toggle:hover {
            color: var(--secondary-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 45px 12px 45px;
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 14px;
            background: rgba(0, 0, 0, 0.2);
            color: var(--light-text);
            transition: all 0.3s ease;
        }

        .form-group input::placeholder {
            color: var(--gray-text);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 6px rgba(0, 170, 255, 0.3);
        }

        .form-group input:focus + .input-icon {
            color: var(--secondary-color);
        }

        .password-hint {
            font-size: 12px;
            color: var(--gray-text);
            margin-top: 4px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #000;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 255, 145, 0.3);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
        }

        .btn-premium:hover {
            box-shadow: 0 6px 15px rgba(235, 13, 118, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--glass-border);
        }

        .form-footer p {
            color: var(--gray-text);
            font-size: 14px;
        }

        .form-footer a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .error-message {
            background: rgba(235, 13, 118, 0.1);
            color: #ff6b8b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid var(--accent-color);
        }

        .success-message {
            background: rgba(0, 255, 145, 0.1);
            color: var(--primary-color);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid var(--primary-color);
        }
        
        .form-switch {
            display: flex;
            background: rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid var(--glass-border);
        }

        .form-switch-btn {
            flex: 1;
            padding: 14px;
            text-align: center;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 500;
            color: var(--gray-text);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-switch-btn.active {
            background: var(--glass-bg);
            color: var(--light-text);
            border-bottom: 3px solid var(--secondary-color);
        }

        .premium-tag {
            background: var(--accent-color);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <!-- Floating background elements -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <div class="container">
        <div class="logo">
            <h1>Electro-Bazzar</h1>
        </div>

        <div class="form-container">
            <!-- Form Switch Buttons -->
            <div class="form-switch">
                <button class="form-switch-btn <?= $active_form === 'login' ? 'active' : '' ?>" onclick="showForm('login-form')">Login</button>
                <button class="form-switch-btn <?= $active_form === 'register' ? 'active' : '' ?>" onclick="showForm('register-form')">Register</button>
            </div>

            <!-- LOGIN FORM -->
            <div class="form-box <?= isActive('login', $active_form); ?>" id="login-form">
                <h2 class="form-title">Login</h2>
                <p class="form-subtitle">Welcome Back</p>
                
                <?= showError($errors['login']) ?>
                
                <form action="database.php" method="post">
                    <div class="form-group">
                        <label for="login-email">Email Address</label>
                        <div class="input-with-icon">
                            <span class="input-icon">✉️</span>
                            <input type="email" id="login-email" name="email" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('login-password', this)">👁️</button>
                        </div>
                    </div>
                    
                    <button type="submit" name="login" class="btn">Access Account</button>
                    
                    <div class="form-footer">
                        <p>New to Electro-Bazzar? <a href="#" onclick="showForm('register-form')">Create Account</a></p>
                    </div>
                </form>
            </div>

            <!-- REGISTER FORM -->
            <div class="form-box <?= isActive('register', $active_form); ?>" id="register-form">
                <h2 class="form-title">Join Premium <span class="premium-tag">Premium</span></h2>
                <p class="form-subtitle">Premium Member Access</p>
                
                <?= showError($errors['register']) ?>
                <?= showSuccess($success['register']) ?>
                
                <form action="database.php" method="post">
                    <div class="form-group">
                        <label for="register-name">Full Name</label>
                        <div class="input-with-icon">
                            <span class="input-icon">👤</span>
                            <input type="text" id="register-name" name="name" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-email">Email Address</label>
                        <div class="input-with-icon">
                            <span class="input-icon">✉️</span>
                            <input type="email" id="register-email" name="email" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="register-password" name="password" placeholder="Create a strong password" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('register-password', this)">👁️</button>
                        </div>
                        <div class="password-hint">Create a strong password</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="account-type">Account Type</label>
                        <div class="input-with-icon">
                            <span class="input-icon">⚡</span>
                            <select id="account-type" name="role" required>
                                <option value="">-- Select Account Type --</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" name="register" class="btn btn-premium">Create Premium Account</button>
                    
                    <div class="form-footer">
                        <p>Already have an account? <a href="#" onclick="showForm('login-form')">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function for switching between login/register forms
        function showForm(formId){
            // Hide all forms
            document.querySelectorAll(".form-box").forEach(form => {
                form.classList.remove("active");
            });
            
            // Remove active class from all buttons
            document.querySelectorAll(".form-switch-btn").forEach(btn => {
                btn.classList.remove("active");
            });
            
            // Show selected form
            document.getElementById(formId).classList.add("active");
            
            // Add active class to corresponding button
            if(formId === 'login-form') {
                document.querySelector(".form-switch-btn:first-child").classList.add("active");
            } else {
                document.querySelector(".form-switch-btn:last-child").classList.add("active");
            }
        }

        // Password visibility toggle function
        function togglePasswordVisibility(passwordFieldId, toggleButton) {
            const passwordField = document.getElementById(passwordFieldId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = '🙈';
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = '👁️';
            }
        }

        // Initialize form display based on PHP active_form
        document.addEventListener('DOMContentLoaded', function() {
            const activeForm = '<?php echo $active_form; ?>';
            if(activeForm === 'login') {
                showForm('login-form');
            } else {
                showForm('register-form');
            }
        });

        // Add subtle parallax effect to floating elements
        document.addEventListener('mousemove', function(e) {
            const floatingElements = document.querySelectorAll('.floating-element');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            floatingElements.forEach((element, index) => {
                const speed = (index + 1) * 0.5;
                const xMove = (x - 0.5) * speed * 10;
                const yMove = (y - 0.5) * speed * 10;
                
                element.style.transform = `translate(${xMove}px, ${yMove}px)`;
            });
        });
    </script>
</body>
</html>