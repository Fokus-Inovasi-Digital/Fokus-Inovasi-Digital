<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Our <span class="gradient-text">{{ ucfirst($category) }} Solutions</span>
                </h2>
                <p class="text-gray-400">Discover the solutions we provide in the {{ $category }} category.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($solutions as $solution)
                    <a
                        href="{{ route('solutions.show', ['category' => $solution->category_slug, 'solution' => $solution->slug]) }}">
                        <div class="glass p-6 rounded-xl hover:shadow-lg transition-shadow">
                            <h4 class="text-xl font-bold mb-2">{{ $solution->title }}</h4>
                            <p class="text-gray-400">{{ $solution->short_description }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-xl text-gray-500">No solutions found in this category yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $solutions->links() }}
            </div>
        </div>
    </section>
</x-landing-layout>
