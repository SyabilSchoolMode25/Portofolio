<?php
require 'session_check.php';

require 'header.php';
require 'layout.php';

/* Daftar project. Mau nambah project? Tinggal tambah 1 baris array di sini. */
$projects = [
    [
        'image' => '../Images/crud.jpeg',
        'title' => 'Anime Data CRUD Program',
        'desc'  => 'Python-backed CLI/Data System for anime library management created for Gelar Karya.',
    ],
    [
        'image' => '../Images/portofolio.png',
        'title' => 'Personal Portfolio Website',
        'desc'  => 'Portfolio & dashboard system built with PHP sessions, custom login, and a reusable layout for header/footer.',
    ],
    [
        'image' => '../Images/scratch.png',
        'title' => 'Scratch Game',
        'desc'  => 'A game created for a promotional event by SMP 22 Samarinda at SMK TI Airlangga',
    ],
];
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
    /* pola titik halus di background (sama kayak dashboard) */
    .projects-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(88, 166, 255, 0.10) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
    }
    .projects-card > * {
        position: relative; /* biar di atas pola background */
    }

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
    .projects-card h1 {
        font-size: 2.6rem;
        margin-bottom: 6px;
    }
    .projects-card h1 span {
        color: var(--accent-color);
    }
    .projects-card .subtitle {
        color: var(--text-sub);
        font-size: 1.05rem;
    }
    .projects-card .count-pill {
        font-size: 0.9rem;
        font-weight: 700;
        padding: 8px 18px;
        border: 1px solid var(--border-color);
        border-radius: 999px;
        background-color: var(--bg-color);
        white-space: nowrap;
    }
    .projects-card .count-pill b {
        color: var(--accent-color);
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
    .project-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent-color);
    }

    /* area gambar: ikut memanjang, ada nomor urut di pojok */
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
    .project-card:hover .project-media img {
        transform: scale(1.05);
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

    .project-body {
        padding: 18px;
    }
    .project-body h4 {
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: var(--text-main);
    }
    .project-body p {
        font-size: 0.88rem;
        color: var(--text-sub);
    }

/* ===== Animasi ===== */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="projects-card">
    <div class="projects-head">
        <div>
            <span class="badge-tag">PROJECTS</span>
            <h1>My <span>Projects</span></h1>
            <p class="subtitle">Kumpulan project yang pernah aku kerjain.</p>
        </div>
        <div class="count-pill"><b><?php echo count($projects); ?></b> Projects</div>
    </div>

    <div class="project-grid">
        <?php foreach ($projects as $i => $project): ?>
            <div class="project-card" style="--i: <?php echo $i; ?>">
                <div class="project-media">
                    <span class="project-index"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                    <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                </div>
                <div class="project-body">
                    <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                    <p><?php echo htmlspecialchars($project['desc']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require 'footer.php';
?>