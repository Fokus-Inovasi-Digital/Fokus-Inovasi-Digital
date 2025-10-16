<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Join <span class="gradient-text">Our Team</span>
                </h2>
                <p class="text-gray-400">Explore exciting career opportunities and be part of our growing company.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($careers as $career)
                    <div class="glass p-6 rounded-xl hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-bold mb-2">{{ $career->title }}</h3>
                        <p class="text-gray-400">{{ $career->location }} - {{ ucfirst($career->work_type) }}</p>
                        <a href="{{ route('careers.show', $career->slug) }}"
                            class="text-red-500 mt-4 inline-block font-semibold hover:underline">
                            View Details & Apply
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">There are currently no open positions.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-landing-layout>