// app.js - PT Fokus Inovasi Digital Landing Page

// Global variables
let lenis;
let animationsEnabled = true;
let mathAnswer = 8; // Initial answer for 5 + 3

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Check for stored animation preference
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
    initContactForm();
    initLoginForm();
    initChatBot();
    initPartnerCarousel();
    initPWA();
    generateMathCaptcha();
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
            }, 600); // Minimum display time
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

    // Navbar scroll animation
    ScrollTrigger.create({
        trigger: "body",
        start: "top -100",
        end: "bottom bottom",
        onUpdate: (self) => {
            const navbar = document.querySelector(".navbar");
            if (self.direction === -1) {
                navbar.classList.add("scrolled");
            } else if (self.scroll < 100) {
                navbar.classList.remove("scrolled");
            }
        },
    });
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
    let lastScroll = 0;

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }

        // Active nav link highlighting
        updateActiveNavLink();

        lastScroll = currentScroll;
    });
}

// Update active navigation link based on scroll position
function updateActiveNavLink() {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-link");

    let currentSection = "";

    sections.forEach((section) => {
        const rect = section.getBoundingClientRect();
        if (rect.top <= 100 && rect.bottom >= 100) {
            currentSection = section.getAttribute("id");
        }
    });

    navLinks.forEach((link) => {
        link.classList.remove("text-red-400");
        const href = link.getAttribute("href");
        if (href === `#${currentSection}`) {
            link.classList.add("text-red-400");
        }
    });
}

// Mobile menu functionality
function toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobileMenu");
    const hamburger = document.querySelector(".hamburger");

    mobileMenu.classList.toggle("active");
    hamburger.classList.toggle("active");

    // Toggle aria-expanded
    const isExpanded = hamburger.getAttribute("aria-expanded") === "true";
    hamburger.setAttribute("aria-expanded", !isExpanded);

    // Prevent body scroll when menu is open
    document.body.style.overflow = mobileMenu.classList.contains("active")
        ? "hidden"
        : "";

    // Focus management
    if (mobileMenu.classList.contains("active")) {
        mobileMenu.querySelector("a").focus();
    }
}

// Scroll to section with smooth animation
function scrollToSection(sectionId) {
    const target = document.getElementById(sectionId);
    if (target && lenis) {
        lenis.scrollTo(target, {
            offset: -80,
            duration: 1.5,
        });
    } else if (target) {
        target.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
}

// Contact form validation and submission
function initContactForm() {
    const form = document.getElementById("contactForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Validate form
        const errors = validateContactForm(data);
        displayFormErrors(errors, "contactForm");

        if (Object.keys(errors).length === 0) {
            // Simulate form submission
            try {
                showToast("Message sent successfully!", "success");
                form.reset();
                clearFormErrors("contactForm");

                // In production, replace with actual API call:
                // const response = await fetch('/api/contact', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify(data)
                // });
            } catch (error) {
                showToast("Failed to send message. Please try again.", "error");
            }
        }
    });
}

// Form validation functions
function validateContactForm(data) {
    const errors = {};

    if (!data.name.trim()) {
        errors.name = "Name is required";
    }

    if (!data.email.trim()) {
        errors.email = "Email is required";
    } else if (!isValidEmail(data.email)) {
        errors.email = "Please enter a valid email address";
    }

    if (!data.message.trim()) {
        errors.message = "Message is required";
    }

    return errors;
}

