<x-landing-layout>
    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/20 to-black"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-6xl md:text-8xl font-bold mb-6 animate-blur-in">
                <span class="gradient-text">Digital</span>
                <br>Innovation
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-8 max-w-3xl mx-auto animate-blur-in">
                <span class="letter-animate">W</span><span class="letter-animate">e</span>
                <span class="letter-animate">c</span><span class="letter-animate">r</span><span
                    class="letter-animate">e</span><span class="letter-animate">a</span><span
                    class="letter-animate">t</span><span class="letter-animate">e</span>
                <span class="letter-animate">m</span><span class="letter-animate">o</span><span
                    class="letter-animate">d</span><span class="letter-animate">e</span><span
                    class="letter-animate">r</span><span class="letter-animate">n</span>
                <span class="letter-animate">d</span><span class="letter-animate">i</span><span
                    class="letter-animate">g</span><span class="letter-animate">i</span><span
                    class="letter-animate">t</span><span class="letter-animate">a</span><span
                    class="letter-animate">l</span>
                <span class="letter-animate">s</span><span class="letter-animate">o</span><span
                    class="letter-animate">l</span><span class="letter-animate">u</span><span
                    class="letter-animate">t</span><span class="letter-animate">i</span><span
                    class="letter-animate">o</span><span class="letter-animate">n</span><span
                    class="letter-animate">s</span>
                <span class="letter-animate">t</span><span class="letter-animate">h</span><span
                    class="letter-animate">a</span><span class="letter-animate">t</span>
                <span class="letter-animate">t</span><span class="letter-animate">r</span><span
                    class="letter-animate">a</span><span class="letter-animate">n</span><span
                    class="letter-animate">s</span><span class="letter-animate">f</span><span
                    class="letter-animate">o</span><span class="letter-animate">r</span><span
                    class="letter-animate">m</span>
                <span class="letter-animate">b</span><span class="letter-animate">u</span><span
                    class="letter-animate">s</span><span class="letter-animate">i</span><span
                    class="letter-animate">n</span><span class="letter-animate">e</span><span
                    class="letter-animate">s</span><span class="letter-animate">s</span><span
                    class="letter-animate">e</span><span class="letter-animate">s</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-blur-in">
                <button class="btn-primary text-lg px-8 py-3" onclick="scrollToSection('contact')">
                    <span class="relative z-10">Get Started</span>
                </button>
                <button
                    class="border border-gray-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-all">
                    View Portfolio
                </button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    About <span class="gradient-text">Us</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto animate-blur-in">
                    PT Fokus Inovasi Digital is a leading technology company specializing in cutting-edge digital
                    solutions that drive business transformation and growth.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mt-16">
                <div class="glass rounded-xl p-8 animate-blur-in">
                    <div class="text-4xl mb-4">🎯</div>
                    <h3 class="text-2xl font-bold mb-4">Mission</h3>
                    <p class="text-gray-400">To deliver innovative digital solutions that empower businesses to
                        achieve their full potential in the digital age.</p>
                </div>
                <div class="glass rounded-xl p-8 animate-blur-in">
                    <div class="text-4xl mb-4">👁️</div>
                    <h3 class="text-2xl font-bold mb-4">Vision</h3>
                    <p class="text-gray-400">To be the leading digital transformation partner, recognized for
                        excellence and innovation in technology solutions.</p>
                </div>
                <div class="glass rounded-xl p-8 animate-blur-in">
                    <div class="text-4xl mb-4">⭐</div>
                    <h3 class="text-2xl font-bold mb-4">Values</h3>
                    <p class="text-gray-400">Innovation, integrity, excellence, and customer-centricity drive
                        everything we do.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Services</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in"
                    onclick="openModal('serviceModal')">
                    <div class="text-5xl mb-6">💻</div>
                    <h3 class="text-2xl font-bold mb-4">Web Development</h3>
                    <p class="text-gray-400">Modern, responsive websites and web applications built with
                        cutting-edge technologies.</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">📱</div>
                    <h3 class="text-2xl font-bold mb-4">Mobile Apps</h3>
                    <p class="text-gray-400">Native and cross-platform mobile applications for iOS and Android.</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">☁️</div>
                    <h3 class="text-2xl font-bold mb-4">Cloud Solutions</h3>
                    <p class="text-gray-400">Scalable cloud infrastructure and migration services for modern
                        businesses.</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">🤖</div>
                    <h3 class="text-2xl font-bold mb-4">AI & ML</h3>
                    <p class="text-gray-400">Artificial intelligence and machine learning solutions for data-driven
                        insights.</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">🔒</div>
                    <h3 class="text-2xl font-bold mb-4">Cybersecurity</h3>
                    <p class="text-gray-400">Comprehensive security solutions to protect your digital assets.</p>
                </div>
                <div class="glass rounded-xl p-8 hover:bg-white/5 transition-all cursor-pointer animate-blur-in">
                    <div class="text-5xl mb-6">📊</div>
                    <h3 class="text-2xl font-bold mb-4">Analytics</h3>
                    <p class="text-gray-400">Business intelligence and analytics platforms for informed decision
                        making.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Portfolio</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-red-500 to-black"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">E-Commerce Platform</h3>
                        <p class="text-gray-400">Modern e-commerce solution with advanced features</p>
                    </div>
                </div>
                <div class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-blue-500 to-black"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Banking App</h3>
                        <p class="text-gray-400">Secure mobile banking application</p>
                    </div>
                </div>
                <div class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-green-500 to-black"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">IoT Dashboard</h3>
                        <p class="text-gray-400">Real-time IoT monitoring dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Our <span class="gradient-text">Partners</span>
                </h2>
            </div>

            <div class="partner-carousel overflow-hidden">
                <div class="flex space-x-12 animate-scroll">
                    <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                        onclick="openPartnerModal('Partner 1', 'Technology partner specializing in cloud solutions.')">
                        <div class="text-2xl font-bold gradient-text">TECH</div>
                    </div>
                    <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                        onclick="openPartnerModal('Partner 2', 'Financial services integration partner.')">
                        <div class="text-2xl font-bold gradient-text">BANK</div>
                    </div>
                    <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                        onclick="openPartnerModal('Partner 3', 'Cloud infrastructure and security partner.')">
                        <div class="text-2xl font-bold gradient-text">CLOUD</div>
                    </div>
                    <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                        onclick="openPartnerModal('Partner 4', 'AI and machine learning solutions partner.')">
                        <div class="text-2xl font-bold gradient-text">AI</div>
                    </div>
                    <div class="flex-shrink-0 w-32 h-32 glass rounded-xl flex items-center justify-center cursor-pointer partner-logo"
                        onclick="openPartnerModal('Partner 5', 'Digital marketing and analytics partner.')">
                        <div class="text-2xl font-bold gradient-text">MARK</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-blur-in">
                    Latest <span class="gradient-text">Articles</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer"
                    onclick="openBlogModal('The Future of AI', 'Exploring how artificial intelligence is reshaping industries and creating new opportunities for businesses worldwide.')">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-black"></div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">March 15, 2024</div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-red-400 transition-colors">The Future of
                            AI in Business</h3>
                        <p class="text-gray-400">Exploring how artificial intelligence is reshaping industries...
                        </p>
                    </div>
                </article>
                <article class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer"
                    onclick="openBlogModal('Cloud Migration', 'A comprehensive guide to successful cloud migration strategies and best practices for modern enterprises.')">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-black"></div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">March 10, 2024</div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-red-400 transition-colors">Cloud
                            Migration Best Practices</h3>
                        <p class="text-gray-400">A comprehensive guide to successful cloud migration...</p>
                    </div>
                </article>
                <article class="glass rounded-xl overflow-hidden animate-blur-in group cursor-pointer"
                    onclick="openBlogModal('Cybersecurity', 'Essential cybersecurity measures every business should implement to protect against modern threats.')">
                    <div class="h-48 bg-gradient-to-br from-red-500 to-black"></div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">March 5, 2024</div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-red-400 transition-colors">Cybersecurity
                            in 2024</h3>
                        <p class="text-gray-400">Essential security measures for modern businesses...</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
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
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">📧
                            </div>
                            <div>
                                <div class="font-semibold">Email</div>
                                <div class="text-gray-400">info@fokusinovasi.com</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">📱
                            </div>
                            <div>
                                <div class="font-semibold">Phone</div>
                                <div class="text-gray-400">+62 21 1234 5678</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">📍
                            </div>
                            <div>
                                <div class="font-semibold">Location</div>
                                <div class="text-gray-400">Jakarta, Indonesia</div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="contactForm" class="glass rounded-xl p-8 animate-blur-in" novalidate>
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">Name *</label>
                            <input type="text" id="name" name="name" required
                                class="w-full p-3 bg-black/30 border border-gray-600 rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none"
                                aria-describedby="name-error">
                            <div id="name-error" class="text-red-400 text-sm mt-1 hidden" role="alert"></div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Email *</label>
                            <input type="email" id="email" name="email" required
                                class="w-full p-3 bg-black/30 border border-gray-600 rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none"
                                aria-describedby="email-error">
                            <div id="email-error" class="text-red-400 text-sm mt-1 hidden" role="alert"></div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium mb-2">Subject</label>
                            <input type="text" id="subject" name="subject"
                                class="w-full p-3 bg-black/30 border border-gray-600 rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">Message *</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full p-3 bg-black/30 border border-gray-600 rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none resize-vertical"
                                aria-describedby="message-error"></textarea>
                            <div id="message-error" class="text-red-400 text-sm mt-1 hidden" role="alert">
                            </div>
                        </div>
                        <button type="submit" class="btn-primary w-full text-lg py-3">
                            <span class="relative z-10">Send Message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-landing-layout>
