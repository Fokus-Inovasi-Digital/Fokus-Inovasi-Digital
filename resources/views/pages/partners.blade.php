<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Meet Our <span class="gradient-text">Partners</span>
                </h2>
                <p class="text-gray-400">We collaborate with trusted partners to build better solutions together.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($partners as $partner)
                    <div class="glass p-6 rounded-xl hover:shadow-lg transition-shadow cursor-pointer" x-data
                        @click="$dispatch('open-modal', {
                            name: '{{ $partner->name }}',
                            description: @js($partner->description),
                            logo: '{{ $partner->logo }}',
                            website: '{{ $partner->website_url }}'
                        })">
                        <div class="flex items-center space-x-4">
                            @if ($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                    class="w-12 h-12 object-contain rounded-full">
                            @endif
                            <h3 class="text-xl font-bold">{{ $partner->name }}</h3>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">There are currently no Partners.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div x-data="{ show: false, data: {} }" x-on:open-modal.window="data = $event.detail; show = true" x-show="show" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.away="show = false" class="max-w-lg w-full rounded-xl p-6 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-50" x-text="data.name"></h2>
                <button @click="show = false" class="text-gray-500 hover:text-red-500 text-xl">&times;</button>
            </div>

            <div class="mb-4">
                <template x-if="data.logo">
                    <img :src="'/storage/' + data.logo" :alt="data.name"
                        class="w-24 h-24 object-contain rounded mb-4">
                </template>
                <p class="text-gray-100" x-text="data.description"></p>
            </div>

            <template x-if="data.website">
                <a :href="data.website" target="_blank" class="text-red-500 font-semibold hover:underline">Visit
                    Website</a>
            </template>
        </div>
    </div>
</x-landing-layout>
