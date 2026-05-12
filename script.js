// --- Initialization ---
lucide.createIcons();
document.getElementById('year').textContent = new Date().getFullYear();

// --- Navbar Scroll Effect ---
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        navbar.classList.add('bg-white/80', 'backdrop-blur-xl', 'shadow-sm', 'py-4');
        navbar.classList.remove('py-6');
    } else {
        navbar.classList.remove('bg-white/80', 'backdrop-blur-xl', 'shadow-sm', 'py-4');
        navbar.classList.add('py-6');
    }
});

// --- Mobile Menu ---
const menuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
let isMenuOpen = false;

menuBtn.addEventListener('click', () => {
    isMenuOpen = !isMenuOpen;
    if (isMenuOpen) {
        mobileMenu.classList.remove('hidden');
        menuBtn.innerHTML = '<i data-lucide="x"></i>';
    } else {
        mobileMenu.classList.add('hidden');
        menuBtn.innerHTML = '<i data-lucide="menu"></i>';
    }
    lucide.createIcons();
});

// --- Scroll Reveal Animation ---
const revealElements = document.querySelectorAll('.reveal');

function checkReveal() {
    revealElements.forEach(el => {
        const rect = el.getBoundingClientRect();
        const trigger = window.innerHeight * 0.85;
        if (rect.top < trigger) {
            el.classList.add('active');
        }
    });
}
window.addEventListener('scroll', checkReveal);
setTimeout(checkReveal, 100); // Initial check



