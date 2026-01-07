@extends('layouts.app')

@section('header_title', 'Daftar Project')

@section('content')
<div class="flex flex-col">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Manajemen Project</h2>
            <p class="text-sm text-gray-500 text-sm">Pantau perkembangan pekerjaan Anda di sini.</p>
        </div>

        @if(auth()->user()->hasRole('customer'))
        <a href="{{ route('app.projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Project Baru
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm rounded-r-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">Informasi Project</th>
                        <th class="px-6 py-4">Partner</th>
                        <th class="px-6 py-4">Budget & Deadline</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 italic">
                    @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $project->title }}</div>
                            <div class="text-xs text-gray-400">ID: {{ substr($project->id, 0, 8) }}...</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="h-7 w-7 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ auth()->user()->hasRole('brand') ? $project->client->name : ($project->brand->name ?? 'Open') }}" alt="">
                                <div class="text-sm font-medium text-gray-700">
                                    {{ auth()->user()->hasRole('brand') ? $project->client->name : ($project->brand->name ?? 'Mencari Brand...') }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">IDR {{ number_format($project->budget, 0, ',', '.') }}</div>
                            <div class="text-xs text-red-500 font-medium italic">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'active' => 'bg-blue-100 text-blue-700',
                            'completed' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                            ];
                            $color = $statusColors[$project->project_status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $color }}">
                                {{ strtoupper($project->project_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('app.projects.show', $project->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">
                                Manage
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span class="text-gray-400 italic">Belum ada project ditemukan.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $projects->links() }}
        </div>
        @endif
    </div>
</div>
@endsection