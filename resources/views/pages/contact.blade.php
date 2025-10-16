<x-landing-layout>
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/20 to-black"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6 animate-blur-in">
                Ready to Take the <span class="gradient-text">Next Step</span>?
            </h2>
            <p class="text-xl md:text-2xl text-gray-400 mb-10 max-w-4xl mx-auto animate-blur-in">
                Let's turn your vision into a powerful digital solution. We're here to help you with all your
                digital transformation needs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                <a href="#contact" class="btn-primary text-lg px-8 py-3">
                    <span class="relative z-10">Get Started</span>
                </a>
                <a href="/solutions"
                    class="border border-gray-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-all">
                    View Solutions
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Partners</span>
                </h2>
            </div>
            <div x-data="{}" x-init="$nextTick(() => {
                let ul = $refs.logos;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
                class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <ul x-ref="logos"
                    class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">

                    @foreach ($partners as $partner)
                        <li>
                            <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                                data-bs-toggle="modal" data-bs-target="#partnerModal{{ $partner->id }}"
                                aria-label="Lihat detail {{ $partner->name }}">
                                {{-- <img src="{{ $partner->logo ? asset("storage/{$partner->logo}") : asset('assets/default-img.jpg') }}"
                                    alt="{{ $partner->name }}" class="w-20 h-20 object-contain p-2"> --}}
                                <div
                                    class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                                    <div class="text-2xl font-bold gradient-text">{{ $partner->name }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            {{-- <div class="partner-carousel overflow-hidden">
                <div class="flex space-x-12 animate-scroll">
                    @foreach ($partners as $partner)
                        <div
                            class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo">
                            <div class="text-2xl font-bold gradient-text">{{ $partner->name ?? '-' }}</div>
                    @endforeach
                </div>
            </div> --}}
        </div>
        {{-- </div> --}}
    </section>

    <section id="contact" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Get In <span class="gradient-text">Touch</span>
                </h2>
            </div>
            <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <div class="animate-blur-in">
                    <h3 class="text-2xl font-bold mb-6">Let's Build Something Amazing Together</h3>
                    <p class="text-gray-400 mb-8">Ready to transform your business with cutting-edge digital
                        solutions? Contact us today to discuss your project.</p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Email</div>
                                <div class="text-gray-400">{{ $companyProfile->email ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Phone</div>
                                <div class="text-gray-400">{{ $companyProfile->phone ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11c1.105 0 2-.672 2-1.5S13.105 8 12 8s-2 .672-2 1.5S10.895 11 12 11z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21s8-4.5 8-10a8 8 0 1 0-16 0c0 5.5 8 10 8 10z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Location</div>
                                <div class="text-gray-400">{{ $companyProfile->address ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass rounded-xl p-8 animate-blur-in">
                    @if (session('success'))
                        <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-6"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->has('error'))
                        <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative mb-6"
                            role="alert">
                            <strong class="font-bold">Limit Reached!</strong>
                            <span class="block sm:inline">{{ $errors->first('error') }}</span>
                        </div>
                    @endif

                    <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    @class([
                                        'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                        'border-red-500' => $errors->has('name'),
                                        'border-gray-600' => !$errors->has('name'),
                                    ])>
                                @error('name')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    required @class([
                                        'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                        'border-red-500' => $errors->has('email'),
                                        'border-gray-600' => !$errors->has('email'),
                                    ])>
                                @error('email')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium mb-2">Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    @class([
                                        'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                        'border-red-500' => $errors->has('phone'),
                                        'border-gray-600' => !$errors->has('phone'),
                                    ])>
                                @error('phone')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="company" class="block text-sm font-medium mb-2">company</label>
                                <input type="text" id="company" name="company" value="{{ old('company') }}"
                                    @class([
                                        'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                        'border-red-500' => $errors->has('company'),
                                        'border-gray-600' => !$errors->has('company'),
                                    ])>
                                @error('company')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium mb-2">Subject *</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                    @class([
                                        'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                        'border-red-500' => $errors->has('subject'),
                                        'border-gray-600' => !$errors->has('subject'),
                                    ])>
                                @error('subject')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium mb-2">Message *</label>
                                <textarea id="message" name="message" rows="4" @class([
                                    'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none resize-vertical',
                                    'border-red-500' => $errors->has('message'),
                                    'border-gray-600' => !$errors->has('message'),
                                ])>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-red-400 text-sm mt-1" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary w-full text-lg py-3">
                                <span class="relative z-10">Send Message</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>
