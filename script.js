// --- Initialization ---
lucide.createIcons();
document.getElementById('year').textContent = new Date().getFullYear();
const navbar = document.getElementById('navbar');

// --- Theme Toggle Logic ---
const themeToggle = document.getElementById('theme-toggle');
const htmlElement = document.documentElement;

// Check for saved theme (Default to Light Mode) safely
try {
    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
    } else {
        htmlElement.classList.remove('dark');
    }
} catch (e) {
    console.warn("Theme storage access denied.");
}

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        htmlElement.classList.toggle('dark');
        try {
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        } catch (e) {
            console.warn("Could not save theme preference.");
        }
        lucide.createIcons(); // Refresh icons
    });
}

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        navbar.classList.remove('top-6', 'w-[95%]', 'max-w-5xl');
        navbar.classList.add('top-4', 'w-[90%]', 'max-w-4xl', 'opacity-90', 'hover:opacity-100');
    } else {
        navbar.classList.add('top-6', 'w-[95%]', 'max-w-5xl');
        navbar.classList.remove('top-4', 'w-[90%]', 'max-w-4xl', 'opacity-90', 'hover:opacity-100');
    }
});

// --- GSAP Setup ---
gsap.registerPlugin(ScrollTrigger);

// --- Intro Hook Animations ---
gsap.from(".intro-text", {
    y: 30,
    opacity: 0,
    duration: 0.8,
    stagger: 0.15,
    ease: "power4.out",
    delay: 0.2
});

// --- Scene Indicator & Side Navigation ---
const indicator = document.getElementById('scene-indicator');
const sideNav = document.getElementById('side-nav');
const scenes = document.querySelectorAll('.scene-container');

// Create side nav dots
scenes.forEach((scene, index) => {
    const dot = document.createElement('div');
    dot.className = 'nav-dot';
    dot.setAttribute('data-label', scene.dataset.scene || `Scene ${index + 1}`);
    dot.addEventListener('click', () => {
        scene.scrollIntoView({ behavior: 'smooth' });
    });
    sideNav.appendChild(dot);

    ScrollTrigger.create({
        trigger: scene,
        start: "top center",
        end: "bottom center",
        onToggle: self => {
            if (self.isActive) {
                // Update indicator text
                indicator.textContent = scene.dataset.scene;
                indicator.style.opacity = 1;
                
                // Update dots
                const dots = sideNav.querySelectorAll('.nav-dot');
                dots.forEach(d => d.classList.remove('active'));
                dots[index].classList.add('active');
            }
        },
        onLeave: () => {
            if(index === scenes.length - 1) {
                indicator.style.opacity = 0; // Hide indicator after last scene
            }
        },
        onLeaveBack: () => {
            if(index === 0) {
                indicator.style.opacity = 0; // Hide indicator before first scene
                const dots = sideNav.querySelectorAll('.nav-dot');
                dots.forEach(d => d.classList.remove('active'));
            }
        }
    });
});

// --- Generic Scene Animations ---
scenes.forEach((scene) => {
    
    // Step 1: Problem Line
    const problemText = scene.querySelector('.problem-text');
    if (problemText) {
        gsap.fromTo(problemText, 
            { opacity: 0, y: 20 },
            { 
                opacity: 1, 
                y: 0, 
                duration: 0.8, 
                ease: "power3.out",
                scrollTrigger: {
                    trigger: scene.querySelector('.panel-problem'),
                    start: "top center",
                    end: "bottom center",
                    toggleActions: "play none none none"
                }
            }
        );
    }

    // Step 2: Traditional Way
    const traditionalPanel = scene.querySelector('.panel-traditional');
    if (traditionalPanel) {
        const tag = traditionalPanel.querySelector('.tag-traditional');
        const lines = traditionalPanel.querySelectorAll('.anim-line');
        const mockup = traditionalPanel.querySelector('.mockup-ui');
        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: traditionalPanel,
                start: "top 70%",
                end: "bottom center",
                toggleActions: "play none none none"
            }
        });
        
        tl.fromTo(tag, { x: -30, opacity: 0 }, { x: 0, opacity: 1, duration: 0.4, ease: "power3.out" })
          .fromTo(lines, 
            { y: 15, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.1, ease: "power3.out" }
          );
        
        if (mockup) {
            tl.fromTo(mockup, 
                { y: 30, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 0.7, ease: "power3.out" },
                "<0.1" // Small offset after lines start
            );
        }
    }

    // Step 3: The Shift
    const shiftPanel = scene.querySelector('.panel-shift');
    if (shiftPanel) {
        const shiftText = shiftPanel.querySelector('.shift-text');
        gsap.fromTo(shiftText,
            { opacity: 0, scale: 0.95 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.6,
                ease: "back.out(1.5)",
                scrollTrigger: {
                    trigger: shiftPanel,
                    start: "top center",
                    end: "bottom center",
                    toggleActions: "play none none none"
                }
            }
        );
    }

    // Step 4: MicroCampus Way
    const mcPanel = scene.querySelector('.panel-microcampus');
    if (mcPanel) {
        const tag = mcPanel.querySelector('.tag-microcampus');
        const lines = mcPanel.querySelectorAll('.anim-line');
        const mockup = mcPanel.querySelector('.mockup-ui');
        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: mcPanel,
                start: "top 70%",
                end: "bottom center",
                toggleActions: "play none none none"
            }
        });

        tl.fromTo(tag, { x: 30, opacity: 0 }, { x: 0, opacity: 1, duration: 0.4, ease: "power3.out" })
          .fromTo(lines, 
            { y: 15, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.08, ease: "power3.out" }
          );

        if (mockup) {
            tl.fromTo(mockup, 
                { y: 30, scale: 0.98, opacity: 0 }, 
                { y: 0, scale: 1, opacity: 1, duration: 0.7, ease: "back.out(1.2)" },
                "<0.1" // Start at the same time as lines
            );
        }
    }

    // Divider Line
    const divider = scene.querySelector('.divider-line');
    if (divider) {
        gsap.fromTo(divider,
            { scaleX: 0 },
            {
                scaleX: 1,
                duration: 0.8,
                ease: "expo.out",
                scrollTrigger: {
                    trigger: divider,
                    start: "top bottom",
                    toggleActions: "play none none none"
                }
            }
        );
    }
});