function validateLoginForm(data) {
    const errors = {};

    if (!data.loginEmail.trim()) {
        errors.loginEmail = "Email is required";
    } else if (!isValidEmail(data.loginEmail)) {
        errors.loginEmail = "Please enter a valid email address";
    }

    if (!data.loginPassword.trim()) {
        errors.loginPassword = "Password is required";
    }

    // Validate math captcha
    const userAnswer = parseInt(data.mathCaptcha);
    if (isNaN(userAnswer) || userAnswer !== mathAnswer) {
        errors.mathCaptcha = "Incorrect answer. Please try again.";
        generateMathCaptcha(); // Generate new question
    }

    return errors;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function displayFormErrors(errors, formId) {
    // Clear previous errors
    clearFormErrors(formId);

    // Display new errors
    Object.keys(errors).forEach((field) => {
        const errorElement = document.getElementById(
            `${field.replace("login", "").toLowerCase()}-error`
        );
        if (errorElement) {
            errorElement.textContent = errors[field];
            errorElement.classList.remove("hidden");
        }

        // Add error styling to input
        const input =
            document.getElementById(field) ||
            document.getElementById(
                field.replace("Email", "email").replace("Password", "password")
            );
        if (input) {
            input.classList.add("border-red-400");
        }
    });
}

function clearFormErrors(formId) {
    const form = document.getElementById(formId);
    const errorElements = form.querySelectorAll('[id$="-error"]');
    const inputs = form.querySelectorAll("input, textarea");

    errorElements.forEach((el) => {
        el.classList.add("hidden");
        el.textContent = "";
    });

    inputs.forEach((input) => {
        input.classList.remove("border-red-400");
    });
}

// Math captcha generation
function generateMathCaptcha() {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    mathAnswer = num1 + num2;

    const questionElement = document.getElementById("mathQuestion");
    if (questionElement) {
        questionElement.textContent = `${num1} + ${num2}`;
    }
}

// Toast notification
function showToast(message, type = "success") {
    const toast = document.getElementById("toast");
    const toastMessage = document.getElementById("toast-message");

    toastMessage.textContent = message;

    // Set colors based on type
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 z-50 ${
        type === "success" ? "bg-green-600" : "bg-red-600"
    } text-white opacity-100`;

    // Hide after 3 seconds
    setTimeout(() => {
        toast.classList.replace("opacity-100", "opacity-0");
    }, 3000);
}

// Modal functionality
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add("active");
        document.body.style.overflow = "hidden";

        // Focus first focusable element
        const focusableElement = modal.querySelector(
            "input, button, textarea, select"
        );
        if (focusableElement) {
            setTimeout(() => focusableElement.focus(), 100);
        }

        // Set up focus trap
        trapFocus(modal);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove("active");
        document.body.style.overflow = "";
        removeFocusTrap();
    }
}

// Focus trap for modals
function trapFocus(modal) {
    const focusableElements = modal.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    modal.addEventListener("keydown", function handleTabKey(e) {
        if (e.key === "Tab") {
            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    e.preventDefault();
                }
            }
        }

        if (e.key === "Escape") {
            const modalId = modal.id;
            closeModal(modalId);
        }
    });

    // Store the handler for removal
    modal._focusTrapHandler = function (e) {
        if (e.key === "Tab") {
            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    e.preventDefault();
                }
            }
        }

        if (e.key === "Escape") {
            const modalId = modal.id;
            closeModal(modalId);
        }
    };
}

function removeFocusTrap() {
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => {
        if (modal._focusTrapHandler) {
            modal.removeEventListener("keydown", modal._focusTrapHandler);
            delete modal._focusTrapHandler;
        }
    });
}

// Specialized modal content functions
function openPartnerModal(partnerName, description) {
    const content = document.getElementById("partner-content");
    const title = document.getElementById("partner-title");

    title.textContent = partnerName;
    content.innerHTML = `
        <div class="space-y-4">
            <p class="text-gray-300">${description}</p>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <strong>Industry:</strong> Technology
                </div>
                <div>
                    <strong>Partnership Since:</strong> 2020
                </div>
                <div>
                    <strong>Services:</strong> Cloud Solutions
                </div>
                <div>
                    <strong>Location:</strong> Global
                </div>
            </div>
            <button class="btn-primary mt-4" onclick="scrollToSection('contact'); closeModal('partnerModal')">
                <span class="relative z-10">Contact Partner</span>
            </button>
        </div>
    `;

    openModal("partnerModal");
}

function openBlogModal(title, content) {
    const titleElement = document.getElementById("blog-title");
    const contentElement = document.getElementById("blog-content");

    titleElement.textContent = title;
    contentElement.innerHTML = `
        <div class="space-y-4">
            <p class="text-gray-300">${content}</p>
            <div class="text-sm text-gray-400">
                <strong>Published:</strong> March 2024<br>
                <strong>Author:</strong> PT Fokus Inovasi Digital Team<br>
                <strong>Reading Time:</strong> 5 minutes
            </div>
            <div class="pt-4 border-t border-gray-700">
                <p class="text-gray-300 mb-4">This is a preview of the full article. Read more on our blog for complete insights and detailed analysis.</p>
                <button class="btn-primary" onclick="closeModal('blogModal')">
                    <span class="relative z-10">Read Full Article</span>
                </button>
            </div>
        </div>
    `;

    openModal("blogModal");
}

// Chat functionality
function initChatBot() {
    const chatInput = document.getElementById("chatInput");

    if (chatInput) {
        chatInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                sendMessage();
            }
        });
    }
}

function toggleChat() {
    const chatPanel = document.getElementById("chatPanel");
    chatPanel.classList.toggle("active");

    if (chatPanel.classList.contains("active")) {
        const input = document.getElementById("chatInput");
        setTimeout(() => input?.focus(), 100);
    }
}

function sendMessage() {
    const input = document.getElementById("chatInput");
    const message = input.value.trim();

    if (!message) return;

    addChatMessage(message, "user");
    input.value = "";

    // Simulate bot response
    setTimeout(() => {
        const response = generateBotResponse(message);
        addChatMessage(response, "bot");
    }, 1000);
}

function sendQuickReply(message) {
    addChatMessage(message, "user");

    setTimeout(() => {
        const response = generateBotResponse(message);
        addChatMessage(response, "bot");
    }, 1000);
}

function addChatMessage(message, sender) {
    const messagesContainer = document.getElementById("chatMessages");
    const messageElement = document.createElement("div");

    messageElement.className =
        sender === "user"
            ? "bg-red-600 text-white p-3 rounded-lg ml-8"
            : "bg-gray-800 p-3 rounded-lg mr-8";

    messageElement.innerHTML = `<p class="text-sm">${message}</p>`;
    messagesContainer.appendChild(messageElement);

    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Announce to screen readers
    messagesContainer.setAttribute("aria-live", "polite");
}

function generateBotResponse(userMessage) {
    const message = userMessage.toLowerCase();

    if (message.includes("service") || message.includes("what do you do")) {
        return "We offer web development, mobile apps, cloud solutions, AI & ML, cybersecurity, and analytics services. Which one interests you?";
    } else if (
        message.includes("quote") ||
        message.includes("price") ||
        message.includes("cost")
    ) {
        return "I'd be happy to help you get a quote! Please fill out our contact form with your project details, and our team will get back to you within 24 hours.";
    } else if (
        message.includes("contact") ||
        message.includes("reach") ||
        message.includes("phone")
    ) {
        return "You can reach us at info@fokusinovasi.com or +62 21 1234 5678. We're based in Jakarta, Indonesia. You can also use our contact form below!";
    } else if (
        message.includes("hello") ||
        message.includes("hi") ||
        message.includes("help")
    ) {
        return "Hello! I'm here to help you learn more about PT Fokus Inovasi Digital. What would you like to know about our services?";
    } else {
        return "Thank you for your message! For detailed inquiries, please use our contact form or email us at info@fokusinovasi.com. Our team will be happy to assist you!";
    }
}

// Partner carousel functionality
function initPartnerCarousel() {
    const carousel = document.querySelector(".partner-carousel");
    if (!carousel) return;

    let isPaused = false;

    // Pause on hover
    carousel.addEventListener("mouseenter", () => {
        isPaused = true;
        const animation = document.querySelector(".animate-scroll");
        if (animation && window.gsap) {
            gsap.to(animation, { duration: 0.3, timeScale: 0 });
        }
    });

    // Resume on mouse leave
    carousel.addEventListener("mouseleave", () => {
        isPaused = false;
        const animation = document.querySelector(".animate-scroll");
        if (animation && window.gsap) {
            gsap.to(animation, { duration: 0.3, timeScale: 1 });
        }
    });

    // Keyboard navigation
    const partnerLogos = carousel.querySelectorAll(".partner-logo");
    partnerLogos.forEach((logo, index) => {
        logo.setAttribute("tabindex", "0");
        logo.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                logo.click();
            }
        });
    });
}

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

// PWA functionality
function initPWA() {
    // Register service worker
    if ("serviceWorker" in navigator) {
        window.addEventListener("load", async () => {
            try {
                const registration = await navigator.serviceWorker.register(
                    "/sw.js"
                );
                console.log(
                    "ServiceWorker registered successfully:",
                    registration.scope
                );

                // Handle updates
                registration.addEventListener("updatefound", () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener("statechange", () => {
                        if (
                            newWorker.state === "installed" &&
                            navigator.serviceWorker.controller
                        ) {
                            // Show update available notification
                            showToast(
                                "App update available! Refresh to get the latest version.",
                                "info"
                            );
                        }
                    });
                });
            } catch (error) {
                console.error("ServiceWorker registration failed:", error);
            }
        });
    }

    // Handle install prompt
    let deferredPrompt;
    window.addEventListener("beforeinstallprompt", (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show install button (you can add this to your UI)
        console.log("PWA install prompt available");
    });

    // Handle app installed
    window.addEventListener("appinstalled", () => {
        showToast("App installed successfully!", "success");
        deferredPrompt = null;
    });
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

// Close modals when clicking outside
document.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
        closeModal(e.target.id);
    }
});

// Smooth scroll for anchor links
document.addEventListener("click", (e) => {
    if (e.target.matches('a[href^="#"]')) {
        e.preventDefault();
        const targetId = e.target.getAttribute("href").substring(1);
        scrollToSection(targetId);
    }
});
