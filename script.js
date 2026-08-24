const toggleInput = document.getElementById('theme-toggle');
const sliderIcon = document.querySelector('.slider-icon');
const sliderText = document.querySelector('.slider-text');
const currentTheme = localStorage.getItem('theme');

// Set tema awal pas pertama kali di-load
if (currentTheme === 'light') {
    document.body.classList.add('light-mode');
    toggleInput.checked = true;
    sliderIcon.textContent = '☀️';
    sliderText.textContent = 'LIGHT MODE';
} else {
    toggleInput.checked = false;
    sliderIcon.textContent = '🌙';
    sliderText.textContent = 'DARK MODE';
}

// Event listener pas saklar di-klik
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

// Jalankan animasi ngetik setelah page load
window.addEventListener('DOMContentLoaded', typeWriter);

const hamburgerBtn = document.getElementById('hamburger-btn');
const navMenu = document.getElementById('nav-menu');
const navLinks = document.querySelectorAll('.nav-links a');

if (hamburgerBtn && navMenu) {
    hamburgerBtn.addEventListener('click', () => {
        hamburgerBtn.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Otomatis menutup menu kalau salah satu link diklik
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            hamburgerBtn.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });
}
