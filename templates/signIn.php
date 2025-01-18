<?php
require_once '../config/config.php';
require '../classes/UserClass.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $user = new User('', $email, $password, '');
    $user->signIn();
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#4338ca',
                        secondary: '#6366f1',
                        background: '#0f172a',
                        surface: '#1e293b',
                        'surface-light': '#334155',
                        accent: '#818cf8',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-background to-surface min-h-screen flex justify-center items-center p-5 text-white font-inter">
    <div class="flex max-w-[1000px] w-full bg-surface/50 backdrop-blur-lg rounded-3xl overflow-hidden shadow-2xl border border-white/10">
        <!-- Info Section -->
        <div class="flex-1 bg-primary/10 p-12 relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-2">Welcome to Youdemy</h2>
                <p class="text-gray-300">Your gateway to knowledge and skills</p>

                <div class="mt-10 space-y-5">
                    <div class="flex items-center p-4 bg-white/5 rounded-2xl border border-white/10 transition-all duration-300 hover:translate-x-2.5 hover:bg-white/10 hover:border-accent">
                        <i class="fas fa-graduation-cap text-2xl text-accent mr-4"></i>
                        <span>Access to 1000+ courses</span>
                    </div>
                    <div class="flex items-center p-4 bg-white/5 rounded-2xl border border-white/10 transition-all duration-300 hover:translate-x-2.5 hover:bg-white/10 hover:border-accent">
                        <i class="fas fa-certificate text-2xl text-accent mr-4"></i>
                        <span>Earn verified certificates</span>
                    </div>
                    <div class="flex items-center p-4 bg-white/5 rounded-2xl border border-white/10 transition-all duration-300 hover:translate-x-2.5 hover:bg-white/10 hover:border-accent">
                        <i class="fas fa-users text-2xl text-accent mr-4"></i>
                        <span>Learn from expert instructors</span>
                    </div>
                    <div class="flex items-center p-4 bg-white/5 rounded-2xl border border-white/10 transition-all duration-300 hover:translate-x-2.5 hover:bg-white/10 hover:border-accent">
                        <i class="fas fa-clock text-2xl text-accent mr-4"></i>
                        <span>Learn at your own pace</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sign In Section -->
        <div class="flex-1 p-12 bg-surface">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-3 bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                    Sign In
                </h2>
                <p class="text-gray-400">Continue your learning journey</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div class="relative">
                    <label for="email" class="block mb-2 font-medium">Username or Email</label>
                    <input type="text" id="username" name="email" required
                        class="w-full px-5 py-3.5 bg-surface-light border-2 border-white/10 rounded-xl text-white transition-all duration-300 focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/10">
                    <i class="fas fa-user absolute right-4 top-[48px] text-accent"></i>
                </div>

                <div class="relative">
                    <label for="password" class="block mb-2 font-medium">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-5 py-3.5 bg-surface-light border-2 border-white/10 rounded-xl text-white transition-all duration-300 focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/10">
                    <i class="fas fa-lock absolute right-4 top-[48px] text-accent"></i>
                </div>

                <div class="flex justify-between items-center">
                    <label class="flex items-center gap-2 text-gray-400">
                        <input type="checkbox" name="remember" class="rounded border-gray-600 text-accent focus:ring-accent">
                        <span>Remember me</span>
                    </label>
                    <a href="forgot-password.php" class="text-accent hover:text-primary transition-colors duration-300">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" 
                    class="w-full py-3.5 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-semibold flex items-center justify-center gap-2 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/25">
                    Sign In <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="mt-8 text-center">
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-1 h-px bg-surface-light"></div>
                    <p class="text-gray-400">Or continue with</p>
                    <div class="flex-1 h-px bg-surface-light"></div>
                </div>

                <div class="flex justify-center gap-4">
                    <button class="px-6 py-3 border-2 border-surface-light rounded-xl text-white hover:border-accent hover:bg-accent/10 transition-all duration-300 flex items-center gap-2">
                        <i class="fab fa-google"></i>
                        Google
                    </button>
                    <button class="px-6 py-3 border-2 border-surface-light rounded-xl text-white hover:border-accent hover:bg-accent/10 transition-all duration-300 flex items-center gap-2">
                        <i class="fab fa-github"></i>
                        GitHub
                    </button>
                </div>
            </div>

            <div class="text-center mt-6 text-gray-400">
                New to Youdemy? 
                <a href="signUp.php" class="text-accent hover:text-primary font-semibold transition-colors duration-300">
                    Create an account
                </a>
            </div>
        </div>
    </div>
</body>
</html>