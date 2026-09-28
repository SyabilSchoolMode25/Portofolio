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
        flex: 1;                    /* ngisi tinggi sidebar, biar tombol bawah nempel di dasar */
    }

    /* Garis pemisah: menu halaman di atas, tombol keluar di bawah */
    .sidebar-divider {
        height: 1px;
        background-color: var(--border-color);
        margin: auto 4px 8px;       /* margin-top:auto = dorong ke bawah */
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
        transition: background-color 0.2s, color 0.3s, transform 0.2s, border-color 0.2s;

        /* warna dipakai animasi glitch (tiap tombol bisa punya warna sendiri) */
        --gl-text: var(--text-main);
        --gl-bg: var(--bg-color);
        --gl-flash: var(--accent-color);
        --gl-flash-text: #000;
        --gl-sh: #00e5ff;
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

    /* ===== Tombol khusus: Back to Portfolio (biru outline) & Logout (merah) ===== */
    .sidebar-link.link-portfolio,
    .sidebar-link.link-logout {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid transparent;
    }
    .sidebar-link .link-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: transform 0.25s ease;
    }

    .sidebar-link.link-portfolio {
        --gl-text: var(--accent-color);
        --gl-bg: rgba(88, 166, 255, 0.08);
        --gl-flash: var(--accent-color);
        --gl-flash-text: #000;
        --gl-sh: #00e5ff;
        color: var(--accent-color);
        background-color: rgba(88, 166, 255, 0.08);
        border-color: rgba(88, 166, 255, 0.35);
    }
    .sidebar-link.link-portfolio:hover {
        color: var(--accent-color);
        background-color: rgba(88, 166, 255, 0.18);
        border-color: var(--accent-color);
        transform: none;
    }
    .sidebar-link.link-portfolio:hover .link-icon {
        transform: translateX(-4px);   /* panah kiri geser pas di-hover */
    }

    .sidebar-link.link-logout {
        --gl-text: #ff7b72;
        --gl-bg: rgba(248, 81, 73, 0.10);
        --gl-flash: #f85149;
        --gl-flash-text: #fff;
        --gl-sh: #ff7b72;
        color: #ff7b72;
        background-color: rgba(248, 81, 73, 0.10);
        border-color: rgba(248, 81, 73, 0.35);
    }
    .sidebar-link.link-logout:hover {
        color: #fff;
        background-color: #f85149;
        border-color: #f85149;
        transform: none;
    }
    .sidebar-link.link-logout:hover .link-icon {
        transform: translateX(4px);    /* panah keluar geser pas di-hover */
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
        0%   { color: var(--gl-text); background-color: var(--gl-bg); transform: none; text-shadow: none; }
        12%  { transform: translate(-4px, 0) skewX(-8deg); text-shadow: 3px 0 var(--gl-sh), -3px 0 #fff; }
        24%  { color: var(--gl-flash-text); background-color: var(--gl-flash); transform: translate(5px, 0) skewX(6deg); text-shadow: none; }
        36%  { color: var(--gl-text); background-color: var(--gl-bg); transform: translate(-3px, 1px); text-shadow: 2px 0 var(--gl-sh); }
        50%  { color: var(--gl-flash-text); background-color: var(--gl-flash); transform: translate(4px, -1px) skewX(-5deg); text-shadow: -2px 0 #fff; }
        64%  { color: var(--gl-text); background-color: var(--gl-bg); transform: translate(-6px, 0) skewX(7deg); text-shadow: 3px 0 var(--gl-sh), -3px 0 #fff; }
        78%  { color: var(--gl-flash-text); background-color: var(--gl-flash); transform: translate(6px, 0); text-shadow: none; }
        90%  { color: var(--gl-text); background-color: var(--gl-bg); transform: translate(-2px, 0); text-shadow: 2px 0 var(--gl-sh); }
        100% { color: var(--gl-text); background-color: var(--gl-bg); transform: none; text-shadow: none; }
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

    /* Elemen khusus mobile: disembunyiin di desktop */
    .mobile-topbar,
    .sidebar-overlay {
        display: none;
    }

    /* ===== Mode HP: sidebar jadi drawer geser dari kiri + tombol hamburger ===== */
    @media (max-width: 768px) {
        /* bar atas: logo + tombol hamburger */
        .mobile-topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            padding: 0 16px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
        }
        .mobile-logo {
            font-weight: 800;
            font-size: 1.3rem;
        }
        .mobile-logo .dot {
            color: var(--accent-color);
        }
        .menu-toggle {
            width: 42px;
            height: 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            background-color: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .menu-toggle:hover,
        .menu-toggle.open {
            border-color: var(--accent-color);
        }
        .menu-toggle span {
            display: block;
            width: 18px;
            height: 2px;
            border-radius: 2px;
            background-color: var(--text-main);
            transition: transform 0.3s ease, opacity 0.2s ease;
        }
        /* hamburger berubah jadi tanda X pas menu kebuka */
        .menu-toggle.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .menu-toggle.open span:nth-child(2) { opacity: 0; }
        .menu-toggle.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* sidebar = drawer yang nyembunyi di kiri layar */
        .sidebar {
            width: min(280px, 82vw);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 60;
            box-shadow: none;
        }
        .sidebar.open {
            transform: translateX(0);
            box-shadow: 8px 0 32px rgba(0, 0, 0, 0.5);
        }

        /* layar gelap di belakang drawer, klik = nutup menu */
        .sidebar-overlay {
            display: block;
            position: fixed;
            inset: 0;
            z-index: 55;
            background-color: rgba(0, 0, 0, 0.65);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
        body.menu-open {
            overflow: hidden;   /* halaman ga ikut ke-scroll pas menu kebuka */
        }

        .sidebar-link {
            white-space: nowrap;
            padding: 12px;
        }
        .sidebar-link:hover {
            transform: none;
        }
    }
</style>

<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="mobile-topbar">
    <div class="mobile-logo">Bil<span class="dot">.</span></div>
    <button type="button" class="menu-toggle" id="menuToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <span></span><span></span><span></span>
    </button>
</header>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">Bil<span class="dot">.</span></div>
    <span class="sidebar-title">Menu</span>

    <nav class="sidebar-nav">
        <span class="sidebar-indicator"></span>
        <a href="/dashboard.php" data-page class="sidebar-link <?php echo $current_page === 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        <a href="/layout/projects.php" data-page class="sidebar-link <?php echo $current_page === 'projects.php' ? 'active' : ''; ?>">Projects</a>
        <div class="sidebar-divider"></div>
        <a href="/index.html" class="sidebar-link link-portfolio">
            <svg class="link-icon" viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Portfolio
        </a>
        <a href="/logout.php" class="sidebar-link link-logout">
            <svg class="link-icon" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Logout
        </a>
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

        // ----- Drawer menu (mode HP) -----
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        var toggleBtn = document.getElementById('menuToggle');

        function setMenu(open) {
            sidebar.classList.toggle('open', open);
            overlay.classList.toggle('show', open);
            toggleBtn.classList.toggle('open', open);
            toggleBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggleBtn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
            document.body.classList.toggle('menu-open', open);
        }
        toggleBtn.addEventListener('click', function () {
            setMenu(!sidebar.classList.contains('open'));
        });
        overlay.addEventListener('click', function () { setMenu(false); });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') setMenu(false);
        });
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) setMenu(false);
        });

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
                    setTimeout(function () { setMenu(false); }, reduceMotion ? 0 : IN_MS);
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