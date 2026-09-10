<?php
$username = $_POST['username'];
$password = $_POST['password'];

if ($username === "syabil" && $password === "syabil6910") {
    $status = "success";
    $message = "Login berhasil, selamat datang $username!";
} else {
    $status = "error";
    $message = "Username atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Result</title>
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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            max-width: 350px;
        }
        .box p { color: var(--text-sub); margin-top: 8px; }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #000;
            background-color: var(--accent-color);
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2 style="color: <?php echo $status === 'success' ? '#2ea44f' : '#f85149'; ?>;">
            <?php echo $status === 'success' ? 'Berhasil!' : 'Gagal!'; ?>
        </h2>
        <p><?php echo $message; ?></p>
        <a href="index.html">Back</a>
    </div>
</body>
</html>