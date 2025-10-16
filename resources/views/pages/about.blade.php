<x-landing-layout>
    <section id="about" class="py-20 pt-40">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    About <span class="gradient-text">Fokus ID</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto animate-blur-in">
                    {{ $companyProfile->about_subheading }}
                </p>
            </div>

            <div class="text-center mb-16">
                <div>
                    <p class="text-xl text-gray-600 mb-6">{{ $companyProfile->description }}</p>

                    <p class="text-xl text-gray-600 mb-4"><strong>Vision:</strong> {{ $companyProfile->vision }}</p>
                    <p class="text-xl text-gray-600 mb-4"><strong>Mission:</strong> {{ $companyProfile->mission }}</p>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>
