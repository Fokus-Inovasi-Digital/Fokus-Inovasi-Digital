<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <article class="max-w-4xl mx-auto">
                <header class="mb-8 text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 gradient-text">{{ $article->title }}</h1>
                    <div class="text-gray-400 text-lg">
                        <span>By {{ $article->author->name }}</span>
                        <span class="mx-2">&bull;</span>
                        <span>{{ $article->published_at->format('F d, Y') }}</span>
                    </div>
                </header>

                <figure class="mb-8">
                    <img src="{{ $article->image ? asset("storage/{$article->image}") : asset('assets/default-img.jpg') }}" alt="{{ $article->title }}" loading="lazy"
                        class="w-full h-auto max-h-[500px] object-cover rounded-lg shadow-lg">
                </figure>

                <div class="prose prose-invert lg:prose-xl max-w-none mx-auto">
                    {!! $article->content !!}
                </div>
            </article>
            @if ($relatedArticles->isNotEmpty())
                <div class="max-w-6xl mx-auto mt-20 pt-10 border-t border-gray-700">
                    <h2 class="text-3xl font-bold text-center mb-8">Related Articles</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach ($relatedArticles as $related)
                            <a href="{{ route('articles.show', $related->slug) }}" class="block">
                                <article
                                    class="glass rounded-xl overflow-hidden group cursor-pointer h-full flex flex-col transition-transform duration-300 hover:-translate-y-2">
                                    <img src="{{ $related->image ? asset("storage/{$related->image}") : asset('assets/default-img.jpg') }}" alt="{{ $related->title }}"
                                        class="h-40 w-full object-cover">
                                    <div class="p-4 flex flex-col flex-grow">
                                        <h3
                                            class="text-lg font-bold group-hover:text-red-400 transition-colors flex-grow">
                                            {{ $related->title }}
                                        </h3>
                                    </div>
                                </article>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-landing-layout>
