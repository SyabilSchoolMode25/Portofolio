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

        /* wrapper buat semua tombol kanan */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap; /* biar rapi kalau di layar sempit turun ke bawah */
        }

        /* class umum buat semua tombol nav */
        .nav-btn {
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: opacity 0.2s;
        }
        .nav-btn:hover {
            opacity: 0.85;
        }

        /* variant: tombol solid/aksen (buat Logout) */
        .nav-btn.primary {
            color: #000;
            background-color: var(--accent-color);
        }

        /* variant: tombol outline/netral (buat Projects, Back to Portfolio) */
        .nav-btn.secondary {
            color: var(--text-main);
            background-color: transparent;
            border: 1px solid var(--border-color);
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="logo">Bil<span class="dot">.</span></div>
        <div class="nav-actions">
            <a href="/layout/projects.php" class="nav-btn secondary">Projects</a>
            <a href="/index.html" class="nav-btn secondary">Back to Portfolio</a>
            <a href="/logout.php" class="nav-btn primary">Logout</a>
        </div>
    </div>
</body>