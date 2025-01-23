<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';
require_once '../classes/classCategorie.php';
require_once '../classes/classTags.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['data'])) {
        $data = $_POST['data'];

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "test_db";

        $inserter = new tags();
        $result = $inserter->ajouterTags($data);

        echo $result;
    } else {
        echo "Veuillez remplir le champ avec les données.";
    }
} else {
    echo "Méthode non autorisée.";
}

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
                        'primary': '#6366f1',
                        'primary-dark': '#4f46e5',
                        'surface': '#1e1b4b',
                        'surface-dark': '#312e81'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-dark to-surface min-h-screen">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full w-[280px] bg-dark-light/50 backdrop-blur-xl border-r border-white/5 z-20">
        <div class="p-6">
            <div class="py-5 border-b border-white/10 mb-6">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-primary to-violet-400 bg-clip-text text-transparent">Youdemy Admin</h2>
            </div>
            <nav class="space-y-1">
                <a href="DashboardAdmin.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 rounded-lg transition-colors">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="users.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 rounded-lg transition-colors">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="courses.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 rounded-lg transition-colors">
                    <i class="fas fa-book"></i>
                    <span>Courses</span>
                </a>
                
                <a href="tags.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 rounded-lg transition-colors">
                    <i class="fas fa-tags"></i>
                    <span>Tags</span>
                </a>
                <a href="categories.php" class="flex items-center gap-3 px-4 py-3 text-primary bg-primary/10 rounded-lg">
                    <i class="fas fa-sitemap"></i>
                    <span>Categories</span>
                </a>
                <a href="settings.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 rounded-lg transition-colors">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Top Navigation -->
    <nav class="fixed top-0 right-0 w-[calc(100%-280px)] bg-dark-light/50 backdrop-blur-xl border-b border-white/5 z-10">
        <div class="px-8">
            <div class="flex justify-end h-16">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <input type="text" placeholder="Search categories..."
                            class="w-64 px-4 py-2 rounded-xl bg-dark/50 border border-white/10 focus:outline-none focus:border-primary/50 text-gray-300 placeholder-gray-500">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-500"></i>
                    </div>
                    <button class="p-2 rounded-xl hover:bg-white/5 transition-colors">
                        <i class="fas fa-bell text-gray-400"></i>
                    </button>
                    <div class="flex items-center gap-3 bg-white/5 px-3 py-1.5 rounded-xl">
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
    <main class="ml-[280px] pt-20 px-8">
        <!-- Header -->
        <!-- Add Category Card --><!-- Header section with search and add button -->
        <div class="max-w-7xl mx-auto py-6">
            <div class="flex justify-between items-center gap-4">
                <form action="" method="POST">
                    <div class="flex items-center gap-4">
                        <!-- New Category Input -->
                        <div class="relative">
                            <input name="data" type="text" placeholder="Enter new category name..." class="w-64 px-4 py-3 bg-dark/50 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <i class="fas fa-sitemap text-gray-500"></i>
                            </div>
                        </div>
                        <!-- Add Category Button -->
                        <button class="px-6 py-3 bg-primary hover:bg-primary-dark rounded-xl flex items-center gap-2 
                         transition-all duration-300 font-medium text-white whitespace-nowrap">
                            <i class="fas fa-plus"></i>
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Category Card 1 -->
            <!-- <?php foreach ($data as $data) : ?>
                <div class="bg-dark-light/50 backdrop-blur-sm rounded-xl border border-white/5 overflow-hidden group hover:border-primary/50 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300">
                    <div class="h-36 bg-gradient-to-r from-primary/20 to-violet-500/20 flex items-center justify-center relative">
                        <i class="fas fa-code text-5xl text-primary opacity-75"></i>
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-light/90 to-transparent"></div>
                    </div>
                    <div class="p-6 relative">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-white"><?= htmlspecialchars($categorie['nom']) ?></h3>
                                <p class="text-gray-400 text-sm">24 courses</p>
                            </div>
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <button class="p-2 hover:bg-white/5 rounded-lg text-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="" method="POST">
                                    <input type="hidden" name="catId" value="<?= htmlspecialchars($categorie['categorie_id']) ?>">
                                    <button name="delete" class="p-2 hover:bg-white/5 rounded-lg text-red-400">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-400">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-users"></i>
                                <span>1.2k students</span>
                            </div>
                            <div class="w-1 h-1 bg-gray-600 rounded-full"></div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-500"></i>
                                <span>4.8</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?> -->



            <!-- Category Stats -->
            <!-- <div class="max-w-7xl mx-auto bg-dark-light/50 backdrop-blur-sm rounded-xl border border-white/5 p-8 mb-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-white">Category Statistics</h2>
                <select class="bg-dark/50 border border-white/10 rounded-xl px-4 py-2.5 text-gray-300 focus:outline-none focus:border-primary/50">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 3 months</option>
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> -->
            <!-- Most Popular Category -->
            <!-- <div class="p-6 bg-dark/50 rounded-xl border border-white/5 hover:border-primary/50 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center">
                            <i class="fas fa-crown text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-400 text-sm">Most Popular</h3>
                            <p class="text-xl font-bold text-white">Programming</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-green-400 text-sm">
                        <i class="fas fa-arrow-up"></i>
                        <span>45% of total enrollments</span>
                    </div>
                </div> -->

            <!-- Fastest Growing -->
            <!-- <div class="p-6 bg-dark/50 rounded-xl border border-white/5 hover:border-primary/50 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-violet-500/20 flex items-center justify-center">
                            <i class="fas fa-rocket text-violet-400"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-400 text-sm">Fastest Growing</h3>
                            <p class="text-xl font-bold text-white">Design</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-green-400 text-sm">
                        <i class="fas fa-arrow-up"></i>
                        <span>+28% this month</span>
                    </div>
                </div> -->

            <!-- Total Categories -->
            <!-- <div class="p-6 bg-dark/50 rounded-xl border border-white/5 hover:border-primary/50 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                            <i class="fas fa-layer-group text-blue-400"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-400 text-sm">Total Categories</h3>
                            <p class="text-xl font-bold text-white">12</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400 text-sm">
                        <i class="fas fa-check-circle"></i>
                        <span>All categories active</span>
                    </div>
                </div>
            </div>
        </div> -->
    </main>
</body>

</html>