<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';
session_start();
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
                        'primary': '#3b82f6',
                        'secondary': '#6366f1',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#f3f4f6]">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-primary">Youdemy</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search courses..." 
                               class="w-64 px-4 py-2 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <img src="https://ui-avatars.com/api/?name=Teacher&background=3b82f6&color=fff" 
                             alt="Profile" 
                             class="w-8 h-8 rounded-full">
                        <span class="text-gray-700"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Teacher'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-16 h-full w-64 bg-white shadow-sm">
        <div class="p-4">
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-primary bg-primary/10 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-users"></i>
                    <span>My Students</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-500"></i>
                        </div>
                        <span class="text-sm text-green-500">+8%</span>
                    </div>
                    <h3 class="text-gray-500 text-sm">My Students</h3>
                    <p class="text-2xl font-bold text-gray-800">256</p>
                </div>

                <!-- Active Courses -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-purple-500"></i>
                        </div>
                        <span class="text-sm text-green-500">+3</span>
                    </div>
                    <h3 class="text-gray-500 text-sm">Active Courses</h3>
                    <p class="text-2xl font-bold text-gray-800">12</p>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-green-500"></i>
                        </div>
                        <span class="text-sm text-green-500">+12%</span>
                    </div>
                    <h3 class="text-gray-500 text-sm">Monthly Revenue</h3>
                    <p class="text-2xl font-bold text-gray-800">$3,456</p>
                </div>

                <!-- Course Rating -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                        <span class="text-sm text-green-500">+0.2</span>
                    </div>
                    <h3 class="text-gray-500 text-sm">Average Rating</h3>
                    <p class="text-2xl font-bold text-gray-800">4.8</p>
                </div>
            </div>

            <!-- Recent Courses Table -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">My Recent Courses</h2>
                        <button class="text-primary hover:text-primary-dark">View All</button>
                    </div>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-500">
                                <th class="pb-4">Course</th>
                                <th class="pb-4">Students</th>
                                <th class="pb-4">Rating</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-laptop-code text-gray-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-700 font-medium">Web Development Basics</p>
                                            <p class="text-gray-500 text-sm">12 Lessons</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-600">86 Students</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-1 text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span>4.8</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
