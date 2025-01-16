<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EduLearn Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(120deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .page-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            margin: 20px;
            background: rgba(30, 41, 59, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-section {
            flex: 1;
            background: rgba(15, 23, 42, 0.95);
            padding: 40px;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .benefits-list {
            margin-top: 30px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            margin: 15px 0;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            transition: transform 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .benefit-item:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .benefit-item i {
            margin-right: 15px;
            font-size: 20px;
            color: #8b5cf6;
        }

        .signup-section {
            flex: 1;
            padding: 40px;
            background: rgba(30, 41, 59, 0.95);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h2 {
            color: #e2e8f0;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .signup-header p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #e2e8f0;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 40px 12px 15px;
            background: rgba(15, 23, 42, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            color: #e2e8f0;
        }

        .form-group i {
            position: absolute;
            right: 15px;
            top: 40px;
            color: #8b5cf6;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .signup-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #6d28d9, #8b5cf6);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .signup-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
        }

        .social-signup {
            margin-top: 30px;
            text-align: center;
        }

        .social-signup p {
            color: #94a3b8;
            margin-bottom: 15px;
            position: relative;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .social-button {
            padding: 10px 20px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            background: rgba(15, 23, 42, 0.95);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e2e8f0;
        }

        .social-button:hover {
            border-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.1);
        }

        .signin-link {
            text-align: center;
            margin-top: 20px;
            color: #94a3b8;
        }

        .signin-link a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 600;
        }

        .signin-link a:hover {
            color: #9f7aea;
        }

        /* Style for select options */
        select option {
            background: #1e1b4b;
            color: #e2e8f0;
        }

        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
            }
            
            .info-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="info-section">
            <h2>Join EduLearn Today</h2>
            <p>Start your learning journey with us</p>
            
            <div class="benefits-list">
                <div class="benefit-item">
                    <i class="fas fa-book-reader"></i>
                    <span>Personalized learning paths</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-video"></i>
                    <span>HD video courses</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-comments"></i>
                    <span>Interactive community</span>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Learn on any device</span>
                </div>
            </div>
        </div>

        <div class="signup-section">
            <div class="signup-header">
                <h2>Create Account</h2>
                <p>Join our learning community today</p>
            </div>

            <form action="processSignUp.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="form-group">
                    <label for="role">I want to</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="student">Learn as a Student</option>
                        <option value="teacher">Teach as an Instructor</option>
                    </select>
                    <i class="fas fa-user-graduate"></i>
                </div>
                
                <button type="submit" class="signup-button">
                    Create Account <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="social-signup">
                <p>Or sign up with</p>
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

            <div class="signin-link">
                Already have an account? <a href="signIn.php">Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>