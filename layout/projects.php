<?php
require 'session_check.php';
require_once __DIR__ . '/../config/database.php';

require 'header.php';
require 'layout.php';

/* Gambar untuk project lama (berdasarkan id). Project baru pakai placeholder. */
$images = [
    1 => '../Images/crud.jpeg',
    2 => '../Images/portofolio.png',
    3 => '../Images/scratch.png',
];

/* Semua project diambil dari database, yang baru otomatis di bawah */
$projects = [];
$dbError  = null;

try {
    $stmt = $pdo->query('SELECT id, judul, deskripsi FROM projects ORDER BY id ASC');
    foreach ($stmt->fetchAll() as $row) {
        $projects[] = [
            'id'    => $row['id'],
            'image' => $images[$row['id']] ?? null,
            'title' => $row['judul'],
            'desc'  => $row['deskripsi'],
        ];
    }
} catch (PDOException $e) {
    $dbError = $e->getMessage();
}
?>

<style>
/* ===== Kartu utama ===== */
    .projects-card {
        position: relative;
        overflow: hidden;
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-top: 3px solid var(--accent-color);
        border-radius: 16px;
        padding: 32px;
        display: flex;
        flex-direction: column;
        animation: fadeUp 0.6s ease both;
    }
    .projects-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(88, 166, 255, 0.10) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
    }
    .projects-card > * { position: relative; }

/* ===== Header ===== */
    .projects-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }
    .projects-card .badge-tag {
        display: inline-block;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
        padding: 4px 14px;
        border-radius: 999px;
        margin-bottom: 14px;
    }
    .projects-card h1 { font-size: 2.6rem; margin-bottom: 6px; }
    .projects-card h1 span { color: var(--accent-color); }
    .projects-card .subtitle { color: var(--text-sub); font-size: 1.05rem; }
    .head-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .projects-card .count-pill {
        font-size: 0.9rem;
        font-weight: 700;
        padding: 8px 18px;
        border: 1px solid var(--border-color);
        border-radius: 999px;
        background-color: var(--bg-color);
        white-space: nowrap;
    }
    .projects-card .count-pill b { color: var(--accent-color); }

    /* tombol tambah project */
    .btn-add {
        display: inline-block;
        padding: 9px 20px;
        border-radius: 999px;
        background-color: var(--accent-color);
        color: #fff;
        font-size: 0.9rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: transform 0.25s ease;
    }
    .btn-add:hover { transform: translateY(-2px); }

    .alert-success {
        background-color: rgba(46, 164, 79, 0.12);
        border: 1px solid #2ea44f;
        color: #2ea44f;
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

/* ===== Grid & card project ===== */
    .project-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        grid-auto-rows: 1fr;
        gap: 20px;
        flex: 1;
    }
    .project-card {
        background-color: var(--bg-color);
        border: 1px solid var(--border-color);
        border-bottom: 3px solid var(--accent-color);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, border-color 0.25s ease;
        animation: fadeUp 0.6s ease both;
        animation-delay: calc(var(--i) * 0.1s + 0.15s);
    }
    .project-card:hover { transform: translateY(-4px); border-color: var(--accent-color); }

    .project-media {
        position: relative;
        flex: 1;
        min-height: 160px;
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        overflow: hidden;
    }
    .project-media img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .project-card:hover .project-media img { transform: scale(1.05); }

    /* placeholder untuk project dari database (belum ada gambar) */
    .project-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--accent-color);
        background-image: radial-gradient(rgba(88, 166, 255, 0.18) 1px, transparent 1px);
        background-size: 18px 18px;
    }

    .project-index {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 1;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        color: var(--accent-color);
        background-color: var(--bg-color);
        border: 1px solid var(--accent-color);
        padding: 3px 10px;
        border-radius: 999px;
    }

    .project-body { padding: 18px; }
    .project-body h4 { font-size: 1.1rem; margin-bottom: 8px; color: var(--text-main); }
    .project-body p { font-size: 0.88rem; color: var(--text-sub); }

/* ===== Animasi ===== */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

.btn-delete {
    margin-top: 14px;
    padding: 7px 18px;
    border-radius: 999px;
    border: 1px solid #f85149;
    background: transparent;
    color: #f85149;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.25s ease, color 0.25s ease;
}
.btn-delete:hover { background: #f85149; color: #fff; }
.alert-error {
    background-color: rgba(248, 81, 73, 0.12);
    border: 1px solid #f85149;
    color: #f85149;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
}
</style>

<div class="projects-card">
    <div class="projects-head">
        <div>
            <span class="badge-tag">PROJECTS</span>
            <h1>My <span>Projects</span></h1>
            <p class="subtitle">Kumpulan project yang pernah aku kerjain.</p>
        </div>
        <div class="head-actions">
            <div class="count-pill"><b><?php echo count($projects); ?></b> Projects</div>
            <a href="../tambah-project.php" class="btn-add">+ Tambah Project</a>
        </div>
    </div>

    <?php if ($dbError): ?>
        <div class="alert-error">Error database: <?php echo htmlspecialchars($dbError); ?></div>
    <?php endif; ?>
    <?php if (($_GET['status'] ?? '') === 'tambah'): ?>
        <div class="alert-success">Project berhasil ditambahkan.</div>
    <?php elseif (($_GET['status'] ?? '') === 'hapus'): ?>
        <div class="alert-success">Project berhasil dihapus.</div>
    <?php endif; ?>

    <div class="project-grid">
        <?php foreach ($projects as $i => $project): ?>
            <div class="project-card" style="--i: <?php echo $i; ?>">
                <div class="project-media">
                    <span class="project-index"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                    <?php if (!empty($project['image'])): ?>
                        <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <?php else: ?>
                        <div class="project-placeholder"><?php echo htmlspecialchars(mb_strtoupper(mb_substr($project['title'], 0, 1))); ?></div>
                    <?php endif; ?>
                </div>
                <div class="project-body">
                    <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                    <p><?php echo htmlspecialchars($project['desc']); ?></p>

                    <?php if (!empty($project['id'])): ?>
                        <form method="POST" action="../hapus-project.php"
                            onsubmit="return confirm('Hapus project ini?');">
                            <input type="hidden" name="id" value="<?php echo (int)$project['id']; ?>">
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require 'footer.php';
?>