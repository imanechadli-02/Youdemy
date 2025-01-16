<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #6366f1;
            --accent: #818cf8;
            --background: #0f172a;
            --surface: #1e293b;
            --surface-light: #334155;
            --text: #f8fafc;
            --text-secondary: #94a3b8;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        .navbar {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--accent), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-login:hover {
            background: var(--accent);
            color: var(--background);
        }

        .btn-signup {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .hero-section {
            padding: 8rem 2rem 4rem;
            text-align: center;
            background: linear-gradient(to bottom, var(--background), var(--surface));
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--accent), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
        }

        .courses-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .course-card {
            background: var(--surface);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            border-color: var(--accent);
        }

        .course-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card:hover .course-image img {
            transform: scale(1.1);
        }

        .course-level {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(15, 23, 42, 0.9);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            color: var(--accent);
            backdrop-filter: blur(4px);
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-category {
            color: var(--accent);
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .course-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text);
            line-height: 1.4;
        }

        .course-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .course-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--success);
        }

        .enroll-btn {
            padding: 0.5rem 1rem;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .enroll-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .nav-content {
                flex-direction: column;
                gap: 1rem;
            }

            .section-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        .nav-buttons a {
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="logo">Youdemy</div>
            <div class="nav-buttons">
                <a href="signIn.php" class="btn btn-login">Sign In</a>
                <a href="signUp.php" class="btn btn-signup">Sign Up</a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Unlock Your Potential with Youdemy</h1>
            <p class="hero-subtitle">Join millions of learners worldwide and explore top-quality courses taught by industry experts</p>
        </div>
    </section>

    <section class="courses-section">
        <div class="section-header">
            <h2 class="section-title">Featured Courses</h2>
        </div>

        <div class="courses-grid">
            <!-- Course 1 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="https://source.unsplash.com/random/800x600?coding" alt="Web Development">
                    <span class="course-level">Advanced</span>
                </div>
                <div class="course-content">
                    <div class="course-category">
                        <i class="fas fa-code"></i>
                        Web Development
                    </div>
                    <h3 class="course-title">Modern JavaScript: From Zero to Expert</h3>
                    <div class="course-stats">
                        <span><i class="fas fa-star"></i> 4.8</span>
                        <span><i class="fas fa-users"></i> 12,234 students</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-price">€59.99</div>
                        <button class="enroll-btn">Enroll Now</button>
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="https://source.unsplash.com/random/800x600?design" alt="UI/UX Design">
                    <span class="course-level">Intermediate</span>
                </div>
                <div class="course-content">
                    <div class="course-category">
                        <i class="fas fa-palette"></i>
                        UI/UX Design
                    </div>
                    <h3 class="course-title">Complete UI/UX Design Masterclass</h3>
                    <div class="course-stats">
                        <span><i class="fas fa-star"></i> 4.9</span>
                        <span><i class="fas fa-users"></i> 8,456 students</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-price">€49.99</div>
                        <button class="enroll-btn">Enroll Now</button>
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="https://source.unsplash.com/random/800x600?data" alt="Data Science">
                    <span class="course-level">Expert</span>
                </div>
                <div class="course-content">
                    <div class="course-category">
                        <i class="fas fa-database"></i>
                        Data Science
                    </div>
                    <h3 class="course-title">Data Science and Machine Learning</h3>
                    <div class="course-stats">
                        <span><i class="fas fa-star"></i> 4.7</span>
                        <span><i class="fas fa-users"></i> 15,789 students</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-price">€69.99</div>
                        <button class="enroll-btn">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html> 