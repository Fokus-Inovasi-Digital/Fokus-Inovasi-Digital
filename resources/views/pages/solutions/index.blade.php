<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Our <span class="gradient-text">Solutions</span>
                </h2>
                <p class="text-gray-400">Explore our comprehensive range of services, products, and infrastructures.</p>
            </div>

            @foreach ($groupedSolutions as $category => $solutions)
                <div class="mb-12">
                    <h3 class="text-3xl font-bold mb-6 border-l-4 border-red-500 pl-4">
                        {{ ucfirst($category) }}
                    </h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($solutions as $solution)
                            <a href="{{ route('solutions.show', ['category' => $solution->category_slug, 'solution' => $solution->slug]) }}">
                                <div class="glass p-6 rounded-xl hover:shadow-lg transition-shadow">
                                    <h4 class="text-xl font-bold mb-2">{{ $solution->title }}</h4>
                                    <p class="text-gray-400">{{ $solution->short_description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-landing-layout>
