<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Details: ') }} {{ $application->career->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Back Button --}}
                    <div class="mb-6">
                        <a href="{{ route('userApply.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            &larr; Back to Applications List
                        </a>
                    </div>

                    {{-- Grid to display application details --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Left Column: Applicant Info --}}
                        <div class="md:col-span-2 space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Applicant Information</h3>
                                <p class="mt-1 text-sm text-gray-600">The data you submitted during your application.
                                </p>
                            </div>

                            <dl class="divide-y divide-gray-200">
                                <div class="py-3 grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $application->full_name }}</dd>
                                </div>
                                <div class="py-3 grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $application->email }}</dd>
                                </div>
                                <div class="py-3 grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $application->phone }}</dd>
                                </div>
                                <div class="py-3 grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $application->address ?? '-' }}</dd>
                                </div>
                                <div class="py-3 grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Additional Notes</dt>
                                    <dd class="text-sm text-gray-900 col-span-2 whitespace-pre-line">
                                        {{ $application->additional_notes ?? '-' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Right Column: Status & Documents --}}
                        <div class="md:col-span-1 space-y-6">
                            {{-- Application Status --}}
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Application Status</h3>
                                <div class="mt-2">
                                    <span @class([
                                        'px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full',
                                        'bg-yellow-100 text-yellow-800' => $application->status == 'pending',
                                        'bg-green-100 text-green-800' => $application->status == 'reviewed',
                                    ])>
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    @if ($application->status == 'pending')
                                        Your application is currently awaiting review by the HR team.
                                    @else
                                        Your application has been reviewed.
                                    @endif
                                </p>
                            </div>

                            {{-- Attached Documents --}}
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Attached Documents</h3>
                                <ul class="mt-2 border border-gray-200 rounded-md divide-y divide-gray-200">
                                    {{-- CV File (Required) --}}
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                        <span class="font-medium">Curriculum Vitae (CV)</span>
                                        <a href="{{ Storage::url($application->cv_file) }}" target="_blank"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            View
                                        </a>
                                    </li>

                                    {{-- Cover Letter (Optional) --}}
                                    @if ($application->cover_letter_file)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <span class="font-medium">Cover Letter</span>
                                            <a href="{{ Storage::url($application->cover_letter_file) }}"
                                                target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                                Download
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Portfolio (Optional) --}}
                                    @if ($application->portfolio_file)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <span class="font-medium">Portfolio</span>
                                            <a href="{{ Storage::url($application->portfolio_file) }}" target="_blank"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Download
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
