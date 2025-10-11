<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Fokus Inovasi Digital — IT Solutions' }}</title>
    <meta name="description"
        content="PT Fokus Inovasi Digital — delivering modern digital products, services and solutions. Explore our products, latest articles, partners, and career opportunities.">

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
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
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
            <div class="preloader-logo">Fokus ID</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>
    </div>

    @include('layouts.partials.navbar')

    <main class="main-content">
        {{ $slot }}
    </main>

    @include('layouts.partials.footer')

    @livewireScripts
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
