<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        form {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 40px 35px;
            border-radius: 16px;
            width: 320px;
        }
        form h2 {
            text-align: center;
            margin-bottom: 24px;
            color: var(--text-main);
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.85rem;
            color: var(--text-sub);
        }
        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            background-color: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-main);
            font-size: 14px;
            outline: none;
        }
        input:focus {
            border-color: var(--accent-color);
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: var(--accent-color);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <form action="logiclogin.php" method="post">
        <h2>Login</h2>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>