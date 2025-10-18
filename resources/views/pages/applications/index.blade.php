<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Job Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Table displaying submitted job applications --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Position
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Applied On
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($applications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- Get the job title from the related 'career' and make it a link --}}
                                            <a href="{{ route('userApply.show', $application->id . '-' . Str::slug($application->full_name) . '-' . Str::slug($application->career->title)) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                {{ $application->career->title ?? 'Position Deleted' }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->created_at->format('F d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{-- Status badge with color based on application status --}}
                                            <span @class([
                                                'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                'bg-yellow-100 text-yellow-800' => $application->status == 'pending',
                                                'bg-green-100 text-green-800' => $application->status == 'reviewed',
                                                // 'bg-red-100 text-red-800' => $application->status == 'rejected', // Uncomment if needed
                                            ])>
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            You haven't submitted any job applications yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
