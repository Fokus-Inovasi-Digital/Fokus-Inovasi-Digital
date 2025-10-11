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
                            <div class="text-gray-400">anto@fokusinovasidigital.com</div>
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