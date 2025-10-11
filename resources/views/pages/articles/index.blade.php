<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    @if ($currentCategory)
                        {{ ucfirst($currentCategory === 'article' ? 'general' : $currentCategory) }} <span
                            class="gradient-text">News</span>
                    @else
                        Latest news from <span class="gradient-text">Fokus ID.</span>
                    @endif
                </h2>
                <p class="text-gray-400">Dive into our collection of up-to-date articles, company news, and events.</p>
            </div>

            <div class="flex justify-center items-center gap-2 md:gap-4 mb-12 animate-blur-in">
                <a href="{{ route('articles.index') }}"
                    class="px-4 py-2 rounded-lg text-sm md:text-base font-semibold transition-colors
                          {{ !request('category') ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    All
                </a>
                <a href="{{ route('articles.index', ['category' => 'article']) }}"
                    class="px-4 py-2 rounded-lg text-sm md:text-base font-semibold transition-colors
                          {{ request('category') == 'article' ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    General
                </a>
                <a href="{{ route('articles.index', ['category' => 'activity']) }}"
                    class="px-4 py-2 rounded-lg text-sm md:text-base font-semibold transition-colors
                          {{ request('category') == 'activity' ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    Activity
                </a>
                <a href="{{ route('articles.index', ['category' => 'csr']) }}"
                    class="px-4 py-2 rounded-lg text-sm md:text-base font-semibold transition-colors
                          {{ request('category') == 'csr' ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    CSR
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($articles as $article)
                    <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="block">
                        <article class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer">
                            <img src="{{ $article->image ? asset("storage/{$article->image}") : asset('assets/default-img.jpg') }}"
                                alt="{{ $article->title }}" class="h-48 w-full object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-400 mb-2">{{ $article->published_at->format('F d, Y') }}
                                </div>
                                <h3 class="text-xl font-bold mb-2 group-hover:text-red-400 transition-colors">
                                    {{ $article->title }}</h3>
                                <p class="text-gray-400">{{ Str::limit(strip_tags($article->content), 97) }}</p>
                            </div>
                        </article>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <p class="text-xl text-gray-500">Tidak ada artikel yang ditemukan untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
</x-landing-layout>
