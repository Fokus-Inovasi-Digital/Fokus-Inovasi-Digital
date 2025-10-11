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
            <li><a href="/articles" class="nav-link hover:text-red-400 transition-colors">News</a></li>
            <li class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button
                    class="nav-link font-medium flex items-center hover:text-red-400 transition-colors focus:outline-none"
                    :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true">
                    Solutions
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 transform"
                    x-transition:enter-end="opacity-100 scale-100 transform"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100 transform"
                    x-transition:leave-end="opacity-0 scale-95 transform"
                    class="absolute z-50 mt-2 w-48 rounded-lg shadow-xl overflow-hidden glass nav-dropdown-menu"
                    style="display: none;">
                    <div class="py-1">
                        <a href="/solutions"
                            class="dropdown-item block px-4 py-2 text-sm hover:bg-red-900/50 transition-colors">Solutions
                            Overview</a>
                        <a href="{{ route('solutions.category', ['category' => 'service']) }}"
                            class="dropdown-item block px-4 py-2 text-sm hover:bg-red-900/50 transition-colors">Services</a>
                        <a href="{{ route('solutions.category', ['category' => 'infrastructure']) }}"
                            class="dropdown-item block px-4 py-2 text-sm hover:bg-red-900/50 transition-colors">Solutions</a>
                        <a href="{{ route('solutions.category', ['category' => 'product']) }}"
                            class="dropdown-item block px-4 py-2 text-sm hover:bg-red-900/50 transition-colors">Products</a>
                    </div>
                </div>
            </li>
            <li><a href="/contact" class="nav-link hover:text-red-400 transition-colors">Contact</a></li>
        </ul>
        {{-- @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a wire:navigate href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a wire:navigate href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a wire:navigate href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif --}}
        <!-- Login Button -->

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/admin') }}" class="btn-primary hidden lg:inline-block">
                    <span class="relative z-10">Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate class="btn-primary hidden lg:inline-block">
                    <span class="relative z-10">Login</span>
                </a>
            @endauth
        @endif


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
