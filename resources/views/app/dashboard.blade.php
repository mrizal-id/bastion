@extends('layouts.app')

@section('header_title', 'Selamat Datang, ' . auth()->user()->name)

@section('content')
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase">Total Saldo</p>
        <p class="mt-2 text-3xl font-bold text-gray-900">IDR 2.500.000</p>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
        <p class="text-sm font-medium text-gray-500 uppercase">Project Aktif</p>
        <p class="mt-2 text-3xl font-bold text-indigo-600">3</p>
    </div>
</div>

<div class="mt-8 bg-white shadow-sm rounded-lg border border-gray-100">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-800">Aktivitas Terakhir</h3>
    </div>
    <div class="p-6 text-gray-500 text-sm italic">
        Belum ada aktivitas baru.
    </div>
</div>
@endsection