<x-landing-layout>
    <section class="py-20 pt-40">
        <div class="container mx-auto px-4 max-w-2xl">
            <div class="text-center mb-10 animate-blur-in">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Apply for <span
                        class="gradient-text">{{ $career->title }}</span></h1>
                <p class="text-lg text-gray-400 mt-2">Please confirm your application details below.</p>
            </div>

            <div class="glass rounded-xl p-8 animate-blur-in">
                <form action="{{ route('careers.apply.store', $career) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">

                        <div>
                            <label for="full_name" class="block text-sm font-medium mb-2">Full Name *</label>
                            <input type="text" name="full_name" id="full_name"
                                value="{{ old('full_name', auth()->user()->name) }}" required
                                @class([
                                    'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('full_name'),
                                    'border-gray-600' => !$errors->has('full_name'),
                                ])>
                            @error('full_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Contact Email *</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', auth()->user()->email) }}" required @class([
                                    'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('email'),
                                    'border-gray-600' => !$errors->has('email'),
                                ])>
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium mb-2">Phone Number *</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', auth()->user()->phone) }}" required @class([
                                    'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('phone'),
                                    'border-gray-600' => !$errors->has('phone'),
                                ])>
                            @error('phone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cv_file" class="block text-sm font-medium mb-2">Curriculum Vitae (CV) *</label>
                            <input type="file" name="cv_file" id="cv_file" required accept=".pdf, .doc, .docx"
                                @class([
                                    'w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('cv_file'),
                                    'border-gray-600' => !$errors->has('cv_file'),
                                ])>
                            <p class="text-gray-500 text-xs mt-2">Required. Format: PDF, DOC, DOCX. Max 5MB.</p>
                            @error('cv_file')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cover_letter_file" class="block text-sm font-medium mb-2">Cover Letter</label>
                            <input type="file" name="cover_letter_file" id="cover_letter_file"
                                accept=".pdf, .doc, .docx" @class([
                                    'w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('cover_letter_file'),
                                    'border-gray-600' => !$errors->has('cover_letter_file'),
                                ])>
                            <p class="text-gray-500 text-xs mt-2">Optional.</p>
                            @error('cover_letter_file')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="portfolio_file" class="block text-sm font-medium mb-2">Portfolio</label>
                            <input type="file" name="portfolio_file" id="portfolio_file"
                                accept=".pdf, .doc, .docx, .ppt,.pptx" @class([
                                    'w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none',
                                    'border-red-500' => $errors->has('portfolio_file'),
                                    'border-gray-600' => !$errors->has('portfolio_file'),
                                ])>
                            <p class="text-gray-500 text-xs mt-2">Optional.</p>
                            @error('portfolio_file')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="additional_notes" class="block text-sm font-medium mb-2">Additional
                                Notes</label>
                            <textarea name="additional_notes" id="additional_notes" rows="4" @class([
                                'w-full p-3 bg-black/30 border rounded-lg focus:border-red-400 focus:ring-1 focus:ring-red-400 transition-all outline-none resize-vertical',
                                'border-red-500' => $errors->has('additional_notes'),
                                'border-gray-600' => !$errors->has('additional_notes'),
                            ])>{{ old('additional_notes') }}</textarea>
                            @error('additional_notes')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full text-lg py-3">
                            <span class="relative z-10">Submit Application</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-landing-layout>
