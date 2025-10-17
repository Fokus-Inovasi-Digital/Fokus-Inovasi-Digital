<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4 max-w-4xl">
            @if (session('success'))
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-6"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative mb-6"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-4xl md:text-6xl font-bold mb-4 gradient-text">{{ $career->title }}</h1>
            <p class="text-lg text-gray-400 mb-8">{{ $career->location }} - {{ ucfirst($career->work_type) }}</p>

            <div class="prose prose-invert lg:prose-xl max-w-none mx-auto">
                {!! $career->description !!}
            </div>

            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-4">Apply for this position</h2>
                <p class="text-gray-500 mb-6">
                    Interested in this opportunity? Click the button below to submit your application.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                    <a href="{{ route('careers.apply.create', $career) }}" class="btn-primary text-lg px-8 py-3">
                        <span class="relative z-10">Apply Now</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>
