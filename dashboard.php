<?php
require 'layout/session_check.php';

require 'layout/header.php';
require 'layout/layout.php';
?>

<style>
/* ===== Welcome card ===== */
    .welcome-card {
        position: relative;
        overflow: hidden;
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-top: 3px solid var(--accent-color);
        border-radius: 16px;
        padding: 32px;
        flex: 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        animation: fadeUp 0.6s ease both;
    }
    /* pola titik halus di background */
    .welcome-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(88, 166, 255, 0.10) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
    }
    .welcome-card > * {
        position: relative; /* biar di atas pola background */
    }
    .welcome-card .badge-tag {
        display: inline-block;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
        padding: 4px 14px;
        border-radius: 999px;
        margin-bottom: 16px;
    }
    .welcome-card .greeting {
        font-size: 1rem;
        color: var(--text-sub);
        margin-bottom: 4px;
    }
    .welcome-card h1 {
        font-size: 2.6rem;
        margin-bottom: 10px;
    }
    .welcome-card h1 span.name {
        color: var(--accent-color);
    }
    .welcome-card p {
        color: var(--text-sub);
        font-size: 1.1rem;
    }
    .welcome-card .role-pill {
        color: var(--text-main);
        font-weight: 700;
    }
    .welcome-card .clock {
        margin-top: 20px;
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        font-variant-numeric: tabular-nums;
        padding: 8px 20px;
        border: 1px solid var(--border-color);
        border-radius: 999px;
        background-color: var(--bg-color);
    }
    .welcome-card .date {
        margin-top: 8px;
        font-size: 0.85rem;
        color: var(--text-sub);
    }

/* ===== Info grid ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-auto-rows: 1fr;
        gap: 16px;
        flex: 1;
    }
    .info-item {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-bottom: 3px solid var(--accent-color);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        gap: 6px;
        transition: transform 0.25s ease, border-color 0.25s ease;
        animation: fadeUp 0.6s ease both;
    }
    .info-item:nth-child(1) { animation-delay: 0.1s; }
    .info-item:nth-child(2) { animation-delay: 0.2s; }
    .info-item:nth-child(3) { animation-delay: 0.3s; }
    .info-item:hover {
        transform: translateY(-4px);
        border-color: var(--accent-color);
    }
    .info-item .icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: var(--bg-color);
        border: 1px solid var(--border-color);
        color: var(--accent-color);
        margin-bottom: 6px;
    }
    .info-item .icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .info-item .label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-sub);
    }
    .info-item .value {
        font-size: 1.6rem;
        font-weight: 700;
    }

/* ===== Status dot berdenyut ===== */
    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #2ea44f;
        margin-right: 6px;
        animation: pulse 2s infinite;
    }
    .value .status-dot {
        width: 10px;
        height: 10px;
        margin-right: 8px;
    }

/* ===== Animasi ===== */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%   { box-shadow: 0 0 0 0 rgba(46, 164, 79, 0.6); }
        70%  { box-shadow: 0 0 0 8px rgba(46, 164, 79, 0); }
        100% { box-shadow: 0 0 0 0 rgba(46, 164, 79, 0); }
    }
</style>

<div class="welcome-card">
    <span class="badge-tag">DASHBOARD</span>
    <div class="greeting" id="greeting">Welcome back</div>
    <h1>Hi, <span class="name"><?php echo htmlspecialchars($_SESSION['username']); ?></span></h1>
    <p><span class="status-dot"></span>You are currently logged in as <span class="role-pill"><?php echo htmlspecialchars($_SESSION['role'] ?? 'user'); ?></span></p>
    <div class="clock" id="clock">--:--:--</div>
    <div class="date" id="date"></div>
</div>

<div class="info-grid">
    <div class="info-item">
        <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <span class="label">Username</span>
        <span class="value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <div class="info-item">
        <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <span class="label">Role</span>
        <span class="value"><?php echo htmlspecialchars($_SESSION['role'] ?? '-'); ?></span>
    </div>
    <div class="info-item">
        <div class="icon">
            <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <span class="label">Status</span>
        <span class="value"><span class="status-dot"></span>Online</span>
    </div>
</div>

<script>
    // Jam & tanggal live + sapaan sesuai waktu
    function updateClock() {
        var now = new Date();
        var h = now.getHours();
        var greet = h < 11 ? 'Good morning' : h < 15 ? 'Good afternoon' : h < 19 ? 'Good evening' : 'Good night';
        document.getElementById('greeting').textContent = greet;
        document.getElementById('clock').textContent = now.toLocaleTimeString('en-GB');
        document.getElementById('date').textContent = now.toLocaleDateString('id-ID', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>

<?php
require 'layout/footer.php';
?>