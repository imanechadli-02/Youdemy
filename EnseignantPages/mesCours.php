<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';
require_once '../classes/classCours.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header('Location: ../templates/signIn.php');
    exit();
}
$cour = new Cours();
$cour->setEnseignantId($_SESSION['user_id']);
$cours = $cour->afficherCardCours();




if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_btn'])) {
    $_SESSION['course_id'] = $_POST['edit_btn']; 
    header("Location: editCours.php"); 
    exit();
}

if (isset($_POST['delete'])) {
    if (isset($_POST['cours_id'])) {
        $coursId = $_POST['cours_id'];
        $cour->DeleteCours($coursId); 
        header("Location: mesCours.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
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
                <a href="DashboardEnseignant.php" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="mesCours.php" class="flex items-center gap-3 px-4 py-3 text-indigo-400 bg-indigo-500/10 rounded-lg">
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
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">My Courses</h1>
                    <p class="text-gray-400">Manage and monitor your courses</p>
                </div>
                <a id="openModal"
                    class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl
                          transition-colors duration-300 flex items-center gap-2 cursor-pointer">
                    <i class="fas fa-plus"></i>
                    Create New Course
                </a>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card -->
                <?php foreach ($cours as $cour) : ?>
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 overflow-hidden group hover:border-indigo-500/50 transition-all duration-300">

                        <!-- Course Image -->

                        <div class="relative h-48 overflow-hidden">
                            <img src="<?= htmlspecialchars($cour['image']) ?>"
                                alt="Course Image"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/75 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                                <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400">
                                    <?= htmlspecialchars($cour['nom']) ?>
                                </span>

                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-white mb-2 line-clamp-1">
                                <?= htmlspecialchars($cour['titre']) ?>
                            </h3>
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                <?= htmlspecialchars($cour['description']) ?>
                            </p>

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

                            <!-- Action Buttons -->
                            <form action="" method="POST">
                                <div class="flex items-center gap-2">
                                    <button name="edit_btn" value="<?= htmlspecialchars($cour['cours_id']) ?>" class="flex-1 px-4 py-2 bg-slate-700/50 hover:bg-slate-700 text-white rounded-lg transition-colors duration-300 text-center text-sm">
                                        Edit Course
                                    </button>

                                    <!-- Add a hidden input field for cours_id -->
                                    <input type="hidden" name="cours_id" value="<?= htmlspecialchars($cour['cours_id']) ?>">

                                    <button type="submit" name="delete" class="p-2 text-gray-400 hover:text-red-400 hover:bg-slate-700/50 rounded-lg transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>

    <!-- Modal for Course Creation -->
    <div id="createCourseModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-20">
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-xl shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-xl font-bold text-white mb-4">Créer un nouveau cours</h2>
            <p class="text-gray-400 mb-6">Choisissez le type de cours que vous souhaitez créer :</p>
            <div class="flex flex-col gap-4">
                <a href="ajouterCours.php"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg text-center transition-colors duration-300">
                    Créer un cours texte
                </a>
                <a href="ajouterCoursvideo.php"
                    class="px-4 py-2 bg-violet-500 hover:bg-violet-600 text-white rounded-lg text-center transition-colors duration-300">
                    Créer un cours vidéo
                </a>
            </div>
            <button id="closeModal"
                class="mt-6 w-full px-4 py-2 bg-slate-700 hover:bg-slate-600 text-gray-400 rounded-lg text-center transition-colors">
                Annuler
            </button>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        const modal = document.getElementById('createCourseModal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');

        openModal.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>