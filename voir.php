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
        <!-- ... Navigation content (same as dashboard) ... -->
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-16 h-full w-64 bg-slate-800/50 backdrop-blur-xl border-r border-slate-700/50">
        <!-- ... Sidebar content (same as dashboard) ... -->
    </aside>

    <!-- Main Content -->
    <main class="ml-64 pt-16">
        <div class="p-8">
            <!-- Course Header -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 overflow-hidden mb-8">
                <div class="relative h-80">
                    <img src="https://example.com/course-image.jpg" 
                         alt="Course Banner"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full text-xs bg-indigo-500/20 text-indigo-400">Web Development</span>
                            <span class="px-3 py-1 rounded-full text-xs bg-emerald-500/20 text-emerald-400">Beginner</span>
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2">Modern Web Development Course</h1>
                        <div class="flex items-center gap-6 text-gray-300">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-user-tie text-indigo-400"></i>
                                John Doe
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-star text-amber-400"></i>
                                4.8 (256 reviews)
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
                            Learn modern web development techniques and best practices with this comprehensive course. 
                            Master HTML, CSS, JavaScript, and modern frameworks to build responsive and dynamic websites.
                        </p>
                    </div>

                    <!-- What You'll Learn -->
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                        <h2 class="text-xl font-semibold text-white mb-4">What You'll Learn</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-emerald-400 mt-1"></i>
                                <span class="text-gray-300">Build responsive websites using modern HTML & CSS</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-emerald-400 mt-1"></i>
                                <span class="text-gray-300">Master JavaScript fundamentals and ES6+ features</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-emerald-400 mt-1"></i>
                                <span class="text-gray-300">Work with modern frameworks and libraries</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-emerald-400 mt-1"></i>
                                <span class="text-gray-300">Deploy your applications to production</span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                        <h2 class="text-xl font-semibold text-white mb-4">Course Content</h2>
                        <div class="space-y-4">
                            <!-- Section 1 -->
                            <div class="border border-slate-700/50 rounded-lg overflow-hidden">
                                <button class="w-full px-6 py-4 flex items-center justify-between bg-slate-700/30 hover:bg-slate-700/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-chevron-down text-indigo-400"></i>
                                        <span class="text-white font-medium">1. Introduction to Web Development</span>
                                    </div>
                                    <span class="text-gray-400 text-sm">3 lectures • 45min</span>
                                </button>
                                <div class="p-4 space-y-2">
                                    <div class="flex items-center gap-3 text-gray-300 px-2 py-2 hover:bg-slate-700/30 rounded-lg">
                                        <i class="fas fa-play-circle text-indigo-400"></i>
                                        <span>1.1 Welcome to the Course</span>
                                        <span class="ml-auto text-sm text-gray-400">15:00</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-gray-300 px-2 py-2 hover:bg-slate-700/30 rounded-lg">
                                        <i class="fas fa-play-circle text-indigo-400"></i>
                                        <span>1.2 Setting Up Your Environment</span>
                                        <span class="ml-auto text-sm text-gray-400">20:00</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-gray-300 px-2 py-2 hover:bg-slate-700/30 rounded-lg">
                                        <i class="fas fa-play-circle text-indigo-400"></i>
                                        <span>1.3 Your First Web Page</span>
                                        <span class="ml-auto text-sm text-gray-400">10:00</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Add more sections with similar structure -->
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700/50 p-6">
                        <h2 class="text-xl font-semibold text-white mb-4">Student Reviews</h2>
                        <div class="space-y-6">
                            <!-- Review Item -->
                            <div class="border-b border-slate-700/50 pb-6">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="w-12 h-12 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                        <i class="fas fa-user text-indigo-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-medium">Sarah Johnson</h4>
                                        <div class="flex items-center gap-2 text-sm">
                                            <div class="flex items-center text-amber-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="text-gray-400">2 weeks ago</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-300">
                                    Excellent course! The instructor explains everything clearly and the projects are very practical.
                                </p>
                            </div>
                            <!-- Add more reviews -->
                        </div>
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