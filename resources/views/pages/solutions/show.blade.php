<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 gradient-text">{{ $solution->title }}</h1>
            <p class="text-lg text-gray-400 mb-8">{{ $solution->short_description }}</p>

            <div class="prose prose-invert max-w-none text-gray-300">
                {!! $solution->content !!}
            </div>
        </div>
    </section>
</x-landing-layout>
