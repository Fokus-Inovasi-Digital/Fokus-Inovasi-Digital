<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    @if (isset($currentCategory))
                        {{ ucfirst($currentCategory) }} <span class="gradient-text">News</span>
                    @else
                        All <span class="gradient-text">Articles</span>
                    @endif
                </h2>
                <p class="text-gray-400">Dive into our collection of up-to-date articles, company news, and events.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($articles as $article)
                    <a href="{{ route('articles.show', ['category' => $article->category, 'article' => $article->slug]) }}"
                        class="block">
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
                        <p class="text-xl text-gray-500">Tidak ada artikel yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
</x-landing-layout>
