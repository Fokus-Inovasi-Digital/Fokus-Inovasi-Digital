// scripts.js - PT Fokus Inovasi Digital Landing Page

// Global variables
let lenis;
let animationsEnabled = true;

document.addEventListener("DOMContentLoaded", function () {
    const storedPref = localStorage.getItem("animations-enabled");
    if (storedPref !== null) {
        animationsEnabled = JSON.parse(storedPref);
        updateAnimationToggle();
    }

    initPreloader();
    initLenis();
    initGSAPAnimations();
    initCustomCursor();
    initNavbarBehavior();
    initKeyboardHandlers();
    initMotionPreference();
});

// Preloader functionality
function initPreloader() {
    const preloader = document.getElementById("preloader");
    const progressFill = document.getElementById("progressFill");
    let progress = 0;

    const progressInterval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress >= 100) {
            progress = 100;
            clearInterval(progressInterval);

            setTimeout(() => {
                preloader.classList.add("fade-out");
                preloader.setAttribute("aria-hidden", "true");

                setTimeout(() => {
                    preloader.style.display = "none";
                }, 500);
            }, 600);
        }
        progressFill.style.width = progress + "%";
    }, 100);

    // Fallback - hide preloader after window load
    window.addEventListener("load", () => {
        setTimeout(() => {
            if (preloader.style.display !== "none") {
                clearInterval(progressInterval);
                preloader.classList.add("fade-out");
                preloader.setAttribute("aria-hidden", "true");
                setTimeout(() => {
                    preloader.style.display = "none";
                }, 500);
            }
        }, 600);
    });
}

// Lenis smooth scrolling initialization
function initLenis() {
    if (window.Lenis) {
        lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: "vertical",
            gestureDirection: "vertical",
            smooth: animationsEnabled,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Integrate with GSAP ScrollTrigger
        if (window.ScrollTrigger) {
            lenis.on("scroll", ScrollTrigger.update);

            ScrollTrigger.scrollerProxy(document.body, {
                scrollTop(value) {
                    return arguments.length
                        ? lenis.scrollTo(value, { immediate: true })
                        : lenis.animatedScroll;
                },
                getBoundingClientRect() {
                    return {
                        top: 0,
                        left: 0,
                        width: window.innerWidth,
                        height: window.innerHeight,
                    };
                },
                pinType: document.body.style.transform ? "transform" : "fixed",
            });
        }
    }
}

// GSAP Animations
function initGSAPAnimations() {
    if (!window.gsap || !animationsEnabled) return;

    gsap.registerPlugin(ScrollTrigger);

    // Animate elements with blur-in class
    gsap.utils.toArray(".animate-blur-in").forEach((element, index) => {
        gsap.fromTo(
            element,
            {
                opacity: 0,
                filter: "blur(10px)",
                y: 30,
            },
            {
                opacity: 1,
                filter: "blur(0px)",
                y: 0,
                duration: 1,
                delay: index * 0.1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 80%",
                    end: "bottom 20%",
                    toggleActions: "play none none reverse",
                },
            }
        );
    });

    // Letter animation for hero description
    gsap.utils.toArray(".letter-animate").forEach((letter, index) => {
        gsap.fromTo(
            letter,
            {
                opacity: 0,
                color: "#666666",
            },
            {
                opacity: 1,
                color: "#fc6666",
                duration: 0.5,
                delay: index * 0.05,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: ".letter-animate",
                    start: "top 80%",
                    end: "bottom 20%",
                    toggleActions: "play none none reverse",
                },
            }
        );
    });

    // Partner carousel animation
    if (document.querySelector(".animate-scroll")) {
        gsap.to(".animate-scroll", {
            x: "-50%",
            duration: 20,
            repeat: -1,
            ease: "none",
            paused: !animationsEnabled,
        });
    }
}

// Motion One fallback for vanilla JS (when GSAP is not available)
function initMotionOneAnimations() {
    if (!window.Motion || !animationsEnabled) return;

    const { animate, scroll } = Motion;

    // Animate blur-in elements
    document.querySelectorAll(".animate-blur-in").forEach((element, index) => {
        scroll(
            animate(
                element,
                {
                    opacity: [0, 1],
                    filter: ["blur(10px)", "blur(0px)"],
                    transform: ["translateY(30px)", "translateY(0px)"],
                },
                {
                    duration: 1,
                    delay: index * 0.1,
                    easing: "ease-out",
                }
            ),
            { target: element, offset: ["start end", "end start"] }
        );
    });

    // Letter animation fallback
    document.querySelectorAll(".letter-animate").forEach((letter, index) => {
        scroll(
            animate(
                letter,
                {
                    opacity: [0, 1],
                    color: ["#666666", "#fc6666"],
                },
                {
                    duration: 0.5,
                    delay: index * 0.05,
                    easing: "ease-out",
                }
            ),
            { target: letter.parentElement, offset: ["start end", "end start"] }
        );
    });
}

