@extends('layouts.app')

@section('header_title', 'Buat Project Baru')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <form action="{{ route('app.projects.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700">Judul Project</label>
            <input type="text" name="title" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Desain Logo Rebranding">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Deskripsi Pekerjaan</label>
            <textarea name="description" rows="4" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Estimasi Budget (IDR)</label>
                <input type="number" name="budget" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Deadline</label>
                <input type="date" name="deadline" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Publikasikan Project
            </button>
        </div>
    </form>
</div>
@endsection