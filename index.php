<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Course Platform</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --background: #f9fafb;
            --card-bg: #ffffff;
            --text: #1f2937;
            --text-light: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background);
        }

        .navbar {
            background: var(--card-bg);
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 7rem auto 2rem;
            padding: 0 1rem;
        }

        .hero {
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .hero p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .course-card {
            background: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-tag {
            background: #e0e7ff;
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .course-title {
            color: var(--text);
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .course-desc {
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .course-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .course-price {
            font-weight: 600;
            color: var(--text);
        }

        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="logo">EduPro</div>
            <div class="nav-buttons">
                <button class="btn btn-outline">Se connecter</button>
                <button class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="hero">
            <h1>Découvrez nos cours en ligne</h1>
            <p>Apprenez à votre rythme avec nos experts</p>
        </div>

        <div class="courses-grid">
            <!-- Course Card 1 -->
            <div class="course-card">
                <img src="https://source.unsplash.com/random/800x600?coding" alt="Course" class="course-image">
                <div class="course-content">
                    <span class="course-tag">Développement Web</span>
                    <h3 class="course-title">JavaScript Moderne</h3>
                    <p class="course-desc">Maîtrisez JavaScript ES6+ et les dernières fonctionnalités du langage.</p>
                    <div class="course-footer">
                        <span class="course-price">49.99 €</span>
                        <button class="btn btn-primary">S'inscrire</button>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card">
                <img src="https://source.unsplash.com/random/800x600?design" alt="Course" class="course-image">
                <div class="course-content">
                    <span class="course-tag">Design</span>
                    <h3 class="course-title">UI/UX Design</h3>
                    <p class="course-desc">Créez des interfaces utilisateur modernes et intuitives.</p>
                    <div class="course-footer">
                        <span class="course-price">59.99 €</span>
                        <button class="btn btn-primary">S'inscrire</button>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card">
                <img src="https://source.unsplash.com/random/800x600?data" alt="Course" class="course-image">
                <div class="course-content">
                    <span class="course-tag">Data Science</span>
                    <h3 class="course-title">Python pour Data Science</h3>
                    <p class="course-desc">Analysez des données avec Python et ses bibliothèques.</p>
                    <div class="course-footer">
                        <span class="course-price">69.99 €</span>
                        <button class="btn btn-primary">S'inscrire</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>