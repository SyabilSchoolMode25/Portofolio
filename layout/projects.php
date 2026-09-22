<?php
require 'session_check.php';

require 'header.php';
?>

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
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dashboard-wrapper {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Section card (sama pola dengan welcome-card di dashboard) */
    .projects-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 32px;
    }
    .projects-card .badge-tag {
        display: inline-block;
        font-size: 0.75rem;
        color: var(--text-sub);
        border: 1px solid var(--border-color);
        padding: 4px 12px;
        border-radius: 999px;
        margin-bottom: 12px;
    }
    .projects-card h1 {
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    /* Project card template: image + title + description */
    .project-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }
    .project-card {
        background-color: var(--bg-color);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .project-card .project-thumb {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
        border-bottom: 1px solid var(--border-color);
    }
    .project-card .project-body {
        padding: 16px;
    }
    .project-card .project-body h4 {
        font-size: 1rem;
        margin-bottom: 8px;
        color: var(--text-main);
    }
    .project-card .project-body p {
        font-size: 0.85rem;
        color: var(--text-sub);
    }
</style>

<div class="dashboard-wrapper">
    <div class="projects-card">
        <span class="badge-tag">PROJECTS</span>
        <h1>My Projects</h1>

        <div class="project-grid">
            <div class="project-card">
                <img src="Images/" alt="Anime Data CRUD Program" class="project-thumb">
                <div class="project-body">
                    <h4>Anime Data CRUD Program</h4>
                    <p>Python-backed CLI/Data System for anime library management created for Gelar Karya.</p>
                </div>
            </div>
            <div class="project-card">
                <img src="Images/" alt="Portfolio Website" class="project-thumb">
                <div class="project-body">
                    <h4>Personal Portfolio Website</h4>
                    <p>Portfolio & dashboard system built with PHP sessions, custom login, and a reusable layout for header/footer.</p>
                </div>
            </div>
            <div class="project-card">
                <img src="Images/" alt=" Project" class="project-thumb">
                <div class="project-body">
                    <h4>Lorem Ipsum</h4>
                    <p>Lorem ipsum dolor sit amet, ganti dengan deskripsi project DoopTech kamu di sini.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
?>