<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text">
            Fokus ID
        </a>

        <ul class="desktop-nav hidden md:flex space-x-8 font-medium">
            <li><a href="{{ route('home') }}" @class([
                'nav-link',
                'hover:text-red-400',
                'transition-colors',
                'text-red-400' => Route::is('home'),
            ])>Home</a></li>
            <li><a href="{{ route('about') }}" @class([
                'nav-link',
                'hover:text-red-400',
                'transition-colors',
                'text-red-400' => Route::is('about'),
            ])>About Us</a></li>
            <li><a href="{{ route('articles.index') }}" @class([
                'nav-link',
                'hover:text-red-400',
                'transition-colors',
                'text-red-400' => Route::is('articles.*'),
            ])>News</a>
            </li>
            <li class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button @class([
                    'nav-link',
                    'font-medium',
                    'flex',
                    'items-center',
                    'hover:text-red-400',
                    'transition-colors',
                    'focus:outline-none',
                    'text-red-400' => Route::is('solutions.*'),
                ]) :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true">
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
                        <a href="{{ route('solutions.index') }}" @class([
                            'dropdown-item',
                            'block',
                            'px-4',
                            'py-2',
                            'text-sm',
                            'hover:bg-red-900/50',
                            'transition-colors',
                            'bg-red-900/50' => Route::is('solutions.index'),
                        ])>Solutions
                            Overview</a>
                        <a href="{{ route('solutions.category', ['category' => 'services']) }}"
                            @class([
                                'dropdown-item',
                                'block',
                                'px-4',
                                'py-2',
                                'text-sm',
                                'hover:bg-red-900/50',
                                'transition-colors',
                                'bg-red-900/50' =>
                                    Route::is('solutions.category') && request('category') == 'services',
                            ])>Services</a>
                        <a href="{{ route('solutions.category', ['category' => 'infrastructures']) }}"
                            @class([
                                'dropdown-item',
                                'block',
                                'px-4',
                                'py-2',
                                'text-sm',
                                'hover:bg-red-900/50',
                                'transition-colors',
                                'bg-red-900/50' =>
                                    Route::is('solutions.category') &&
                                    request('category') == 'infrastructures',
                            ])>Infrastructures</a>
                        <a href="{{ route('solutions.category', ['category' => 'products']) }}"
                            @class([
                                'dropdown-item',
                                'block',
                                'px-4',
                                'py-2',
                                'text-sm',
                                'hover:bg-red-900/50',
                                'transition-colors',
                                'bg-red-900/50' =>
                                    Route::is('solutions.category') && request('category') == 'products',
                            ])>Products</a>
                    </div>
                </div>
            </li>
            <li><a href="{{ route('contact.create') }}" @class([
                'nav-link',
                'hover:text-red-400',
                'transition-colors',
                'text-red-400' => Route::is('contact.create'),
            ])>Contact</a></li>
        </ul>

        @if (Route::has('login'))
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? '/admin' : '/dashboard' }}"
                    class="btn-primary hidden lg:inline-block">
                    <span class="relative z-10">Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate class="btn-primary hidden lg:inline-block">
                    <span class="relative z-10">Login</span>
                </a>
            @endauth
        @endif

        <div class="hamburger md:hidden" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu" role="button"
            tabindex="0" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Mobile navigation">
    <div class="flex flex-col items-center justify-center h-full space-y-8 text-2xl">

        <a href="{{ route('home') }}" @class(['nav-link', 'text-red-400' => Route::is('home')]) onclick="toggleMobileMenu()">Home</a>
        <a href="{{ route('about') }}" @class(['nav-link', 'text-red-400' => Route::is('about')]) onclick="toggleMobileMenu()">About Us</a>
        <a href="{{ route('articles.index') }}" @class(['nav-link', 'text-red-400' => Route::is('articles.*')]) onclick="toggleMobileMenu()">News</a>
        <a href="{{ route('solutions.index') }}" @class(['nav-link', 'text-red-400' => Route::is('solutions.*')])
            onclick="toggleMobileMenu()">Solutions</a>
        <a href="{{ route('contact.create') }}" @class(['nav-link', 'text-red-400' => Route::is('contact.create')]) onclick="toggleMobileMenu()">Contact</a>
        @if (Route::has('login'))
            @auth
                @if (auth()->user()->role == 'admin')
                    <a href="/admin" class="nav-link" onclick="toggleMobileMenu()">Admin Dashboard</a>
                @else
                    <a href="/dashboard" wire:navigate class="nav-link" onclick="toggleMobileMenu()">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" wire:navigate class="nav-link" onclick="toggleMobileMenu()">Login</a>
            @endauth
        @endif
    </div>
</div>
