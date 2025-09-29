<!-- Navbar -->
<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="text-2xl font-bold gradient-text">
            Fokus ID
        </div>

        <!-- Desktop Navigation -->
        <ul class="desktop-nav flex space-x-8 font-medium">
            <li><a href="{{ route('home') }}" class="nav-link hover:text-red-400 transition-colors">Home</a></li>
            <li><a href="/about" class="nav-link hover:text-red-400 transition-colors">About Us</a></li>
            <li><a href="#" class="nav-link hover:text-red-400 transition-colors">News</a></li>
            <li><a href="/solutions" class="nav-link hover:text-red-400 transition-colors">Solutions</a></li>
            <li><a href="/contact" class="nav-link hover:text-red-400 transition-colors">Contact</a></li>
        </ul>

        <!-- Login Button -->
        <a href="{{ route('login') }}" wire:navigate class="btn-primary hidden lg:inline-block">
            <span class="relative z-10">Login</span>
        </a>

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
        <a href="/" class="nav-link" onclick="toggleMobileMenu()">Home</a>
        <a href="/about" class="nav-link" onclick="toggleMobileMenu()">About Us</a>
        <a href="/news" class="nav-link" onclick="toggleMobileMenu()">News</a>
        <a href="/solutions" class="nav-link" onclick="toggleMobileMenu()">Solutions</a>
        <a href="/contact" class="nav-link" onclick="toggleMobileMenu()">Contact</a>
        <a href="{{ route('login') }}" wire:navigate class="nav-link">Login</a>
    </div>
</div>
