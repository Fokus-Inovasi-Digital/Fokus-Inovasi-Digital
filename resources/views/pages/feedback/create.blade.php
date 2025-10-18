<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="mb-4 text-gray-600">
                        Have suggestions, complaints, or found a bug? Let us know!
                    </p>

                    {{-- Show success message if available --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('feedback.store') }}" class="space-y-6">
                        @csrf

                        {{-- Feedback Type --}}
                        <div>
                            <x-input-label for="type" :value="__('Feedback Type')" />
                            <select id="type" name="type"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="" disabled selected>-- Select Type --</option>
                                @foreach ($types as $key => $label)
                                    {{-- Retain old selection if validation fails --}}
                                    <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        {{-- Subject --}}
                        <div>
                            <x-input-label for="subject" :value="__('Subject / Short Title')" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                                :value="old('subject')" required autofocus />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        {{-- Message --}}
                        <div>
                            <x-input-label for="message" :value="__('Your Message')" />
                            <textarea id="message" name="message" rows="5"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit Feedback') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
