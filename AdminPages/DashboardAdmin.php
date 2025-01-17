<?php
require_once '../config/config.php';
require_once '../classes/UserClass.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a1a2e;
            --secondary-color: #16213e;
            --accent-color: #4d79ff;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --card-bg: #242442;
            --hover-color: #2d3559;
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--primary-color);
            color: var(--text-primary);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--secondary-color);
            padding: 25px;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 25px;
        }

        .sidebar-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: var(--accent-color);
        }

        .menu-item {
            padding: 15px 20px;
            margin: 8px 0;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-item:hover {
            background-color: var(--hover-color);
            color: var(--text-primary);
            transform: translateX(5px);
        }

        .menu-item i {
            font-size: 1.2em;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            background: var(--primary-color);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-logout {
            padding: 8px 20px;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #3d66cc;
            transform: translateY(-2px);
        }

        /* Stats Container */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .stat-card h3 {
            color: var(--text-secondary);
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2em;
            font-weight: 600;
            color: var(--accent-color);
        }

        /* Recent Activity */
        .recent-activity {
            background: var(--card-bg);
            padding: 30px;
            border-radius: var(--border-radius);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .recent-activity h2 {
            color: var(--text-primary);
            margin-bottom: 25px;
            font-size: 1.5em;
        }

        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
        }

        .activity-table th,
        .activity-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .activity-table th {
            color: var(--text-secondary);
            font-weight: 500;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .activity-table tr:hover {
            background: var(--hover-color);
            transition: var(--transition);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 500;
            display: inline-block;
        }

        .status-active {
            background: rgba(46, 213, 115, 0.15);
            color: #2ed573;
        }

        .status-pending {
            background: rgba(255, 171, 0, 0.15);
            color: #ffab00;
        }

        .status-expired {
            background: rgba(255, 71, 87, 0.15);
            color: #ff4757;
        }

        .username {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .username i {
            color: var(--accent-color);
        }

        /* Actions Column */
        .actions-column {
            display: flex;
            gap: 10px;
            align-items: center;
            min-width: 300px;
        }

        .custom-select {
            position: relative;
            min-width: 150px;
            flex: 1;
        }

        .custom-select select {
            width: 100%;
            padding: 8px 35px 8px 15px;
            border-radius: var(--border-radius);
            background-color: var(--card-bg);
            color: var(--text-primary);
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .custom-select::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent-color);
            pointer-events: none;
        }

        .btn-delete {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: none;
            padding: 8px 16px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: rgba(255, 71, 87, 0.2);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .actions-column {
                flex-direction: column;
                gap: 8px;
                min-width: 200px;
            }

            .custom-select {
                width: 100%;
            }

            .btn-delete {
                width: 100%;
                justify-content: center;
            }

            .activity-table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Youdemy Admin</h2>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item">
                    <i class="fas fa-home"></i> Dashboard
                </div>
                <div class="menu-item">
                    <i class="fas fa-users"></i> Students
                </div>
                <div class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i> Teachers
                </div>
                <div class="menu-item">
                    <i class="fas fa-book"></i> Courses
                </div>
                <div class="menu-item">
                    <i class="fas fa-chart-bar"></i> Reports
                </div>
                <div class="menu-item">
                    <i class="fas fa-cog"></i> Settings
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="dashboard-header">
                <h1>Dashboard Overview</h1>
                <div class="admin-profile">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Students</h3>
                    <p class="stat-number">1,234</p>
                </div>
                <div class="stat-card">
                    <h3>Active Courses</h3>
                    <p class="stat-number">42</p>
                </div>
                <div class="stat-card">
                    <h3>Total Teachers</h3>
                    <p class="stat-number">18</p>
                </div>
                <div class="stat-card">
                    <h3>Revenue</h3>
                    <p class="stat-number">$12,345</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="username">
                                    <i class="fas fa-user"></i>
                                    John Doe
                                </div>
                            </td>
                            <td>Student</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td class="actions-column">
                                <div class="custom-select">
                                    <select name="actions" id="actions">
                                        <option value="" disabled selected>Select Action</option>
                                        <option value="activate" class="action-activate">Activate</option>
                                        <option value="deactivate" class="action-deactivate">Deactivate</option>
                                        <option value="suspend" class="action-suspend">Suspend</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button class="btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menu item click handler
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    console.log('Menu item clicked:', this.textContent.trim());
                });
            });

            // Stat cards hover effect
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseover', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseout', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>