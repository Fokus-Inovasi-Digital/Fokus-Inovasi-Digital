<x-landing-layout>
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/20 to-black"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-6xl md:text-8xl font-bold mb-6 animate-blur-in">
                <span class="gradient-text">{{ $p1 }}</span>
                @if (!empty($p2))
                    <br>{{ $p2 }}
                @endif
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-8 max-w-3xl mx-auto animate-blur-in">
                <span class="letter-animate">{{ $company->hero_subheading ?? 'Description isn\'t provided yet' }}</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                <a href="#cta" class="btn-primary text-lg px-8 py-3">
                    <span class="relative z-10">Get Started</span>
                </a>
                <a href="/solutions"
                    class="border border-gray-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-all">
                    View Solutions
                </a>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    About <span class="gradient-text">Us</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto animate-blur-in">
                    {{ $company->about_subheading }}
                </p>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Solutions</span>
                </h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">☁️</div>
                    <h3 class="text-2xl font-bold mb-4">Products</h3>
                    <p class="text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi doloremque
                        tempore ab eius dolorem officia harum itaque rerum, accusamus dolor enim eveniet beatae totam
                        molestias sint voluptate officiis incidunt pariatur!</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">🔒</div>
                    <h3 class="text-2xl font-bold mb-4">Services</h3>
                    <p class="text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit
                        aut, sapiente ratione animi aliquid id eius. Perspiciatis itaque libero voluptates, reiciendis
                        repellendus temporibus iusto debitis maxime. Nostrum, maxime non?</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">📊</div>
                    <h3 class="text-2xl font-bold mb-4">Infrastructure</h3>
                    <p class="text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
                        distinctio nam quod voluptate quasi excepturi iste aspernatur repellendus molestiae? Corrupti
                        fuga id consectetur beatae ab. Hic doloribus iusto iste nobis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    {{-- <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Partners</span>
                </h2>
            </div>
            <div x-data="{}" x-init="$nextTick(() => {
                let ul = $refs.logos;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
                class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <ul x-ref="logos"
                    class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">

                    @foreach ($partners as $partner)
                        <li>
                            <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                                data-bs-toggle="modal" data-bs-target="#partnerModal{{ $partner->id }}"
                                aria-label="Lihat detail {{ $partner->name }}">
                                <img src="{{ $partner->logo ? asset("storage/{$partner->logo}") : asset('assets/default-img.jpg') }}"
                                    alt="{{ $partner->name }}" class="w-20 h-20 object-contain p-2">
                                <div
                                    class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                                    <div class="text-2xl font-bold gradient-text">{{ $partner->name }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section> --}}

    <!-- Articles Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Latest <span class="gradient-text">Articles</span>
                </h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="block">
                        <article class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer">
                            <img src="{{ $article->image ? asset("storage/{$article->image}") : asset('assets/default-img.jpg') }}"
                                alt="{{ $article->title }}" class="h-48 w-full object-cover" loading="lazy">
                            <div class="p-6">
                                <p class="text-sm text-gray-400 mb-2">{{ $article->published_at->format('F d, Y') }}
                                </p>
                                <h3 class="text-xl font-bold mb-2 group-hover:text-red-400 transition-colors">
                                    {{ $article->title }}</h3>
                                <p class="text-gray-400">{{ Str::limit(strip_tags($article->content), 97) }}</p>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section id="cta" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Empower Your <span class="gradient-text">Business</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto mb-8 animate-blur-in">
                    Secure, scalable solutions to help your business thrive in the digital world.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                    <a href="/contact" class="btn-primary text-lg px-8 py-3">
                        <span class="relative z-10">Get Started</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>
