<?php

require_once '../config/config.php';
// require_once '../classes/UserClass.php';
require_once '../classes/classCours.php';
require_once '../classes/classCoursText.php';
require_once '../classes/classCoursVideo.php';

session_start();

// echo  $_SESSION['type_content'];
// echo $_SESSION['cours_id'] ;


switch ($_SESSION['type_content']) {
    case "text":
        $cours = new CoursText();
        $cours = $cours->afficherCours($_SESSION['cours_id']);
        break;
    case "video":
        $cours = new CoursVideo();
        $cours = $cours->afficherCours($_SESSION['cours_id']);
        break;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - Youdemy</title>
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
            <!-- Course Header -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 overflow-hidden mb-8">
                <div class="relative h-80">
                    <img src="<?php echo htmlspecialchars($cours['image']); ?>"
                        alt="Course Banner"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400"><?php echo htmlspecialchars($cours['nom']); ?></span>
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2"><?php echo htmlspecialchars($cours['titre']); ?></h1>
                        <div class="flex items-center gap-6 text-gray-300">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-user-tie text-indigo-400"></i>
                                <?php echo htmlspecialchars($cours['username']); ?>
                            </span>

                            <span class="flex items-center gap-2">
                                <i class="fas fa-users text-indigo-400"></i>
                                1,234 students
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Content Grid -->
            <div class="grid grid-cols-3 gap-8">
                <!-- Main Course Info -->
                <div class="col-span-2 space-y-6">
                    <!-- About This Course -->
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                        <h2 class="text-xl font-semibold text-white mb-4">About This Course</h2>
                        <p class="text-gray-300 leading-relaxed">
                        <?php echo htmlspecialchars($cours['description']); ?>
                        </p>
                    </div>



                    <!-- Course Content -->
                    <?php if ($_SESSION['type_content'] === 'text') : ?>
                        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">Course Content</h2>
                            <div class="space-y-4">
                                <!-- Section 1 -->

                                <div class="flex items-center gap-3 text-gray-300 px-2 py-2 hover:bg-slate-700/30 rounded-lg">
                                    <!-- <i class="fas fa-play-circle text-indigo-400"></i> -->
                                    <span><?php echo htmlspecialchars($cours['content_text']); ?></span>
                                    <!-- <span class="ml-auto text-sm text-gray-400">15:00</span> -->
                                </div>

                                <!-- Add more sections with similar structure -->
                            </div>
                        </div>

                        <!-- <p><?php echo htmlspecialchars($cours['content_text']); ?></p> -->
                    <?php elseif ($_SESSION['type_content'] === 'video') : ?>
                        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">Course Content</h2>
                            <iframe width="640" height="360"
                                src="<?php echo htmlspecialchars($cours['content_video']); ?>"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        <?php endif; ?>
                        </div>


                </div>

                <!-- Course Sidebar -->
                <div class="space-y-6">
                    <!-- Enrollment Card -->
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6 sticky top-24">
                        <div class="text-center mb-6">
                            <span class="text-3xl font-bold text-white">$49.99</span>
                            <span class="text-gray-400 line-through ml-2">$199.99</span>
                        </div>
                        <button class="w-full px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl mb-4 transition-colors">
                            Enroll Now
                        </button>
                        <div class="space-y-4 text-gray-300">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-clock text-indigo-400"></i>
                                <span>12 hours of video content</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-infinity text-indigo-400"></i>
                                <span>Full lifetime access</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-mobile-alt text-indigo-400"></i>
                                <span>Access on mobile and TV</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-certificate text-indigo-400"></i>
                                <span>Certificate of completion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>