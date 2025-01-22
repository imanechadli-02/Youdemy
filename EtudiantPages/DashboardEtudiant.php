<?php

require_once '../config/config.php';
// require_once '../classes/UserClass.php';
require_once '../classes/classCours.php';
session_start();

$cour = new Cours();
$cours = $cour->afficherToutCardCours();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['details_btn'])) {
    $_SESSION['type_content'] = $_POST['type_content'];
    $_SESSION['cours_id'] = $_POST['details_btn'];
    header("Location: detailCours.php");
}


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['enroll_btn'])) {
    $userId = $_SESSION['user_id'];  // ID de l'utilisateur
    $coursId = $_POST['enroll_btn'];  // ID du cours



    // Debugging output
    echo "User ID: " . htmlspecialchars($userId) . "<br>";
    echo "Course ID: " . htmlspecialchars($coursId) . "<br>";

    // Appel de la fonction pour ajouter le cours à l'utilisateur
    $coursObj = new Cours();
    $coursObj->AjoutermesCours($userId, $coursId);

    echo "<script>alert('Vous avez été inscrit avec succès au cours !');</script>";
    // Rediriger vers la page des cours ou une autre page pertinente après l'inscription
    header("Location: DashboardEtudiant.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Youdemy</title>
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
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-indigo-400 bg-indigo-500/10 rounded-lg">
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
            <!-- Welcome Section -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-2">Welcome back, Student!</h1>
                        <p class="text-gray-400">Continue your learning journey</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-400">Your Progress</p>
                            <p class="text-lg font-semibold text-white">75%</p>
                        </div>
                        <div class="w-16 h-16 rounded-full border-4 border-indigo-500 flex items-center justify-center">
                            <span class="text-lg font-bold text-indigo-400">75%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Categories -->
            <div class="grid grid-cols-4 gap-4 mb-8">
                <button class="p-4 bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all">
                    <i class="fas fa-code text-2xl text-indigo-400 mb-2"></i>
                    <p class="text-white">Programming</p>
                </button>
                <button class="p-4 bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all">
                    <i class="fas fa-paint-brush text-2xl text-violet-400 mb-2"></i>
                    <p class="text-white">Design</p>
                </button>
                <button class="p-4 bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all">
                    <i class="fas fa-chart-line text-2xl text-emerald-400 mb-2"></i>
                    <p class="text-white">Business</p>
                </button>
                <button class="p-4 bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 hover:border-indigo-500/50 transition-all">
                    <i class="fas fa-language text-2xl text-amber-400 mb-2"></i>
                    <p class="text-white">Languages</p>
                </button>
            </div>

            <!-- Available Courses -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-white mb-6">Available Courses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card -->
                    <?php foreach ($cours as $cour) : ?>
                        <!-- <a href="detailCours.php?id=<?= urlencode($cour['cours_id']) ?>"> -->
                        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 overflow-hidden group hover:border-indigo-500/50 transition-all duration-300">
                            <div class="relative h-48">
                                <img src="<?= htmlspecialchars($cour['image']) ?>"
                                    alt="Course Image"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/75 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                                    <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400">
                                        <?= htmlspecialchars($cour['nom']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <form action="" method="post">
                                    <input name="type_content" type="hidden" value="<?= htmlspecialchars($cour['type']) ?>">
                                    <button name="details_btn" value="<?= htmlspecialchars($cour['cours_id']) ?>">
                                        <h3 class="text-xl font-semibold text-white mb-2"><?= htmlspecialchars($cour['titre']) ?></h3>
                                    </button>
                                </form>
                                <p class="text-gray-400 text-sm mb-4"><?= htmlspecialchars($cour['description']) ?></p>
                                <div class="flex items-center justify-between mb-4">
                                    <!-- Course Stats -->
                                    <div class="flex items-center justify-between text-sm text-gray-400 mb-4">
                                        <?php if (htmlspecialchars($cour['type']) === 'video'): ?>
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-video"></i>
                                                <?= htmlspecialchars($cour['type']) ?>
                                            </span>
                                        <?php elseif (htmlspecialchars($cour['type']) === 'text'): ?>
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-file-alt"></i>
                                                <?= htmlspecialchars($cour['type']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-gray-400 text-sm">
                                        <i class="fas fa-user-tie text-indigo-400 mr-2"></i>
                                        <?= htmlspecialchars($cour['username']) ?>
                                    </span>

                                </div>
                                <form action="" method="POST">
                                    <button name="enroll_btn" value="<?= htmlspecialchars($cour['cours_id']) ?>"
                                        class="w-full px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg transition-colors">
                                        Enroll Now
                                    </button>
                                </form>

                            </div>
                        </div>
                        <!-- </a> -->
                    <?php endforeach ?>

                    <!-- Répétez la carte de cours pour plus de cours -->
                </div>
            </div>


        </div>
    </main>
</body>

</html>