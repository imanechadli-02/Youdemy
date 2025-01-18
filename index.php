<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Course Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        'primary-hover': '#4f46e5',
                        dark: {
                            lighter: '#1f2937',
                            light: '#111827',
                            DEFAULT: '#030712',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-dark text-gray-100">
    <!-- Navbar -->
    <nav class="bg-dark-lighter border-b border-gray-800 fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-8 py-4">
            <div class="flex justify-between items-center md:flex-row flex-col md:gap-0 gap-4">
                <div class="text-2xl font-bold text-primary">EduPro</div>
                <div class="flex gap-4">
                    <button class="px-4 py-2 rounded-lg font-medium border-2 border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300">
                        Se connecter
                    </button>
                    <button class="px-4 py-2 rounded-lg font-medium bg-primary text-white hover:bg-primary-hover transition-all duration-300">
                        S'inscrire
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 mt-28 mb-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Découvrez nos cours en ligne
            </h1>
            <p class="text-lg text-gray-400">
                Apprenez à votre rythme avec nos experts
            </p>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-4">
            <!-- Course Card 1 -->
            <div class="bg-dark-lighter rounded-2xl overflow-hidden shadow-xl hover:-translate-y-1 transition-transform duration-300 border border-gray-800">
                <img src="https://source.unsplash.com/random/800x600?coding" 
                     alt="Course" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="bg-indigo-900/50 text-primary text-sm px-3 py-1 rounded-full inline-block mb-4">
                        Développement Web
                    </span>
                    <h3 class="text-xl font-semibold text-white mb-2">
                        JavaScript Moderne
                    </h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">
                        Maîtrisez JavaScript ES6+ et les dernières fonctionnalités du langage.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-800">
                        <span class="font-semibold text-white">49.99 €</span>
                        <button class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-hover transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-dark-lighter rounded-2xl overflow-hidden shadow-xl hover:-translate-y-1 transition-transform duration-300 border border-gray-800">
                <img src="https://source.unsplash.com/random/800x600?design" 
                     alt="Course" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="bg-indigo-900/50 text-primary text-sm px-3 py-1 rounded-full inline-block mb-4">
                        Design
                    </span>
                    <h3 class="text-xl font-semibold text-white mb-2">
                        UI/UX Design
                    </h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">
                        Créez des interfaces utilisateur modernes et intuitives.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-800">
                        <span class="font-semibold text-white">59.99 €</span>
                        <button class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-hover transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-dark-lighter rounded-2xl overflow-hidden shadow-xl hover:-translate-y-1 transition-transform duration-300 border border-gray-800">
                <img src="https://source.unsplash.com/random/800x600?data" 
                     alt="Course" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="bg-indigo-900/50 text-primary text-sm px-3 py-1 rounded-full inline-block mb-4">
                        Data Science
                    </span>
                    <h3 class="text-xl font-semibold text-white mb-2">
                        Python pour Data Science
                    </h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">
                        Analysez des données avec Python et ses bibliothèques.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-800">
                        <span class="font-semibold text-white">69.99 €</span>
                        <button class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-hover transition-all duration-300">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>