// --- Features Grid Animations ---
const featuresGrid = document.getElementById('features-grid');
if (featuresGrid) {
    const cards = featuresGrid.querySelectorAll('.p-8');
    
    // Set initial state to avoid flicker if script loads late
    gsap.set(cards, { opacity: 0, y: 30, scale: 0.95 });

    ScrollTrigger.batch(cards, {
        onEnter: batch => gsap.to(batch, {
            opacity: 1, 
            y: 0, 
            scale: 1,
            stagger: 0.05, 
            duration: 0.5, 
            ease: "power3.out",
            overwrite: true
        }),
        start: "top 95%"
    });
}


// --- Cost Section Animations ---
const costSection = document.getElementById('cost-section');
if (costSection) {
    const title = costSection.querySelector('.cost-title');
    const cards = costSection.querySelectorAll('.cost-card');
    const totalPanel = costSection.querySelector('.cost-total');
    const counter = costSection.querySelector('.counter-element');
    const pause = costSection.querySelector('.cost-pause p');
    const finalSection = costSection.querySelector('.cost-final');

    // Title
    gsap.from(title, {
        opacity: 0,
        y: 20,
        duration: 0.6,
        scrollTrigger: {
            trigger: costSection,
            start: "top 70%",
        }
    });

    // Cards & Total
    const tlCost = gsap.timeline({
        scrollTrigger: {
            trigger: ".cost-card",
            start: "top 70%",
        }
    });

    tlCost.from(cards, {
        opacity: 0,
        y: 30,
        duration: 0.4,
        stagger: 0.1,
        ease: "back.out(1.4)"
    })
    .from(totalPanel, {
        opacity: 0,
        duration: 0.3
    })
    .to(counter, {
        innerHTML: 47000,
        duration: 1.5,
        ease: "power2.out",
        snap: { innerHTML: 1 },
        onUpdate: function() {
            counter.innerHTML = "৳" + Math.round(this.targets()[0].innerHTML).toLocaleString();
        }
    });

    // Pause "Or..."
    gsap.from(pause, {
        opacity: 0,
        duration: 0.8,
        scrollTrigger: {
            trigger: ".cost-pause",
            start: "top 70%",
            end: "bottom 40%",
            toggleActions: "play none none none"
        }
    });

    // Final Slam
    gsap.from(finalSection, {
        opacity: 0,
        scale: 0.95,
        duration: 0.7,
        ease: "back.out(1.7)",
        scrollTrigger: {
            trigger: finalSection,
            start: "top 80%",
        }
    });

    // Pulse animation on the price
    gsap.to(".pulse-anim", {
        scale: 1.08,
        duration: 0.8,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });
}

// --- Skip Button Logic ---
const skipBtn = document.getElementById('skip-button');
if (skipBtn) {
    // Ensure icons are created even if button was added later
    lucide.createIcons({
        attrs: {
            class: 'lucide'
        },
        nameAttr: 'data-lucide'
    });

    gsap.fromTo(skipBtn, 
        { opacity: 0, y: 20 },
        {
            opacity: 1,
            y: 0,
            duration: 0.4,
            ease: "power3.out",
            delay: 0.2
        }
    );

    skipBtn.addEventListener('click', () => {
        const costSection = document.getElementById('cost-section');
        if (costSection) {
            costSection.scrollIntoView({ behavior: 'smooth' });
        }
    });

    // Hide skip button when reaching the cost section
    ScrollTrigger.create({
        trigger: "#cost-section",
        start: "top 80%",
        onEnter: () => gsap.to(skipBtn, { opacity: 0, pointerEvents: 'none', duration: 0.3 }),
        onLeaveBack: () => gsap.to(skipBtn, { opacity: 1, pointerEvents: 'auto', duration: 0.3 })
    });
}

// Final call to ensure all icons (including the new features grid) are rendered
lucide.createIcons();

// --- Mobile Menu Logic ---
const menuToggle = document.getElementById('menu-toggle');
const menuClose = document.getElementById('menu-close');
const mobileMenu = document.getElementById('mobile-menu');
const mobileLinks = document.querySelectorAll('.mobile-link');
const mobileYear = document.getElementById('mobile-year');

if (mobileYear) mobileYear.textContent = new Date().getFullYear();

function openMenu() {
    mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
    mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
    
    // Reset and animate links
    gsap.set(".mobile-link", { y: 20, opacity: 0 });
    gsap.to(".mobile-link", {
        y: 0,
        opacity: 1,
        stagger: 0.05,
        duration: 0.3,
        ease: "power3.out",
        delay: 0.1
    });
}

function closeMenu() {
    mobileMenu.classList.add('opacity-0', 'pointer-events-none');
    mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
}

if (menuToggle && menuClose && mobileMenu) {
    menuToggle.addEventListener('click', openMenu);
    menuClose.addEventListener('click', closeMenu);

    mobileLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    closeMenu();
                    setTimeout(() => {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }, 300);
                }
            } else {
                // If it's index.html or booking.html, the browser will navigate anyway
                // but we close the menu for a smooth transition if it's the same page
                if (href === 'index.html' && window.location.pathname.endsWith('index.html')) {
                    e.preventDefault();
                    closeMenu();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }
        });
    }
    );
}
