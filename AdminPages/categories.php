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
    <title>Categories Management - Youdemy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark': '#0f172a',
                        'dark-light': '#1e293b',
                        'primary': '#8b5cf6',
                        'primary-dark': '#7c3aed',
                        'surface': '#1e1b4b',
                        'surface-dark': '#312e81'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-dark text-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-dark-light border-b border-gray-800 fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-primary">Youdemy</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search categories..." 
                               class="w-64 px-4 py-2 rounded-lg bg-dark border border-gray-700 focus:outline-none focus:border-primary text-gray-300">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-500"></i>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-dark-light">
                        <i class="fas fa-bell text-gray-400"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <span class="text-gray-300"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16 px-8">
        <!-- Header -->
        <div class="max-w-7xl mx-auto py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-100">Categories Management</h1>
                <button class="px-4 py-2 bg-primary hover:bg-primary-dark rounded-lg flex items-center gap-2 transition-all duration-300">
                    <i class="fas fa-plus"></i>
                    Add Category
                </button>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Category Card -->
            <div class="bg-dark-light rounded-xl border border-gray-800 overflow-hidden group hover:border-primary/50 transition-all duration-300">
                <div class="h-32 bg-gradient-to-r from-primary/20 to-surface-dark flex items-center justify-center">
                    <i class="fas fa-code text-4xl text-primary"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-100">Programming</h3>
                            <p class="text-gray-400 text-sm">24 courses</p>
                        </div>
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <button class="p-2 hover:bg-dark rounded-lg text-blue-400">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 hover:bg-dark rounded-lg text-red-400">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <i class="fas fa-users"></i>
                        <span>1.2k students enrolled</span>
                    </div>
                </div>
            </div>

            <!-- Category Card -->
            <div class="bg-dark-light rounded-xl border border-gray-800 overflow-hidden group hover:border-primary/50 transition-all duration-300">
                <div class="h-32 bg-gradient-to-r from-purple-500/20 to-surface-dark flex items-center justify-center">
                    <i class="fas fa-palette text-4xl text-purple-400"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-100">Design</h3>
                            <p class="text-gray-400 text-sm">18 courses</p>
                        </div>
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <button class="p-2 hover:bg-dark rounded-lg text-blue-400">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 hover:bg-dark rounded-lg text-red-400">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <i class="fas fa-users"></i>
                        <span>856 students enrolled</span>
                    </div>
                </div>
            </div>

            <!-- Add Category Card -->
            <div class="bg-dark-light rounded-xl border border-gray-800 border-dashed flex items-center justify-center h-[232px] cursor-pointer hover:border-primary/50 transition-all duration-300">
                <div class="text-center">
                    <div class="w-12 h-12 rounded-lg bg-primary/20 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-plus text-primary"></i>
                    </div>
                    <p class="text-gray-400">Add New Category</p>
                </div>
            </div>
        </div>

        <!-- Category Stats -->
        <div class="max-w-7xl mx-auto bg-dark-light rounded-xl border border-gray-800 p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Category Statistics</h2>
                <select class="bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-300 focus:outline-none focus:border-primary">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 3 months</option>
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-dark rounded-lg border border-gray-800">
                    <h3 class="text-gray-400 mb-2">Most Popular Category</h3>
                    <p class="text-2xl font-bold text-primary">Programming</p>
                    <p class="text-gray-400 text-sm">45% of total enrollments</p>
                </div>
                <div class="p-4 bg-dark rounded-lg border border-gray-800">
                    <h3 class="text-gray-400 mb-2">Fastest Growing</h3>
                    <p class="text-2xl font-bold text-purple-400">Design</p>
                    <p class="text-gray-400 text-sm">+28% this month</p>
                </div>
                <div class="p-4 bg-dark rounded-lg border border-gray-800">
                    <h3 class="text-gray-400 mb-2">Total Categories</h3>
                    <p class="text-2xl font-bold text-blue-400">12</p>
                    <p class="text-gray-400 text-sm">Active categories</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>