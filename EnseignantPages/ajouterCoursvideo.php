<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';
require_once '../classes/classCategorie.php';
require_once '../classes/classTags.php';
require_once '../classes/classCoursVideo.php';


session_start();

// Check if user is logged in and is teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header('Location: ../templates/signIn.php');
    exit();
}

$categoryObj = new Categorie();
$categories = $categoryObj->afficherCategories();

$tagsObj = new Tags();
$tags = $tagsObj->afficherTag();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Créer une instance de CoursText
    $coursvideo = new CoursVideo();

    // Récupérer les données envoyées depuis le formulaire
    $coursvideo->setTitre($_POST['title']);
    $coursvideo->setDescription($_POST['description']);
    $coursvideo->setImage($_POST['image']);
    $coursvideo->setContentVideo($_POST['video']);
    $coursvideo->setTagId($_POST['tag']);
    $coursvideo->setCategorieId($_POST['category']);
    $coursvideo->setEnseignantId($_SESSION['user_id']);  // Assurez-vous d'avoir un ID utilisateur valide

    // Appeler la méthode ajouterCours pour insérer les données dans la base
    $coursvideo->ajouterCours();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course - Youdemy</title>
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
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Create New Course</h1>
                <p class="text-gray-400">Fill in the details to create your new course</p>
            </div>

            <!-- Course Form -->
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                <!-- Basic Information -->
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                    <h2 class="text-xl font-semibold text-white mb-6">Basic Information</h2>

                    <!-- Course Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Course Title</label>
                        <input type="text"
                            id="title"
                            name="title"
                            required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                      text-gray-100 placeholder-gray-500
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50"
                            placeholder="Enter course title">
                    </div>

                    <!-- Course Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea id="description"
                            name="description"
                            rows="4"
                            required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                         text-gray-100 placeholder-gray-500
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50"
                            placeholder="Describe your course"></textarea>
                    </div>

                    <!-- Course Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Course Image URL</label>
                        <div class="relative">
                            <input type="url"
                                id="image"
                                name="image"
                                required
                                class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                          text-gray-100 placeholder-gray-500
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50
                                          pr-10"
                                placeholder="https://example.com/image.jpg">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-link text-gray-500"></i>
                            </div>
                        </div>
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <img src="" alt="Course preview" class="w-full max-w-md rounded-xl border border-slate-700/50">
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                    <h2 class="text-xl font-semibold text-white mb-6">Course Content</h2>

                    <!-- Course Content Editor -->
                    <div class="mb-6">
                        <label for="video" class="block text-sm font-medium text-gray-300 mb-2">Video URL</label>
                        <input type="url"
                            id="video"
                            name="video"
                            required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                    text-gray-100 placeholder-gray-500
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50"
                            placeholder="https://example.com/video.mp4">
                    </div>

                </div>

                <!-- Categories and Tags -->
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                    <h2 class="text-xl font-semibold text-white mb-6">Categories & Tags</h2>

                    <!-- Category Selection -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select id="category"
                            name="category"
                            required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                       text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category['categorie_id']); ?>">
                                    <?php echo htmlspecialchars($category['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tags Input -->
                    <div class="mb-6">
                        <label for="tag" class="block text-sm font-medium text-gray-300 mb-2">tag</label>
                        <select id="tag"
                            name="tag"
                            required
                            class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl
                                    text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50">
                            <option value="">Select a tag</option>
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?php echo htmlspecialchars($tag['tag_id']); ?>">
                                    <?php echo htmlspecialchars($tag['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl
                                   transition-colors duration-300 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Create Course
                    </button>
                    <a href="DashboardEnseignant.php"
                        class="px-6 py-3 border border-slate-700/50 hover:bg-slate-700/50 text-gray-300 rounded-xl
                              transition-colors duration-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add preview functionality here
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle drag and drop
        const dropzone = document.querySelector('.border-dashed');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('image').files = files;
        }
    </script>
</body>

</html>