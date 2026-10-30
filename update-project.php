<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id'], $_POST['judul'], $_POST['teknologi'])) {

    $id = $_POST['id'];
    $judul = trim($_POST['judul']);
    $teknologi = trim($_POST['teknologi']);

    if (ctype_digit($id) && $judul !== '' && $teknologi !== '') {
        $stmt = $pdo->prepare(
            'UPDATE projects
            SET judul = :judul, teknologi = :teknologi
            WHERE id = :id'
        );
        $stmt->execute([
            'judul' => $judul,
            'teknologi' => $teknologi,
            'id' => $id,
        ]);
    }
}

header('Location: dashboard-project.php');
exit;
