<footer class="bg-black border-t border-gray-800">
    <div class="overflow-hidden border-t border-b border-gray-800 py-6 bg-black">
        <div class="marquee text-4xl font-extrabold uppercase tracking-tight md:text-6xl">
            <span class="gradient-text mx-12 md:mx-16 flex-shrink-0 cursor-pointer hover:text-red-400 transition-colors">
                {{ $companyProfile->quote ?? '' }}
            </span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 gradient-text">{{ $companyProfile->company_name ?? '-' }}</h3>
                <p class="text-gray-400 mb-4">{{ $companyProfile->hero_subheading ?? '-' }}</p>
                <div class="flex space-x-4">
                    @if (!empty($companyProfile->social_media))
                        @foreach ($companyProfile->social_media as $social)
                            <a href="{{ $social['url'] }}" target="_blank"
                                class="text-gray-400 hover:text-red-400 transition-colors">
                                {{ ucfirst($social['platform']) }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Solutions</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('solutions.category', ['category' => 'services']) }}"
                            class="hover:text-red-400 transition-colors">Services</a></li>
                    <li><a href="{{ route('solutions.category', ['category' => 'infrastructures']) }}"
                            class="hover:text-red-400 transition-colors">Infrastructures</a></li>
                    <li><a href="{{ route('solutions.category', ['category' => 'products']) }}"
                            class="hover:text-red-400 transition-colors">Products</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="/about" class="hover:text-red-400 transition-colors">About Us</a></li>
                    <li><a href="/careers" class="hover:text-red-400 transition-colors">Careers</a></li>
                    <li><a href="/articles" class="hover:text-red-400 transition-colors">News</a></li>
                    <li><a href="/partners" class="hover:text-red-400 transition-colors">Partners</a></li>
                    <li><a href="/contact" class="hover:text-red-400 transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-red-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-red-400 transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-red-400 transition-colors">Cookie Policy</a></li>
                </ul>
                {{-- <div class="mt-6">
                    <button id="animationToggle" onclick="toggleAnimations()"
                        class="text-sm text-gray-400 hover:text-red-400 transition-colors"
                        aria-label="Toggle animations">
                        Disable Animations
                    </button>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="border-t border-gray-800 py-6 text-center text-gray-400">
        <p>&copy; {{ date('Y') }} PT Fokus Inovasi Digital. All rights reserved.</p>
    </div>
</footer>
