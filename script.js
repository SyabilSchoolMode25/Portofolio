const toggleInput = document.getElementById('theme-toggle');
const sliderIcon = document.querySelector('.slider-icon');
const sliderText = document.querySelector('.slider-text');
const currentTheme = localStorage.getItem('theme');

// Cek tema yang tersimpan
if (currentTheme === 'light') {
    document.body.classList.add('light-mode');
    if (toggleInput) toggleInput.checked = true;
    if (sliderIcon) sliderIcon.textContent = '☀️';
    if (sliderText) sliderText.textContent = 'LIGHT MODE';
}

if (toggleInput) {
    toggleInput.addEventListener('change', () => {
        if (toggleInput.checked) {
            document.body.classList.add('light-mode');
            sliderIcon.textContent = '☀️';
            sliderText.textContent = 'LIGHT MODE';
            localStorage.setItem('theme', 'light');
        } else {
            document.body.classList.remove('light-mode');
            sliderIcon.textContent = '🌙';
            sliderText.textContent = 'DARK MODE';
            localStorage.setItem('theme', 'dark');
        }
    });
}

// Intersection Observer buat Efek Scroll Reveal
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.portfolio-container > *').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(25px)';
    el.style.transition = 'all 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
    observer.observe(el);
});

const text = '"When Great Power, Comes Great Responsibility"';
let index = 0;
const speed = 50;

function typeWriter() {
    if (index < text.length) {
        document.getElementById("typing-text").innerHTML += text.charAt(index);
        index++;
        setTimeout(typeWriter, speed);
    }
}

// Simulasi Live API Latency
function updateApiStatus() {
    const latencies = ['latency-1', 'latency-2', 'latency-3'];
    
    latencies.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            // Generates random ping 18ms - 45ms
            const randomPing = Math.floor(Math.random() * (45 - 18 + 1)) + 18;
            el.textContent = `${randomPing} ms`;
        }
    });

    const lastUpdated = document.getElementById('last-updated');
    if (lastUpdated) {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        lastUpdated.textContent = `Last checked: ${timeString}`;
    }
}

// Run pas di-load dan update acak tiap 5 detik
window.addEventListener('DOMContentLoaded', () => {
    updateApiStatus();
    setInterval(updateApiStatus, 5000);
});

// Easter Egg: Hujan Emoji Susu
const milkBadge = document.getElementById('milk-badge');

if (milkBadge) {
    milkBadge.addEventListener('click', () => {
        // Bikin container khusus efek hujan
        const container = document.createElement('div');
        container.className = 'milk-shower-container';
        document.body.appendChild(container);

        // Spawn 30 emoji susu secara acak
        for (let i = 0; i < 30; i++) {
            const milk = document.createElement('div');
            milk.className = 'falling-milk';
            milk.textContent = '🥛';
            
            // Posisi horizontal acak & delay beda-beda
            milk.style.left = Math.random() * 100 + 'vw';
            milk.style.animationDelay = Math.random() * 0.8 + 's';
            milk.style.fontSize = (Math.random() * 1.5 + 1.5) + 'rem';
            
            container.appendChild(milk);
        }

        // Hapus container otomatis setelah animasi selesai (2.8 detik)
        setTimeout(() => {
            container.remove();
        }, 2800);
    });
}

// Konami Code Easter Egg
const konamiCode = [
    'ArrowUp', 'ArrowUp', 
    'ArrowDown', 'ArrowDown', 
    'ArrowLeft', 'ArrowRight', 
    'ArrowLeft', 'ArrowRight', 
    'b', 'a'
];

let konamiIndex = 0;

// Bikin elemen toast pop-up retro secara otomatis
const matrixToast = document.createElement('div');
matrixToast.className = 'matrix-toast';
matrixToast.innerHTML = `
    <h3>CHEAT CODE ACTIVATED!</h3>
    <p>> Retro Matrix Mode Enabled</p>
    <p style="font-size: 0.75rem; margin-top: 8px; color: #00ff66;">Tekan 'ESC' buat keluar</p>
`;
document.body.appendChild(matrixToast);

// Event Listener Keyboard
document.addEventListener('keydown', (e) => {
    // Tombol ESC buat matikan mode matrix
    if (e.key === 'Escape' && document.body.classList.contains('matrix-mode')) {
        document.body.classList.remove('matrix-mode');
        return;
    }

    // Cek urutan tombol Konami
    const key = e.key.length === 1 ? e.key.toLowerCase() : e.key;
    const requiredKey = konamiCode[konamiIndex];

    if (key === requiredKey) {
        konamiIndex++;
        
        // Kalau urutan tombol berhasil lengkap diketik
        if (konamiIndex === konamiCode.length) {
            document.body.classList.toggle('matrix-mode');
            
            // Tampilkan pop-up toast sebentar
            matrixToast.classList.add('show');
            setTimeout(() => {
                matrixToast.classList.remove('show');
            }, 2500);

            konamiIndex = 0; // Reset index
        }
    } else {
        konamiIndex = 0; // Reset kalau pencet tombol yang salah
    }
});

// Avatar Glitch Easter Egg (69 Seconds)
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
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            navMenu.classList.remove('active');
            hamburgerBtn.classList.remove('active');
        }
    });
}

// ===== Typing Effect Bio =====
const typingEl = document.getElementById('typing-text');
const bioTexts = [
    "With great power comes great responsibility"
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
        speed = 1500; // jeda di akhir kalimat
        isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        bioIndex = (bioIndex + 1) % bioTexts.length;
        speed = 300;
    }

    setTimeout(typeLoop, speed);
}

typeLoop();