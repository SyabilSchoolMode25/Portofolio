<style>
    /* Sidebar nempel penuh di kiri, konten di tengah area sisanya */
    body {
        display: block;
        padding: 0;
    }
    .page-layout {
        min-height: 100vh;
    }
    .page-layout .dashboard-wrapper {
        margin-left: 240px;          /* sama dengan lebar sidebar */
        min-height: 100vh;
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    /* isi halaman full lebar (tanpa batas max-width) */
    .page-layout .dashboard-wrapper > * {
        width: 100%;
    }
    /* card utama ngisi sisa tinggi layar */
    .page-layout .dashboard-wrapper > .projects-card {
        flex: 1;
    }
    /* footer selalu di bawah */
    .page-layout .dashboard-wrapper > footer {
        margin-top: auto;
    }
    @media (max-width: 768px) {
        .page-layout .dashboard-wrapper {
            margin-left: 0;
            padding: 16px;
        }
    }
</style>

<div class="page-layout">
    <?php require __DIR__ . '/sidebar.php'; ?>

    <div class="dashboard-wrapper">