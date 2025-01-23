<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header('Location: ../templates/signIn.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Teacher Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark': '#0f172a',
                        'dark-light': '#1e293b',
                        'primary': '#6366f1',
                        'primary-dark': '#4f46e5',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen">
    <!-- Top Navigation -->
    <nav class="bg-slate-800/50 backdrop-blur-xl border-b border-slate-700/50 fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-500 to-violet-500 bg-clip-text text-transparent">Youdemy</span>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        <input type="text" 
                               placeholder="Search courses..." 
                               class="w-72 px-4 py-2.5 rounded-xl bg-slate-900/50 border border-slate-700/50 
                                      text-gray-100 placeholder-gray-500
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 
                                      transition-all duration-300 backdrop-blur-sm
                                      group-hover:border-slate-600">
                        <i class="fas fa-search absolute right-3 top-3 text-slate-600 group-hover:text-indigo-400 transition-colors duration-300"></i>
                    </div>
                    <button class="p-2 rounded-xl hover:bg-slate-700/50 transition-colors">
                        <i class="fas fa-bell text-slate-400 hover:text-indigo-400 transition-colors duration-300"></i>
                    </button>
                    <div class="flex items-center gap-3 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-700/50">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                        <span class="text-gray-300"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Teacher'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-16 h-full w-64 bg-slate-800/50 backdrop-blur-xl border-r border-slate-700/50">
        <div class="p-4">
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-indigo-400 bg-indigo-500/10 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="mesCours.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-users"></i>
                    <span>My Students</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </aside>
        <!-- Main Content -->
        <main class="ml-64 pt-16">
        <div class="p-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-indigo-400"></i>
                        </div>
                        <span class="text-sm text-emerald-400">+8%</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">My Students</h3>
                    <p class="text-2xl font-bold text-white">256</p>
                </div>

                <!-- Active Courses -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-violet-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-violet-400"></i>
                        </div>
                        <span class="text-sm text-emerald-400">+3</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Active Courses</h3>
                    <p class="text-2xl font-bold text-white">12</p>
                </div>

                <!-- Total Revenue -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-emerald-400"></i>
                        </div>
                        <span class="text-sm text-emerald-400">+12%</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Monthly Revenue</h3>
                    <p class="text-2xl font-bold text-white">$3,456</p>
                </div>

                <!-- Course Rating -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-amber-400"></i>
                        </div>
                        <span class="text-sm text-emerald-400">+0.2</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Average Rating</h3>
                    <p class="text-2xl font-bold text-white">4.8</p>
                </div>
            </div>

            <!-- Recent Courses Table -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50">
                <div class="p-6 border-b border-slate-700/50">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white">My Recent Courses</h2>
                        <button class="text-indigo-400 hover:text-indigo-300 transition-colors">View All</button>
                    </div>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-400">
                                <th class="pb-4">Course</th>
                                <th class="pb-4">Students</th>
                                <th class="pb-4">Rating</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-slate-700/50">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-slate-700/50 flex items-center justify-center">
                                            <i class="fas fa-laptop-code text-indigo-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-100 font-medium">Web Development Basics</p>
                                            <p class="text-gray-500 text-sm">12 Lessons</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-300">86 Students</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-1 text-amber-400">
                                        <i class="fas fa-star"></i>
                                        <span class="text-gray-300">4.8</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 text-indigo-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-red-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Add more course rows here with the same structure -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>