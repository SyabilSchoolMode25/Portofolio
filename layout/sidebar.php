<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 240px;
        background-color: var(--card-bg);
        border-right: 1px solid var(--border-color);
        padding: 24px 16px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        overflow-y: auto;
        z-index: 50;
    }
    .sidebar .sidebar-logo {
        font-weight: 800;
        font-size: 1.3rem;
        padding: 0 12px;
        margin-bottom: 12px;
    }
    .sidebar .sidebar-logo .dot {
        color: var(--accent-color);
    }
    .sidebar .sidebar-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-sub);
        margin-bottom: 8px;
        padding: 0 12px;
    }

    /* Wadah menu: posisi relatif biar indikator biru bisa geser di dalamnya */
    .sidebar-nav {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    /* Kotak biru yang geser ke menu yang dipilih */
    .sidebar-indicator {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        background-color: var(--accent-color);
        border-radius: 8px;
        opacity: 0;
        pointer-events: none;
        z-index: 0;
        transform-origin: left center;
    }

    .sidebar-link {
        position: relative;
        z-index: 1;                 /* di atas indikator */
        display: block;
        text-decoration: none;
        color: var(--text-sub);
        padding: 10px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.2s, color 0.3s, transform 0.2s;
    }
    .sidebar-link:hover {
        background-color: var(--bg-color);
        color: var(--text-main);
        transform: translateX(4px); /* geser dikit pas di-hover */
    }
    .sidebar-link.active {
        background-color: transparent; /* warna biru datang dari indikator */
        color: #000;
        transition-delay: 0.1s;
    }
    .sidebar-link.active:hover {
        background-color: transparent;
        color: #000;
    }

    /* ===== Glitch teleport antar menu ===== */
    /* fase 1: glitch di menu asal, indikator "pecah" lalu hilang */
    .sidebar-indicator.tp-out {
        animation: tpOut 0.42s steps(1, end) forwards;
    }
    .sidebar-link.tp-text-out {
        animation: tpTextOut 0.42s steps(1, end) forwards;
    }
    /* fase 2: indikator muncul glitch di menu tujuan */
    .sidebar-indicator.tp-in {
        animation: tpIn 0.42s steps(1, end) both;
    }
    .sidebar-link.tp-text-in {
        animation: tpTextIn 0.42s steps(1, end) both;
    }
    /* tombol keluar (Back to Portfolio / Logout): glitch di tombolnya sendiri */
    .sidebar-link.tp-text-glitch {
        animation: tpTextGlitch 0.42s steps(1, end) forwards;
    }
    /* konten halaman ikut glitch pas teleport */
    .dashboard-wrapper.tp-content-out {
        animation: tpContentOut 0.42s steps(1, end) forwards;
    }
    .dashboard-wrapper.tp-content-in {
        animation: tpContentIn 0.42s steps(1, end) both;
    }

    @keyframes tpOut {
        0%   { transform: none; clip-path: inset(0); opacity: 1; }
        12%  { transform: translate(-4px, 0) skewX(-8deg); clip-path: inset(0 0 55% 0); }
        24%  { transform: translate(5px, 0) skewX(6deg); clip-path: inset(50% 0 0 0); opacity: 0.7; }
        36%  { transform: translate(-3px, 1px); clip-path: inset(15% 0 40% 0); opacity: 1; }
        50%  { transform: translate(4px, -1px) skewX(-5deg) scaleX(1.04); clip-path: inset(0); opacity: 0.6; }
        64%  { transform: translate(-6px, 0) skewX(7deg); clip-path: inset(35% 0 20% 0); opacity: 1; }
        78%  { transform: translate(6px, 0) scaleX(0.8); clip-path: inset(0 0 60% 0); opacity: 0.5; }
        90%  { transform: translate(-2px, 0) scaleX(0.3); clip-path: inset(40% 0 0 0); opacity: 0.7; }
        100% { transform: scaleX(0); clip-path: inset(0); opacity: 0; }
    }
    @keyframes tpTextOut {
        0%   { color: #000; transform: none; text-shadow: none; }
        12%  { transform: translate(-3px, 0) skewX(-8deg); text-shadow: 3px 0 #00e5ff, -3px 0 #fff; }
        24%  { transform: translate(4px, 0) skewX(6deg); text-shadow: -3px 0 #00e5ff, 3px 0 #fff; }
        36%  { transform: translate(-2px, 1px); text-shadow: 2px 0 #00e5ff; }
        50%  { transform: translate(3px, -1px) skewX(-5deg); text-shadow: -3px 0 #00e5ff, 3px 0 #fff; }
        64%  { color: var(--text-sub); transform: translate(-5px, 0) skewX(7deg); text-shadow: 3px 0 #00e5ff; }
        78%  { transform: translate(5px, 0); text-shadow: -2px 0 #00e5ff; }
        90%  { transform: translate(-2px, 0); text-shadow: 2px 0 #00e5ff; }
        100% { color: var(--text-sub); transform: none; text-shadow: none; }
    }
    @keyframes tpTextGlitch {
        0%   { color: var(--text-main); background-color: var(--bg-color); transform: none; text-shadow: none; }
        12%  { transform: translate(-4px, 0) skewX(-8deg); text-shadow: 3px 0 #00e5ff, -3px 0 #fff; }
        24%  { color: #000; background-color: var(--accent-color); transform: translate(5px, 0) skewX(6deg); text-shadow: none; }
        36%  { color: var(--text-main); background-color: var(--bg-color); transform: translate(-3px, 1px); text-shadow: 2px 0 #00e5ff; }
        50%  { color: #000; background-color: var(--accent-color); transform: translate(4px, -1px) skewX(-5deg); text-shadow: -2px 0 #fff; }
        64%  { color: var(--text-main); background-color: var(--bg-color); transform: translate(-6px, 0) skewX(7deg); text-shadow: 3px 0 #00e5ff, -3px 0 #fff; }
        78%  { color: #000; background-color: var(--accent-color); transform: translate(6px, 0); text-shadow: none; }
        90%  { color: var(--text-main); background-color: var(--bg-color); transform: translate(-2px, 0); text-shadow: 2px 0 #00e5ff; }
        100% { color: var(--text-main); background-color: var(--bg-color); transform: none; text-shadow: none; }
    }
    @keyframes tpIn {
        0%   { opacity: 0; transform: translate(-6px, 0) scaleX(0.3); clip-path: inset(0 0 60% 0); }
        15%  { opacity: 1; transform: translate(6px, 0) skewX(8deg) scaleX(1.05); clip-path: inset(50% 0 0 0); }
        30%  { opacity: 0.4; transform: translate(-4px, 0) skewX(-6deg); clip-path: inset(10% 0 45% 0); }
        45%  { opacity: 1; transform: translate(3px, 1px); clip-path: inset(0); }
        60%  { opacity: 0.6; transform: translate(-3px, 0) skewX(5deg); clip-path: inset(30% 0 20% 0); }
        75%  { opacity: 1; transform: translate(2px, 0); clip-path: inset(0); }
        90%  { opacity: 0.85; transform: translate(-1px, 0); }
        100% { opacity: 1; transform: none; clip-path: inset(0); }
    }
    @keyframes tpTextIn {
        0%   { color: var(--text-main); transform: translate(-4px, 0); text-shadow: 3px 0 #00e5ff, -3px 0 #fff; }
        15%  { transform: translate(5px, 0) skewX(8deg); text-shadow: -3px 0 #00e5ff, 3px 0 #fff; }
        30%  { transform: translate(-3px, 0) skewX(-6deg); text-shadow: 2px 0 #00e5ff; }
        45%  { color: #000; transform: translate(3px, 1px); text-shadow: -2px 0 #00e5ff, 2px 0 #fff; }
        60%  { transform: translate(-3px, 0) skewX(5deg); text-shadow: 2px 0 #00e5ff; }
        75%  { transform: translate(2px, 0); text-shadow: -1px 0 #00e5ff; }
        100% { color: #000; transform: none; text-shadow: none; }
    }
    @keyframes tpContentOut {
        0%   { opacity: 1; transform: none; }
        20%  { opacity: 0.6; transform: translate(-8px, 0) skewX(-1.5deg); }
        40%  { opacity: 0.9; transform: translate(6px, 0); }
        60%  { opacity: 0.35; transform: translate(-4px, 0) skewX(1deg); }
        80%  { opacity: 0.6; transform: translate(3px, 0); }
        100% { opacity: 0.15; transform: none; }
    }
    @keyframes tpContentIn {
        0%   { opacity: 0.2; transform: translate(-6px, 0); }
        25%  { opacity: 0.9; transform: translate(6px, 0) skewX(1deg); }
        50%  { opacity: 0.5; transform: translate(-5px, 0); }
        75%  { opacity: 1; transform: translate(2px, 0); }
        100% { opacity: 1; transform: none; }
    }

    @media (max-width: 768px) {
        .sidebar {
            position: static;
            width: 100%;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
            flex-direction: row;
            overflow-x: auto;
            gap: 8px;
        }
        .sidebar .sidebar-title,
        .sidebar .sidebar-logo {
            display: none;
        }
        .sidebar-nav {
            flex-direction: row;
            gap: 8px;
        }
        .sidebar-link:hover {
            transform: none;
        }
    }
</style>

<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidebar">
    <div class="sidebar-logo">Bil<span class="dot">.</span></div>
    <span class="sidebar-title">Menu</span>

    <nav class="sidebar-nav">
        <span class="sidebar-indicator"></span>
        <a href="/dashboard.php" data-page class="sidebar-link <?php echo $current_page === 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        <a href="/layout/projects.php" data-page class="sidebar-link <?php echo $current_page === 'projects.php' ? 'active' : ''; ?>">Projects</a>
        <a href="/index.html" class="sidebar-link">Back to Portfolio</a>
        <a href="/logout.php" class="sidebar-link">Logout</a>
    </nav>
</aside>

<script>
    // Glitch teleport antar menu sidebar:
    // 1) menu asal glitch  2) indikator "teleport" glitch ke menu tujuan  3) pindah halaman
    (function () {
        var nav = document.querySelector('.sidebar-nav');
        var ind = nav.querySelector('.sidebar-indicator');
        var links = Array.prototype.slice.call(nav.querySelectorAll('.sidebar-link'));
        var active = nav.querySelector('.sidebar-link.active');
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var KEY = 'sidebarTeleport';
        var OUT_MS = 420;   // durasi glitch di menu asal (samain dengan CSS 0.42s)
        var IN_MS  = 420;   // durasi glitch di menu tujuan
        var busy = false;

        function place(el) {
            ind.style.top = el.offsetTop + 'px';
            ind.style.left = el.offsetLeft + 'px';
            ind.style.width = el.offsetWidth + 'px';
            ind.style.height = el.offsetHeight + 'px';
            ind.style.opacity = 1;
        }

        // mulai ulang animasi CSS walau class-nya sama
        function replay(el, cls) {
            el.classList.remove(cls);
            void el.offsetWidth;
            el.classList.add(cls);
        }

        function wrapper() {
            return document.querySelector('.dashboard-wrapper');
        }

        // Halaman baru dibuka: indikator langsung di menu aktif
        if (active) {
            place(active);
            window.addEventListener('load', function () { place(active); });

            // kalau datang dari teleport, mainkan glitch "mendarat"
            if (sessionStorage.getItem(KEY)) {
                sessionStorage.removeItem(KEY);
                replay(ind, 'tp-in');
                replay(active, 'tp-text-in');
                document.addEventListener('DOMContentLoaded', function () {
                    var w = wrapper();
                    if (w) replay(w, 'tp-content-in');
                });
            }
        }

        links.forEach(function (link) {
            link.addEventListener('click', function (e) {
                if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
                e.preventDefault();
                if (busy) return;

                // Back to Portfolio & Logout: glitch di halaman ini aja (tanpa teleport), lalu pindah
                if (!link.hasAttribute('data-page')) {
                    busy = true;
                    if (reduceMotion) {
                        window.location.href = link.href;
                        return;
                    }
                    replay(ind, 'tp-out');
                    if (active) replay(active, 'tp-text-out');
                    replay(link, 'tp-text-glitch');
                    var wx = wrapper();
                    if (wx) replay(wx, 'tp-content-out');
                    setTimeout(function () { window.location.href = link.href; }, OUT_MS);
                    return;
                }

                // klik menu yang lagi aktif: glitch singkat aja, ga pindah halaman
                if (link === active) {
                    if (!reduceMotion) { replay(ind, 'tp-in'); replay(link, 'tp-text-in'); }
                    return;
                }

                busy = true;

                if (reduceMotion) {                              // hormati pengaturan "kurangi animasi"
                    window.location.href = link.href;
                    return;
                }

                // FASE 1: glitch di menu asal (mis. Dashboard)
                replay(ind, 'tp-out');
                replay(active, 'tp-text-out');

                setTimeout(function () {
                    // FASE 2: teleport, indikator hilang dari asal lalu muncul glitch di tujuan
                    ind.classList.remove('tp-out');
                    active.classList.remove('tp-text-out', 'active');
                    link.classList.add('active');
                    place(link);
                    replay(ind, 'tp-in');
                    replay(link, 'tp-text-in');
                    var w = wrapper();
                    if (w) replay(w, 'tp-content-out');

                    sessionStorage.setItem(KEY, '1');

                    // FASE 3: pindah halaman
                    setTimeout(function () { window.location.href = link.href; }, IN_MS);
                }, OUT_MS);
            });
        });

        // Layar di-resize: posisi indikator disesuaikan lagi
        window.addEventListener('resize', function () {
            var cur = nav.querySelector('.sidebar-link.active');
            if (cur) place(cur);
        });

        // Tombol Back browser (halaman dari cache): muat ulang biar state menu bener
        window.addEventListener('pageshow', function (e) {
            if (e.persisted) window.location.reload();
        });
    })();
</script>