<?php
// 1. Cek login dulu (sama seperti dashboard.php)
require 'layout/session_check.php';
require_once __DIR__ . '/config/database.php';

$error = '';
$judul = '';
$deskripsi = '';

// 2. PHP mengecek: apakah ini request POST?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 3. Ambil data dari $_POST
    $judul     = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($judul === '' || $deskripsi === '') {
        $error = 'Judul dan deskripsi wajib diisi.';
    } else {
        try {
            // siapkan query dengan prepare()
            $stmt = $pdo->prepare(
                'INSERT INTO projects (judul, deskripsi) VALUES (:judul, :deskripsi)'
            );

            // 4. Jalankan execute() untuk INSERT data ke tabel projects
            $stmt->execute([
                ':judul'     => $judul,
                ':deskripsi' => $deskripsi,
            ]);

            // 5. Redirect ke layout/projects.php
            header('Location: layout/projects.php?status=tambah');
            exit;
        } catch (PDOException $e) {
            $error = 'Gagal menyimpan project. Coba lagi.';
            // error_log($e->getMessage());
        }
    }
}

// Header & layout dipanggil SETELAH logic POST (header() harus sebelum ada output HTML)
require 'layout/header.php';
require 'layout/layout.php';
?>

<div class="form-card">
    <span class="badge-tag">CREATE</span>
    <h1>Tambah <span class="name">Project</span></h1>
    <p class="sub">Isi form di bawah, lalu klik Simpan.</p>

    <?php if ($error !== ''): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="tambah-project.php">
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul"
                value="<?= htmlspecialchars($judul) ?>"
                placeholder="Contoh: Personal Portfolio Website" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5"
                    placeholder="Ceritakan singkat tentang project ini..." required><?= htmlspecialchars($deskripsi) ?></textarea>
        </div>

        <div class="form-actions">
            <a href="layout/projects.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<style>
/* ===== Theme tambah-project (ikut tema dashboard) ===== */
.form-card {
    position: relative;
    overflow: hidden;
    max-width: 640px;
    margin: 0 auto;
    background-color: var(--card-bg);
    border: 1px solid var(--border-color);
    border-top: 3px solid var(--accent-color);
    border-radius: 16px;
    padding: 32px;
    animation: fadeUp 0.6s ease both;
}

/* pola titik halus seperti welcome-card */
.form-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(88, 166, 255, 0.10) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
}

.form-card > * { position: relative; }

.form-card .badge-tag {
    display: inline-block;
    font-size: 0.75rem;
    letter-spacing: 0.12em;
    color: var(--accent-color);
    border: 1px solid var(--accent-color);
    padding: 4px 14px;
    border-radius: 999px;
    margin-bottom: 16px;
}

.form-card h1 { font-size: 2rem; margin-bottom: 6px; color: var(--text-main); }
.form-card h1 .name { color: var(--accent-color); }
.form-card .sub { color: var(--text-sub); margin-bottom: 24px; }

.form-group { margin-bottom: 18px; }

.form-group label {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-sub);
    margin-bottom: 6px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 12px 14px;
    font-family: inherit;
    font-size: 1rem;
    color: var(--text-main);
    background-color: var(--bg-color);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    outline: none;
    resize: vertical;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.20);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 24px;
}

.btn {
    display: inline-block;
    padding: 10px 22px;
    border-radius: 999px;
    font-size: 0.95rem;
    font-weight: 700;
    font-family: inherit;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.25s ease, opacity 0.25s ease;
}
.btn:hover { transform: translateY(-2px); }

.btn-primary {
    background-color: var(--accent-color);
    color: #fff;
    border: 1px solid var(--accent-color);
}

.btn-secondary {
    background-color: transparent;
    color: var(--text-main);
    border: 1px solid var(--border-color);
}

.alert-error {
    background-color: rgba(248, 81, 73, 0.12);
    border: 1px solid #f85149;
    color: #f85149;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-size: 0.9rem;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

<?php require 'layout/footer.php'; ?>