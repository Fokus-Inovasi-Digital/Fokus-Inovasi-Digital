<x-landing-layout>
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/20 to-black"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6 animate-blur-in">
                Ready to Take the <span class="gradient-text">Next Step</span>?
            </h2>
            <p class="text-xl md:text-2xl text-gray-400 mb-10 max-w-4xl mx-auto animate-blur-in">
                Let's turn your vision into a powerful digital solution. We're here to help you with all your
                digital transformation needs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                <a href="#contact" class="btn-primary text-lg px-8 py-3">
                    <span class="relative z-10">Get Started</span>
                </a>
                <a href="/solutions"
                    class="border border-gray-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-all">
                    View Projects
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Partners</span>
                </h2>
            </div>

            <div class="partner-carousel overflow-hidden">
                <div class="flex space-x-12 animate-scroll">
                    <div
                        class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                        <div class="text-2xl font-bold gradient-text">TECH</div>
                    </div>
                    <div
                        class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                        <div class="text-2xl font-bold gradient-text">BANK</div>
                    </div>
                    <div
                        class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                        <div class="text-2xl font-bold gradient-text">CLOUD</div>
                    </div>
                    <div
                        class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                        <div class="text-2xl font-bold gradient-text">AI</div>
                    </div>
                    <div
                        class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                        <div class="text-2xl font-bold gradient-text">MARK</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.partials.contact-section')
</x-landing-layout>
