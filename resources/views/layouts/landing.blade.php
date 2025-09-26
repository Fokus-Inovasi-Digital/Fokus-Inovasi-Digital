<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Fokus Inovasi Digital — Innovation & Digital Solutions</title>
    <meta name="description"
        content="PT Fokus Inovasi Digital — delivering modern digital products, services and solutions. Explore our products, latest articles, partners, and career opportunities.">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#fc6666">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Fokus Inovasi">
    <link rel="manifest" href="manifest.json">

    <!-- Favicon Placeholders -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- External Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/motion@11.3.0/dist/motion.min.js"></script>
    <script src="https://lenis.darkroom.engineering/bundle.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Google reCAPTCHA v2 - Replace with your site key -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #fc6666 0%, #000000 100%);
            --primary-red: #fc6666;
            --bg-dark: #0a0a0a;
            --bg-darker: #000000;
            --text-light: #ffffff;
            --text-gray: #a0a0a0;
            --text-muted: #666666;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            overflow-x: hidden;
            cursor: none;
        }

        /* Custom Selection */
        ::selection {
            background: var(--primary-red);
            color: white;
            text-shadow: 0 0 10px rgba(252, 102, 102, 0.5);
        }

        ::-moz-selection {
            background: var(--primary-red);
            color: white;
            text-shadow: 0 0 10px rgba(252, 102, 102, 0.5);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-darker);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-red);
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(252, 102, 102, 0.3);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff5555;
            box-shadow: 0 0 15px rgba(252, 102, 102, 0.5);
        }

        /* Firefox scrollbar */
        html {
            scrollbar-width: thin;
            scrollbar-color: var(--primary-red) var(--bg-darker);
        }

        /* Custom Cursor */
        .cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            background: var(--primary-red);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s ease;
        }

        .cursor-follower {
            position: fixed;
            width: 40px;
            height: 40px;
            border: 2px solid var(--primary-red);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .cursor.hover {
            transform: scale(1.5);
            background: transparent;
            border: 2px solid var(--primary-red);
        }

        /* Touch devices - show cursor */
        @media (hover: none) {
            body {
                cursor: auto;
            }

            .cursor,
            .cursor-follower {
                display: none;
            }
        }

        /* Preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-darker);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .preloader.fade-out {
            opacity: 0;
            transform: translateY(-100%);
        }

        .preloader-content {
            text-align: center;
        }

        .preloader-logo {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        .progress-bar {
            width: 200px;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary-gradient);
            width: 0%;
            transition: width 0.3s ease;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Glass morphism */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: var(--text-light);
            margin: 3px 0;
            transition: 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .mobile-menu.active {
            transform: translateY(0);
        }

        /* Hero gradient text */
        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Button styles */
        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.6s ease;
            transform: translate(-50%, -50%);
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Marquee Footer */
        .marquee {
            display: flex;
            white-space: nowrap;
            animation: scroll-left 17s linear infinite;
        }

        .marquee:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Modal styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: var(--bg-dark);
            border: 1px solid var(--glass-border);
            border-radius: 1rem;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(50px);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        /* Chat Widget */
        .chat-widget {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .chat-toggle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(252, 102, 102, 0.3);
            transition: all 0.3s ease;
        }

        .chat-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(252, 102, 102, 0.5);
        }

        .chat-panel {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            height: 400px;
            background: var(--bg-dark);
            border: 1px solid var(--glass-border);
            border-radius: 1rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .chat-panel.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Animations */
        .animate-blur-in {
            opacity: 0;
            filter: blur(10px);
            transform: translateY(30px);
        }

        /* Reduce motion */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .marquee {
                animation: none;
            }

            .cursor,
            .cursor-follower {
                display: none;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .desktop-nav {
                display: none;
            }

            .chat-panel {
                width: 300px;
            }
        }

        /* Skip to content */
        .skip-to-content {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary-red);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .skip-to-content:focus {
            top: 6px;
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Skip to Content Link -->
    <a href="#main-content" class="skip-to-content">Skip to main content</a>

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Preloader -->
    <div class="preloader" id="preloader" aria-hidden="true">
        <div class="preloader-content">
            <div class="preloader-logo">Fokus Inovasi</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="text-2xl font-bold gradient-text">
                Fokus Inovasi
            </div>

            <!-- Desktop Navigation -->
            <ul class="desktop-nav flex space-x-8 font-medium">
                <li><a href="#home" class="nav-link hover:text-red-400 transition-colors">Home</a></li>
                <li><a href="#about" class="nav-link hover:text-red-400 transition-colors">About</a></li>
                <li><a href="#services" class="nav-link hover:text-red-400 transition-colors">Services</a></li>
                <li><a href="#portfolio" class="nav-link hover:text-red-400 transition-colors">Portfolio</a></li>
                <li><a href="#blog" class="nav-link hover:text-red-400 transition-colors">Blog</a></li>
                <li><a href="#contact" class="nav-link hover:text-red-400 transition-colors">Contact</a></li>
            </ul>

            <!-- Login Button -->
            <button class="btn-primary" onclick="openModal('loginModal')" aria-label="Open login modal">
                <span class="relative z-10">Login</span>
            </button>

            <!-- Mobile Hamburger -->
            <div class="hamburger" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu" role="button"
                tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Mobile navigation">
        <div class="flex flex-col items-center justify-center h-full space-y-8 text-2xl">
            <a href="#home" class="nav-link" onclick="toggleMobileMenu()">Home</a>
            <a href="#about" class="nav-link" onclick="toggleMobileMenu()">About</a>
            <a href="#services" class="nav-link" onclick="toggleMobileMenu()">Services</a>
            <a href="#portfolio" class="nav-link" onclick="toggleMobileMenu()">Portfolio</a>
            <a href="#blog" class="nav-link" onclick="toggleMobileMenu()">Blog</a>
            <a href="#contact" class="nav-link" onclick="toggleMobileMenu()">Contact</a>
        </div>
    </div>

    <main class="main-content">
        {{ $slot }}
    </main>

    <!-- Footer with Running Quotes -->
    <footer class="bg-black border-t border-gray-800">
        <div class="overflow-hidden border-t border-b border-gray-800 py-6 bg-black">
            <div class="marquee text-4xl font-extrabold uppercase tracking-tight md:text-6xl">
                <span
                    class="gradient-text mx-12 md:mx-16 flex-shrink-0 cursor-pointer hover:text-red-400 transition-colors"
                    onclick="openQuoteModal('Innovation is the key to success')">
                    Fokus Inovasi Digital
                </span>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 gradient-text">Fokus Inovasi</h3>
                    <p class="text-gray-400 mb-4">Delivering innovative digital solutions that transform businesses.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">LinkedIn</a>
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">Twitter</a>
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">GitHub</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-red-400 transition-colors">Web Development</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Mobile Apps</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Cloud Solutions</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">AI & ML</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-red-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-red-400 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Cookie Policy</a></li>
                    </ul>
                    <div class="mt-6">
                        <button id="animationToggle" onclick="toggleAnimations()"
                            class="text-sm text-gray-400 hover:text-red-400 transition-colors"
                            aria-label="Toggle animations">
                            Disable Animations
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 py-6 text-center text-gray-400">
            <p>&copy; 2024 PT Fokus Inovasi Digital. All rights reserved.</p>
        </div>
    </footer>

    <!-- Modals -->
    <!-- Service Modal -->
    <div id="serviceModal" class="modal" role="dialog" aria-labelledby="service-title" aria-modal="true">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 id="service-title" class="text-2xl font-bold">Web Development</h2>
                <button onclick="closeModal('serviceModal')" class="text-gray-400 hover:text-white text-2xl"
                    aria-label="Close service modal">&times;</button>
            </div>
            <div class="space-y-4">
                <p class="text-gray-300">
                    Our web development services include modern, responsive websites and web applications built with
                    cutting-edge technologies like React, Vue.js, Node.js, and more.
                </p>
                <ul class="list-disc list-inside text-gray-400 space-y-2">
                    <li>Custom web application development</li>
                    <li>E-commerce platforms</li>
                    <li>Progressive Web Apps (PWAs)</li>
                    <li>API development and integration</li>
                    <li>Performance optimization</li>
                </ul>
                <button class="btn-primary mt-6" onclick="scrollToSection('contact'); closeModal('serviceModal')">
                    <span class="relative z-10">Get Quote</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Partner Modal -->
    <div id="partnerModal" class="modal" role="dialog" aria-labelledby="partner-title" aria-modal="true">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 id="partner-title" class="text-2xl font-bold">Partner Details</h2>
                <button onclick="closeModal('partnerModal')" class="text-gray-400 hover:text-white text-2xl"
                    aria-label="Close partner modal">&times;</button>
            </div>
            <div id="partner-content">
                <!-- Partner content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Blog Modal -->
    <div id="blogModal" class="modal" role="dialog" aria-labelledby="blog-title" aria-modal="true">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 id="blog-title" class="text-2xl font-bold">Blog Article</h2>
                <button onclick="closeModal('blogModal')" class="text-gray-400 hover:text-white text-2xl"
                    aria-label="Close blog modal">&times;</button>
            </div>
            <div id="blog-content">
                <!-- Blog content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-all duration-300 z-50"
        role="alert" aria-live="polite">
        <div id="toast-message"></div>
    </div>

    <!-- Chat Widget -->
    <div class="chat-widget">
        <div class="chat-panel" id="chatPanel" role="dialog" aria-label="Chat support">
            <div class="bg-gradient-to-r from-red-600 to-black p-4 text-white">
                <h3 class="font-bold">Chat Support</h3>
                <p class="text-sm opacity-80">How can we help you today?</p>
            </div>
            <div class="flex-1 p-4 overflow-y-auto" style="height: 280px;">
                <div id="chatMessages" class="space-y-4" role="log" aria-live="polite"
                    aria-label="Chat messages">
                    <div class="bg-gray-800 p-3 rounded-lg">
                        <p class="text-sm">👋 Hello! I'm here to help. What can I do for you?</p>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-700">
                <div class="flex space-x-2">
                    <input type="text" id="chatInput" placeholder="Type a message..."
                        class="flex-1 p-2 bg-gray-800 border border-gray-600 rounded text-sm focus:border-red-400 outline-none"
                        aria-label="Chat message input">
                    <button onclick="sendMessage()"
                        class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700 transition-colors"
                        aria-label="Send message">
                        Send
                    </button>
                </div>
                <div class="flex space-x-2 mt-2">
                    <button onclick="sendQuickReply('Tell me about your services')"
                        class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                        Services
                    </button>
                    <button onclick="sendQuickReply('I need a quote')"
                        class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                        Quote
                    </button>
                    <button onclick="sendQuickReply('Contact information')"
                        class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                        Contact
                    </button>
                </div>
            </div>
        </div>
        <button class="chat-toggle" onclick="toggleChat()" aria-label="Toggle chat support">
            💬
        </button>
    </div>

    <!-- JavaScript -->
    @vite(['resources/js/scripts.js'])
    <script src="{{ asset('js/scripts.js') }}"></script>
    @livewireScripts
</body>

</html>
