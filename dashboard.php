<?php
require 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0d0f12;
            --card-bg: #161b22;
            --accent-color: #58a6ff;
            --text-main: #f0f6fc;
            --text-sub: #8b949e;
            --border-color: #30363d;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding: 24px;
        }
        .dash-container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Top bar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px 24px;
        }
        .topbar .logo {
            font-weight: 800;
            font-size: 1.3rem;
        }
        .topbar .logo .dot {
            color: var(--accent-color);
        }
        .logout-btn {
            color: #000;
            background-color: var(--accent-color);
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .logout-btn:hover {
            opacity: 0.9;
        }

        /* Welcome card */
        .welcome-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 32px;
        }
        .welcome-card .badge-tag {
            display: inline-block;
            font-size: 0.75rem;
            color: var(--text-sub);
            border: 1px solid var(--border-color);
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 12px;
        }
        .welcome-card h1 {
            font-size: 1.8rem;
            margin-bottom: 6px;
        }
        .welcome-card h1 span {
            color: var(--accent-color);
        }
        .welcome-card p {
            color: var(--text-sub);
            font-size: 0.95rem;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .info-item {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
        }
        .info-item .label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-sub);
            margin-bottom: 8px;
        }
        .info-item .value {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #2ea44f;
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div class="dash-container">
        <div class="topbar">
            <div class="logo">Bil<span class="dot">.</span></div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="welcome-card">
            <span class="badge-tag">DASHBOARD</span>
            <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['username']); ?></span> 👋</h1>
            <p><span class="status-dot"></span>You are currently logged in as <?php echo htmlspecialchars($_SESSION['role'] ?? 'user'); ?></p>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <span class="label">Username</span>
                <span class="value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Role</span>
                <span class="value"><?php echo htmlspecialchars($_SESSION['role'] ?? '-'); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Status</span>
                <span class="value">Online</span>
            </div>
        </div>
    </div>
</body>
</html>