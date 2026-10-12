<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query('SELECT * FROM projects ORDER BY dibuat_pada DESC');
$projects = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Project</title>
</head>
<body>
    <h1>Daftar Project</h1>

    <?php if (count($projects) === 0): ?>
        <p>Belum ada project.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
            </tr>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= htmlspecialchars($project['judul']) ?></td>
                    <td><?= htmlspecialchars($project['deskripsi']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>