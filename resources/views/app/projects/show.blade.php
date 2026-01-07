@extends('layouts.app')

@section('header_title', 'Project Detail')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-indigo-50 rounded-lg">
                <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">{{ $project->title }}</h1>
                <p class="text-sm text-gray-500">Status: <span class="font-bold uppercase text-indigo-600">{{ $project->project_status }}</span></p>
            </div>
        </div>

        <div class="flex space-x-3">
            @if(auth()->user()->hasRole('brand') && $project->project_status === 'pending')
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold text-sm hover:bg-indigo-700">Terima Project</button>
            @endif

            @if(auth()->user()->hasRole('customer') && $project->project_status === 'completed' && !$project->review)
            <a href="#" class="px-4 py-2 bg-yellow-500 text-white rounded-lg font-bold text-sm hover:bg-yellow-600 text-center">Beri Rating</a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Deskripsi Project</h3>
                <p class="text-gray-600 leading-relaxed">{{ $project->description }}</p>

                <div class="mt-8 grid grid-cols-2 gap-4 border-t pt-6">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Budget</p>
                        <p class="text-lg font-bold text-gray-900">IDR {{ number_format($project->budget) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Deadline</p>
                        <p class="text-lg font-bold text-red-600">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between">
                    <h3 class="font-bold text-gray-800">Deliverables (Hasil Kerja)</h3>
                    @if(auth()->user()->hasRole('brand') && $project->project_status === 'active')
                    <button class="text-sm text-indigo-600 font-bold hover:underline">+ Upload File</button>
                    @endif
                </div>
                <div class="p-8 text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-400 text-sm italic">Belum ada file yang diunggah.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-bold text-gray-400 uppercase mb-4">
                    {{ auth()->user()->hasRole('brand') ? 'Informasi Client' : 'Informasi Brand' }}
                </h3>
                <div class="flex items-center space-x-4">
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->hasRole('brand') ? $project->client->name : ($project->brand->name ?? 'Open') }}" alt="">
                    <div>
                        <p class="font-bold text-gray-900">{{ auth()->user()->hasRole('brand') ? $project->client->name : ($project->brand->name ?? 'TBD') }}</p>
                        <p class="text-xs text-gray-500 italic">Member sejak {{ $project->created_at->format('Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-600 p-6 rounded-xl shadow-md text-white">
                <h3 class="font-bold mb-2">Butuh Bantuan?</h3>
                <p class="text-sm text-indigo-100 mb-4">Jika terjadi kendala pada project ini, Anda dapat menghubungi tim support kami.</p>
                <a href="#" class="block text-center py-2 bg-white text-indigo-600 rounded-lg font-bold text-sm">Buka Tiket Bantuan</a>
            </div>
        </div>
    </div>
</div>
@endsection