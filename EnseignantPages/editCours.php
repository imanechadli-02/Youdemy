<?php
require_once "../config/config.php";
require_once "../classes/classCours.php";

// Vérification de l'ID du cours
if (isset($_GET['cours_id'])) {
    $cour_id = intval($_GET['cours_id']);
    $cour = new Cours(); // Initialisation de l'objet
    $coursData = $cour->getCoursById($cour_id); // Récupération des données du cours
    if (!$coursData) {
        die("Course not found!");
    }
} else {
    die("Course ID is missing!");
}

// Traitement de l'édition
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $new_titre = $_POST['title'] ?? '';
    $new_description = $_POST['description'] ?? '';
    $new_image = $_POST['image'] ?? '';
    $new_content = $_POST['content'] ?? '';
    $new_categorie_id = $_POST['category'] ?? null;

    $updated = $cour->modifierCours(
        $cour_id,
        $new_titre,
        $new_description,
        $new_image,
        $new_content,
        $new_categorie_id,
        null
    );

    if ($updated) {
        echo "<script>alert('Course updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update course.');</script>";
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - Youdemy</title>
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
                    <button class="p-2 rounded-xl hover:bg-slate-700/50 transition-colors">
                        <i class="fas fa-bell text-slate-400"></i>
                    </button>
                    <div class="flex items-center gap-3 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-700/50">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                        <span class="text-gray-300">Teacher Name</span>
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
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Edit Course</h1>
                <p class="text-gray-400">Update your course information</p>
            </div>

            <!-- Edit Form -->
            <form method="POST" class="max-w-4xl">
                <!-- Course Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Course Title</label>
                    <input type="text"
                        id="title"
                        name="title"
                        value="<?= htmlspecialchars($cour['titre']) ?>"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                  text-gray-100 placeholder-gray-500
                  focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                </div>

                <!-- Course Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                       text-gray-100 placeholder-gray-500
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50"><?= htmlspecialchars($cour['description']) ?></textarea>
                </div>

                <!-- Course Image URL -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Course Image URL</label>
                    <input type="url"
                        id="image"
                        name="image"
                        value="<?= htmlspecialchars($cour['image']) ?>"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                  text-gray-100 placeholder-gray-500
                  focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Content</label>
                    <textarea id="content" name="content" rows="8"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                       text-gray-100 placeholder-gray-500
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50"><?= htmlspecialchars($cour['content_text']) ?></textarea>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100">
                        <option value="web-dev" <?= $cour['categorie_id'] == 'web-dev' ? 'selected' : '' ?>>Web Development</option>
                        <option value="mobile-dev" <?= $cour['categorie_id'] == 'mobile-dev' ? 'selected' : '' ?>>Mobile Development</option>
                        <option value="data-science" <?= $cour['categorie_id'] == 'data-science' ? 'selected' : '' ?>>Data Science</option>
                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-300 mb-2">Tags</label>
                    <input type="text" id="tags" name="tags" value="javascript, web, frontend"
                        class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                  text-gray-100 placeholder-gray-500
                  focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                </div>

                <!-- Submit Button -->
                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" name="edit"
                        class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl
                  transition-colors duration-300">
                        Save Changes
                    </button>
                    <a href="mesCours.php" class="px-6 py-3 border border-slate-700/50 text-gray-300 rounded-xl">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </main>
</body>

</html>