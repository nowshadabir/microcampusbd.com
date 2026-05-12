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

// --- Counter Animation ---
const counters = document.querySelectorAll('.count-up');
let hasCounted = false;

function startCounting() {
    if (hasCounted) return;
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16);

        let current = 0;
        const updateCount = () => {
            current += increment;
            if (current < target) {
                // Format currency for this specific counter
                counter.innerText = '৳' + Math.ceil(current).toLocaleString();
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = '৳' + target.toLocaleString();
            }
        };
        updateCount();
    });
    hasCounted = true;
}

// Trigger counting when hero is visible
setTimeout(startCounting, 1000);


// --- PRICING LOGIC (Interactive) ---
const slider = document.getElementById('student-slider');
const display = document.getElementById('student-count-display');
const pBasic = document.getElementById('price-basic');
const pStandard = document.getElementById('price-standard');
const pPremium = document.getElementById('price-premium');

function updatePricing() {
    const count = parseInt(slider.value);
    display.innerText = count.toLocaleString();

    // Pricing Algorithm (Demo Logic)
    // Base Prices
    let basic = 2000;
    let standard = 4000;
    let premium = 7000;

    // Multiplier based on volume
    // + ৳8 per student for Basic
    // + ৳10 per student for Standard
    // + ৳14 per student for Premium

    let finalBasic = basic + (count * 8);
    let finalStandard = standard + (count * 10);
    let finalPremium = premium + (count * 14);

    // Rounding for cleaner look
    finalBasic = Math.round(finalBasic / 100) * 100;
    finalStandard = Math.round(finalStandard / 100) * 100;
    finalPremium = Math.round(finalPremium / 100) * 100;

    // Formatting
    pBasic.innerText = '৳' + finalBasic.toLocaleString();
    pStandard.innerText = '৳' + finalStandard.toLocaleString();
    pPremium.innerText = '৳' + finalPremium.toLocaleString();
}

slider.addEventListener('input', updatePricing);
updatePricing(); // Init