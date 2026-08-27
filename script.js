// ===== Theme Toggle =====
const toggleInput = document.getElementById('theme-toggle');
const sliderIcon = document.querySelector('.slider-icon');
const sliderText = document.querySelector('.slider-text');
const currentTheme = localStorage.getItem('theme');

function setThemeUI(isLight) {
    if (sliderIcon) sliderIcon.textContent = isLight ? '☀️' : '🌙';
    if (sliderText) sliderText.textContent = isLight ? 'LIGHT MODE' : 'DARK MODE';
}

if (currentTheme === 'light') {
    document.body.classList.add('light-mode');
    if (toggleInput) toggleInput.checked = true;
    setThemeUI(true);
} else {
    setThemeUI(false);
}

if (toggleInput) {
    toggleInput.addEventListener('change', () => {
        const isLight = toggleInput.checked;
        document.body.classList.toggle('light-mode', isLight);
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
        setThemeUI(isLight);
    });
}

// ===== Hamburger / Mobile Nav Toggle =====
const hamburgerBtn = document.getElementById('hamburger-btn');
const navMenu = document.getElementById('nav-menu');

if (hamburgerBtn && navMenu) {
    hamburgerBtn.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('active');
        hamburgerBtn.classList.toggle('active', isOpen);
        hamburgerBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    navMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            navMenu.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
        }
    });
}

// ===== Typing Effect Bio =====
const typingEl = document.getElementById('typing-text');
const bioTexts = [
    "Back End Developer",
    "Python & JavaScript Enthusiast",
    "Building Anime CRUD Systems"
];

let bioIndex = 0;
let charIndex = 0;
let isDeleting = false;

function typeLoop() {
    if (!typingEl) return;
    const current = bioTexts[bioIndex];

    if (isDeleting) {
        charIndex--;
        typingEl.textContent = current.substring(0, charIndex);
    } else {
        charIndex++;
        typingEl.textContent = current.substring(0, charIndex);
    }

    let speed = isDeleting ? 40 : 80;

    if (!isDeleting && charIndex === current.length) {
        speed = 1500;
        isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        bioIndex = (bioIndex + 1) % bioTexts.length;
        speed = 300;
    }

    setTimeout(typeLoop, speed);
}

typeLoop();

// ===== Milk Shower Easter Egg =====
const milkBadge = document.getElementById('milk-badge');

function spawnMilkShower() {
    const container = document.createElement('div');
    container.className = 'milk-shower-container';
    document.body.appendChild(container);

    const dropCount = 40;
    for (let i = 0; i < dropCount; i++) {
        const drop = document.createElement('span');
        drop.className = 'falling-milk';
        drop.textContent = '🥛';
        drop.style.left = Math.random() * 100 + 'vw';
        drop.style.animationDelay = (Math.random() * 0.5) + 's';
        drop.style.animationDuration = (1.5 + Math.random()) + 's';
        container.appendChild(drop);
    }

    setTimeout(() => {
        container.remove();
    }, 2600);
}

if (milkBadge) {
    milkBadge.addEventListener('click', spawnMilkShower);
}

// ===== Profile Picture Glitch Effect =====
const profileImg = document.querySelector('.profile-pict img');
let glitchTimer = null;

if (profileImg) {
    profileImg.addEventListener('click', () => {
        // Kalau lagi glitch terus diklik lagi, langsung stop
        if (profileImg.classList.contains('glitching')) {
            profileImg.classList.remove('glitching');
            clearTimeout(glitchTimer);
            return;
        }

        // Aktifkan efek glitch
        profileImg.classList.add('glitching');

        // Timer pas 69 detik (69000 ms)
        glitchTimer = setTimeout(() => {
            profileImg.classList.remove('glitching');
        }, 69000);
    });
}