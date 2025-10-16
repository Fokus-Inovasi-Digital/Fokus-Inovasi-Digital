<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 gradient-text">{{ $career->title }}</h1>
            <p class="text-lg text-gray-400 mb-8">{{ $career->location }} - {{ ucfirst($career->work_type) }}</p>

            <div class="prose max-w-none text-gray-700">
                {!! $career->description !!}
            </div>

            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-4">Apply for this position</h2>
                <p class="text-gray-500 mb-6">
                    Interested in this opportunity? Click the button below to submit your application.
                </p>
                <a href="#" onclick="alert('Under maintenance, please try again later.')"
                    class="inline-block bg-red-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-red-600 transition">
                    Apply Now
                </a>
            </div>
        </div>
    </section>
</x-landing-layout>
