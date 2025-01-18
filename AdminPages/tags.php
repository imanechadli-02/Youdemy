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
    <title>Youdemy Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#4338ca',
                        background: '#0f172a',
                        'background-dark': '#1e1b4b',
                        surface: '#1e293b',
                        'surface-light': '#334155',
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-background text-gray-100 font-[Poppins]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-[280px] bg-surface p-6 transition-all duration-300">
            <div class="py-5 border-b border-white/10 mb-6">
                <h2 class="text-2xl font-bold text-primary">Youdemy Admin</h2>
            </div>
            <div class="space-y-2">
                <div onclick="location.href='DashboardAdmin.php'" class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-home text-lg"></i>
                    <span>Dashboard</span>
                </div>
                <div onclick="location.href='users.php'" class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-users text-lg"></i>
                    <span>Users</span>
                </div>

                <div onclick="location.href='courses.php'" class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-book text-lg"></i>
                    <span>Courses</span>
                </div>
                <div onclick="location.href='tags.php'" class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-tags text-lg"></i>
                    <span>Tags</span>
                </div>
                <div onclick="location.href='categories.php'" class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-sitemap text-lg"></i>
                    <span>Categories</span>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl cursor-pointer text-gray-400 hover:bg-surface-light hover:text-white hover:translate-x-1 transition-all duration-300">
                    <i class="fas fa-cog text-lg"></i>
                    <span>Settings</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center p-6 mb-8 bg-surface rounded-xl">
                <h1 class="text-2xl font-bold">Dashboard Overview</h1>
                <div class="flex items-center gap-4">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>
                    <a href="logout.php" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white rounded-xl transition-all duration-300">Logout</a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-surface p-6 rounded-xl border border-white/10 hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-gray-400 mb-4">Total Students</h3>
                    <p class="text-3xl font-bold text-primary">1,234</p>
                </div>
                <div class="bg-surface p-6 rounded-xl border border-white/10 hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-gray-400 mb-4">Active Courses</h3>
                    <p class="text-3xl font-bold text-primary">42</p>
                </div>
                <div class="bg-surface p-6 rounded-xl border border-white/10 hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-gray-400 mb-4">Total Teachers</h3>
                    <p class="text-3xl font-bold text-primary">18</p>
                </div>
                <div class="bg-surface p-6 rounded-xl border border-white/10 hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-gray-400 mb-4">Revenue</h3>
                    <p class="text-3xl font-bold text-primary">$12,345</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-surface p-8 rounded-xl border border-white/10">
                <h2 class="text-2xl font-bold mb-6">Recent Activity</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-white/10">
                                <th class="p-4 text-gray-400 font-medium">Username</th>
                                <th class="p-4 text-gray-400 font-medium">Role</th>
                                <th class="p-4 text-gray-400 font-medium">Status</th>
                                <th class="p-4 text-gray-400 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-white/10">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-user text-primary"></i>
                                        <span>John Doe</span>
                                    </div>
                                </td>
                                <td class="p-4">Student</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-sm bg-green-500/20 text-green-400 rounded-full">
                                        Active
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <select class="w-[120px] bg-surface-light text-white px-4 py-2 rounded-lg border border-white/10 focus:outline-none focus:border-primary">
                                            <option value="" disabled selected>Action</option>
                                            <option value="activate">Activate</option>
                                            <option value="deactivate">Deactivate</option>
                                            <option value="suspend">Suspend</option>
                                        </select>
                                        <button class="flex items-center gap-2 px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-all duration-300">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>