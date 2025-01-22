<?php
require_once '../config/config.php';
require_once '../classes/classCours.php';
require_once '../classes/classCategorie.php';
require_once '../classes/classTags.php';

session_start();

// Ensure the course_id is set in the session before accessing this page
if (!isset($_SESSION['course_id'])) {
    echo "Course ID is not set.";
    exit;
} else {
    echo "Course ID: " . $_SESSION['course_id']; // Debugging output
}

// Initialize classes for categories and tags
$categoryObj = new Categorie();
$categories = $categoryObj->afficherCategories();

$tagsObj = new Tags();
$tags = $tagsObj->afficherTag();

// Get the course_id from the session
$id = $_SESSION['course_id'];

// Create an instance of the Cours class
$cours = new Cours();

$course = $cours->getCourseById($id);

if ($course) {
    // Fill in the course data
    $title = $course['titre'];
    $description = $course['description'];
    $image = $course['image'];
    $content = $course['content_text'];
} else {
    echo "Course not found. ID: $id"; // Debugging output
    exit;
}

// Handle the form submission to update the course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cours'])) {
    // Get the form data
    $newTitle = $_POST['title'];
    $newDescription = $_POST['description'];
    $newImage = $_POST['image'];
    $newContent = $_POST['content'];
    $newCategory = $_POST['category'];
    $newTags = 'here'; // Assuming multiple tags are selected as single selection

    // Update the course in the database
    if ($cours->updateCourse($id, $newTitle, $newDescription, $newImage, $newContent, $newCategory, $newTags)) {
        // Redirect to the course list page after successful update
        header("Location: mesCours.php");
        exit;
    } else {
        echo "Failed to update the course.";
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
            <form method="POST" action="" class="max-w-4xl">
                <!-- Course Preview Card -->
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6 mb-8">
                    <div class="flex items-start gap-6">
                        <div class="w-48 h-48 rounded-xl overflow-hidden">
                            <img src="https://example.com/course-image.jpg" alt="Course Preview" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400">Published</span>
                                <span class="text-gray-400">Last updated: 2 days ago</span>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-400 mb-4">
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-users"></i>
                                    86 students
                                </span>
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-star text-amber-400"></i>
                                    4.8 rating
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-white mb-6">Basic Information</h2>
                    <!-- Course Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Course Title</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100 placeholder-gray-500">
                    </div>

                    <!-- Course Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100 placeholder-gray-500"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <!-- Course Image URL -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Course Image URL</label>
                        <input type="url" id="image" name="image" value="<?php echo htmlspecialchars($image); ?>" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100 placeholder-gray-500">
                    </div>

                    <!-- Course Content -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Content</label>
                        <textarea id="content" name="content" rows="8" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100 placeholder-gray-500"><?php echo htmlspecialchars($content); ?></textarea>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select id="category" name="category" class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100">
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category['categorie_id']); ?>" <?php echo ($category['categorie_id'] == $course['category_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="mb-6">
                        <label for="tags" class="block text-sm font-medium text-gray-300 mb-2">Tags</label>
                        <select id="tags" name="tags[]" multiple class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700/50 rounded-xl text-gray-100">
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?php echo htmlspecialchars($tag['tag_id']); ?>" <?php echo (in_array($tag['tag_id'], explode(',', $course['tags']))) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($tag['tag_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="update_cours" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Update Course</button>
            </form>
        </div>
    </main>
</body>

</html>