<?php
require_once "../classes/classCours.php"; 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'etudiant') {
    header('Location: ../templates/signIn.php');
    exit();
}

$userId = 1;  
$coursObj = new Cours();
$courses = $coursObj->getMescourses();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                        <i class="fas fa-search absolute right-3 top-3 text-slate-600"></i>
                    </div>
                    <button class="p-2 rounded-xl hover:bg-slate-700/50 transition-colors">
                        <i class="fas fa-bell text-slate-400"></i>
                    </button>
                    <div class="flex items-center gap-3 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-700/50">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                        <span class="text-gray-300"><?php echo htmlspecialchars($_SESSION['username']) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-16 h-full w-64 bg-slate-800/50 backdrop-blur-xl border-r border-slate-700/50">
        <div class="p-4">
            <nav class="space-y-1">
                <a href="DashboardEtudiant.php" class="flex items-center gap-3 px-4 py-3 text-indigo-400 bg-indigo-500/10 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="mycourses.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-certificate"></i>
                    <span>Certificates</span>
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
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">My Learning Journey</h1>
                <p class="text-gray-400">Track your progress across different categories</p>
            </div>

            <!-- Categories Tabs -->
            <div class="mb-8 flex gap-4 overflow-x-auto pb-2">
                <button class="px-6 py-2 bg-indigo-500 text-white rounded-xl">All Courses</button>
                <button class="px-6 py-2 bg-slate-800/50 text-gray-400 rounded-xl hover:bg-slate-700/50 transition-colors">Web Development</button>
                <button class="px-6 py-2 bg-slate-800/50 text-gray-400 rounded-xl hover:bg-slate-700/50 transition-colors">Mobile Development</button>
                <button class="px-6 py-2 bg-slate-800/50 text-gray-400 rounded-xl hover:bg-slate-700/50 transition-colors">Data Science</button>
                <button class="px-6 py-2 bg-slate-800/50 text-gray-400 rounded-xl hover:bg-slate-700/50 transition-colors">Design</button>
            </div>

            <!-- Courses Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">My Courses</h2>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span><?php echo count($courses); ?> courses</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($courses as $course): ?>
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 overflow-hidden group hover:border-indigo-500/50 transition-all duration-300">
                        <div class="relative h-48">
                            <img src="<?php echo $course['image']; ?>" alt="Course" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/75 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-white mb-2"><?php echo $course['titre']; ?></h3>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-400 mb-2">
                                    <span>Progress</span>
                                    <span>60%</span> <!-- You can dynamically compute progress here -->
                                </div>
                                <div class="w-full h-2 bg-slate-700 rounded-full overflow-hidden">
                                    <div class="h-full w-[60%] bg-indigo-500 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-400 mb-4">
                                <span>12/20 lessons</span> <!-- Change to dynamic lesson count -->
                                <span>6 hours left</span> <!-- Add dynamic remaining time here -->
                            </div>
                            <button class="w-full px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                                Continue Learning
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