// Custom cursor functionality
function initCustomCursor() {
    // Skip on touch devices
    if ("ontouchstart" in window || navigator.maxTouchPoints > 0) {
        document.body.style.cursor = "auto";
        return;
    }

    const cursor = document.querySelector(".cursor");
    const follower = document.querySelector(".cursor-follower");
    let mouseX = 0,
        mouseY = 0;
    let followerX = 0,
        followerY = 0;

    if (!cursor || !follower) return;

    // Mouse move handler
    document.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        cursor.style.left = mouseX - 10 + "px";
        cursor.style.top = mouseY - 10 + "px";
    });

    // Smooth follower animation
    function animateFollower() {
        followerX += (mouseX - followerX) * 0.1;
        followerY += (mouseY - followerY) * 0.1;

        follower.style.left = followerX - 20 + "px";
        follower.style.top = followerY - 20 + "px";

        requestAnimationFrame(animateFollower);
    }
    animateFollower();

    // Add hover effects
    const interactiveElements =
        "a, button, [onclick], .cursor-pointer, input, textarea";
    document.addEventListener("mouseover", (e) => {
        if (e.target.matches(interactiveElements)) {
            cursor.classList.add("hover");
            follower.style.transform = "scale(1.5)";
        }
    });

    document.addEventListener("mouseout", (e) => {
        if (e.target.matches(interactiveElements)) {
            cursor.classList.remove("hover");
            follower.style.transform = "scale(1)";
        }
    });
}

// Navbar behavior
function initNavbarBehavior() {
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
}

// // Partner carousel functionality
// function initPartnerCarousel() {
//     const carousel = document.querySelector(".partner-carousel");
//     if (!carousel) return;

//     let isPaused = false;

//     // Pause on hover
//     carousel.addEventListener("mouseenter", () => {
//         isPaused = true;
//         const animation = document.querySelector(".animate-scroll");
//         if (animation && window.gsap) {
//             gsap.to(animation, { duration: 0.3, timeScale: 0 });
//         }
//     });

//     // Resume on mouse leave
//     carousel.addEventListener("mouseleave", () => {
//         isPaused = false;
//         const animation = document.querySelector(".animate-scroll");
//         if (animation && window.gsap) {
//             gsap.to(animation, { duration: 0.3, timeScale: 1 });
//         }
//     });

//     // Keyboard navigation
//     const partnerLogos = carousel.querySelectorAll(".partner-logo");
//     partnerLogos.forEach((logo, index) => {
//         logo.setAttribute("tabindex", "0");
//         logo.addEventListener("keydown", (e) => {
//             if (e.key === "Enter" || e.key === " ") {
//                 e.preventDefault();
//                 logo.click();
//             }
//         });
//     });
// }

// Animation toggle functionality
function toggleAnimations() {
    animationsEnabled = !animationsEnabled;
    localStorage.setItem(
        "animations-enabled",
        JSON.stringify(animationsEnabled)
    );

    updateAnimationToggle();

    // Update Lenis smooth scrolling
    if (lenis) {
        lenis.smooth = animationsEnabled;
    }

    // Show toast
    showToast(
        animationsEnabled ? "Animations enabled" : "Animations disabled",
        "success"
    );

    // Reload animations if enabled
    if (animationsEnabled) {
        location.reload();
    } else {
        // Disable current animations
        const style = document.createElement("style");
        style.textContent = `
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        `;
        document.head.appendChild(style);
    }
}

function updateAnimationToggle() {
    const toggle = document.getElementById("animationToggle");
    if (toggle) {
        toggle.textContent = animationsEnabled
            ? "Disable Animations"
            : "Enable Animations";
    }
}

// Respect prefers-reduced-motion
function initMotionPreference() {
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    function handleMotionPreference(e) {
        if (e.matches) {
            animationsEnabled = false;
            updateAnimationToggle();

            // Add reduced motion styles
            const style = document.createElement("style");
            style.textContent = `
                *, *::before, *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
                .marquee {
                    animation: none !important;
                }
            `;
            document.head.appendChild(style);
        }
    }

    prefersReducedMotion.addListener(handleMotionPreference);
    handleMotionPreference(prefersReducedMotion);
}

// Keyboard handlers
function initKeyboardHandlers() {
    document.addEventListener("keydown", (e) => {
        // ESC key closes modals
        if (e.key === "Escape") {
            const activeModal = document.querySelector(".modal.active");
            if (activeModal) {
                closeModal(activeModal.id);
            }

            // Close mobile menu
            const mobileMenu = document.getElementById("mobileMenu");
            if (mobileMenu.classList.contains("active")) {
                toggleMobileMenu();
            }

            // Close chat
            const chatPanel = document.getElementById("chatPanel");
            if (chatPanel.classList.contains("active")) {
                toggleChat();
            }
        }
    });

    // Hamburger keyboard support
    const hamburger = document.querySelector(".hamburger");
    if (hamburger) {
        hamburger.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                toggleMobileMenu();
            }
        });
    }
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
