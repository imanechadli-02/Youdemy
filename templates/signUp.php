<?php 
require_once '../config/config.php';
require '../classes/UserClass.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    $user = new User($username, $email, $password, $role);
    $user->signup();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Youdemy Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8b5cf6',
                        'primary-dark': '#6d28d9',
                        background: '#0f172a',
                        'background-dark': '#1e1b4b',
                        surface: '#1e293b',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-background to-background-dark min-h-screen flex justify-center items-center p-5 font-poppins">
    <div class="flex max-w-[1000px] w-full mx-5 bg-surface/95 rounded-[20px] overflow-hidden shadow-2xl border border-white/10 md:flex-row flex-col">
        <!-- Info Section -->
        <div class="flex-1 bg-background/95 p-10 text-gray-200 flex flex-col justify-center">
            <h2 class="text-2xl font-bold">Join Youdemy Today</h2>
            <p class="text-gray-400">Start your learning journey with us</p>
            
            <div class="mt-8 space-y-4">
                <div class="flex items-center p-3 bg-white/5 rounded-lg border border-white/10 transition-transform duration-300 hover:translate-x-2.5 hover:bg-white/10">
                    <i class="fas fa-book-reader text-xl text-primary mr-4"></i>
                    <span>Personalized learning paths</span>
                </div>
                <div class="flex items-center p-3 bg-white/5 rounded-lg border border-white/10 transition-transform duration-300 hover:translate-x-2.5 hover:bg-white/10">
                    <i class="fas fa-video text-xl text-primary mr-4"></i>
                    <span>HD video courses</span>
                </div>
                <div class="flex items-center p-3 bg-white/5 rounded-lg border border-white/10 transition-transform duration-300 hover:translate-x-2.5 hover:bg-white/10">
                    <i class="fas fa-comments text-xl text-primary mr-4"></i>
                    <span>Interactive community</span>
                </div>
                <div class="flex items-center p-3 bg-white/5 rounded-lg border border-white/10 transition-transform duration-300 hover:translate-x-2.5 hover:bg-white/10">
                    <i class="fas fa-mobile-alt text-xl text-primary mr-4"></i>
                    <span>Learn on any device</span>
                </div>
            </div>
        </div>

        <!-- Sign Up Section -->
        <div class="flex-1 p-10 bg-surface/95">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-200 mb-2">Create Account</h2>
                <p class="text-gray-400">Join our learning community today</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div class="relative">
                    <label for="username" class="block mb-2 text-gray-200 font-medium">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-3 bg-background/95 border-2 border-white/10 rounded-lg text-gray-200 transition-all duration-300 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/10">
                    <i class="fas fa-user absolute right-4 top-[45px] text-primary"></i>
                </div>

                <div class="relative">
                    <label for="email" class="block mb-2 text-gray-200 font-medium">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 bg-background/95 border-2 border-white/10 rounded-lg text-gray-200 transition-all duration-300 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/10">
                    <i class="fas fa-envelope absolute right-4 top-[45px] text-primary"></i>
                </div>

                <div class="relative">
                    <label for="password" class="block mb-2 text-gray-200 font-medium">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 bg-background/95 border-2 border-white/10 rounded-lg text-gray-200 transition-all duration-300 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/10">
                    <i class="fas fa-lock absolute right-4 top-[45px] text-primary"></i>
                </div>

                <div class="relative">
                    <label for="role" class="block mb-2 text-gray-200 font-medium">I want to</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-3 bg-background/95 border-2 border-white/10 rounded-lg text-gray-200 transition-all duration-300 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/10 appearance-none">
                        <option value="" disabled selected>Select your role</option>
                        <option value="enseignant">enseignant</option>
                        <option value="admin">admin</option>
                        <option value="etudiant">etudiant</option>
                    </select>
                    <i class="fas fa-user-graduate absolute right-4 top-[45px] text-primary"></i>
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-gradient-to-r from-primary-dark to-primary text-white rounded-lg font-semibold flex items-center justify-center gap-2 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/25">
                    Create Account <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-400 mb-4">Or sign up with</p>
                <div class="flex justify-center gap-4">
                    <button class="px-6 py-2.5 border-2 border-white/10 rounded-lg bg-background/95 text-gray-200 hover:border-primary hover:bg-primary/10 transition-all duration-300 flex items-center gap-2">
                        <i class="fab fa-google"></i>
                        Google
                    </button>
                    <button class="px-6 py-2.5 border-2 border-white/10 rounded-lg bg-background/95 text-gray-200 hover:border-primary hover:bg-primary/10 transition-all duration-300 flex items-center gap-2">
                        <i class="fab fa-github"></i>
                        GitHub
                    </button>
                </div>
            </div>

            <div class="text-center mt-6 text-gray-400">
                Already have an account? 
                <a href="signIn.php" class="text-primary hover:text-primary-dark font-semibold transition-colors duration-300">
                    Sign In
                </a>
            </div>
        </div>
    </div>
</body>
</html>