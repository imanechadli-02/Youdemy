<?php
require_once '../config/config.php';
require '../classes/UserClass.php';

session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';


    $user = new User('', $email, $password, '');

    $user->signIn();

    // header("Location: ../index.php");
    exit();
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Youdemy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #6366f1;
            --background: #0f172a;
            --surface: #1e293b;
            --surface-light: #334155;
            --text: #f8fafc;
            --text-secondary: #94a3b8;
            --accent: #818cf8;
            --error: #ef4444;
            --success: #22c55e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--background), var(--surface));
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--text);
        }

        .page-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-section {
            flex: 1;
            background: rgba(79, 70, 229, 0.1);
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.1), rgba(79, 70, 229, 0.1));
            z-index: 0;
        }

        .platform-features {
            position: relative;
            z-index: 1;
            margin-top: 40px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin: 20px 0;
            padding: 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-item:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent);
        }

        .feature-item i {
            margin-right: 16px;
            font-size: 24px;
            color: var(--accent);
        }

        .signin-section {
            flex: 1;
            padding: 48px;
            background: var(--surface);
        }

        .signin-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .signin-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 12px;
            background: linear-gradient(to right, var(--accent), var(--primary));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 14px 45px 14px 20px;
            background: var(--surface-light);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text);
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.1);
            outline: none;
        }

        .form-group i {
            position: absolute;
            right: 16px;
            top: 45px;
            color: var(--accent);
            font-size: 18px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
        }

        .forgot-password a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: var(--primary);
        }

        .signin-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .signin-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -8px var(--primary);
        }

        .social-signin {
            margin-top: 32px;
            text-align: center;
        }

        .social-signin p {
            color: var(--text-secondary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .social-signin p::before,
        .social-signin p::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--surface-light);
        }

        .social-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }

        .social-button {
            padding: 12px 24px;
            border: 2px solid var(--surface-light);
            border-radius: 12px;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-button:hover {
            border-color: var(--accent);
            background: rgba(129, 140, 248, 0.1);
        }

        .signup-link {
            text-align: center;
            margin-top: 24px;
            color: var(--text-secondary);
        }

        .signup-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
            }

            .info-section {
                padding: 32px;
            }

            .signin-section {
                padding: 32px;
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="info-section">
            <h2>Welcome to Youdemy</h2>
            <p>Your gateway to knowledge and skills</p>

            <div class="platform-features">
                <div class="feature-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Access to 1000+ courses</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-certificate"></i>
                    <span>Earn verified certificates</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <span>Learn from expert instructors</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>Learn at your own pace</span>
                </div>
            </div>
        </div>

        <div class="signin-section">
            <div class="signin-header">
                <h2>Sign In</h2>
                <p>Continue your learning journey</p>
            </div>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Username or Email</label>
                    <input type="text" id="username" name="email" required>
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <div class="forgot-password">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="signin-button">
                    Sign In <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="social-signin">
                <p>Or continue with</p>
                <div class="social-buttons">
                    <button class="social-button">
                        <i class="fab fa-google"></i>
                        Google
                    </button>
                    <button class="social-button">
                        <i class="fab fa-github"></i>
                        GitHub
                    </button>
                </div>
            </div>

            <div class="signup-link">
                New to Youdemy? <a href="signUp.php">Create an account</a>
            </div>
        </div>
    </div>
</body>

</html>