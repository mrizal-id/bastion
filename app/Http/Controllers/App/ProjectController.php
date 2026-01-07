<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar project yang HANYA dimiliki oleh user tersebut.
     */
    public function index()
    {
        $user = Auth::user();

        $projects = Project::query()
            ->when($user->hasRole('brand'), function ($q) use ($user) {
                // Pastikan brand sudah ada profilnya
                $brandId = $user->brand->id ?? null;
                return $q->where('brand_id', $brandId);
            })
            ->when($user->hasRole('customer'), function ($q) use ($user) {
                return $q->where('client_id', $user->id);
            })
            ->with(['brand.ratingSummary', 'client']) // Eager load untuk performa
            ->latest()
            ->paginate(10);

        return view('app.projects.index', compact('projects'));
    }

    /**
     * Menampilkan detail project dengan proteksi kepemilikan.
     */
    public function show(Project $project)
    {
        $user = Auth::user();

        // 1. Logic Proteksi: Jika bukan pemilik (Client) atau pelaksana (Brand), tendang.
        $isOwner = ($user->hasRole('customer') && $project->client_id === $user->id);
        $isAssignee = ($user->hasRole('brand') && $project->brand_id === ($user->brand->id ?? null));

        if (!$isOwner && !$isAssignee) {
            abort(403, 'Anda tidak memiliki akses ke project ini.');
        }

        // 2. Load data pendukung
        $project->load([
            'client',
            'brand.ratingSummary',
            'review'
        ]);

        return view('app.projects.show', compact('project'));
    }

    /**
     * Form pembuatan project (Hanya Client).
     */
    public function create()
    {
        if (!Auth::user()->hasRole('customer')) {
            abort(403, 'Hanya Client yang dapat memulai project baru.');
        }

        $brands = Brand::where('is_verified', true)->get();
        return view('app.projects.create', compact('brands'));
    }

    /**
     * Simpan project baru.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('customer')) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'total_budget' => 'required|numeric|min:100000', // Sesuai field database
            'deadline' => 'required|date|after:today',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $project = Project::create([
            'id' => (string) Str::uuid(),
            'client_id' => Auth::id(),
            'brand_id' => $validated['brand_id'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'total_budget' => $validated['total_budget'],
            'project_status' => 'pending',
            'escrow_status' => 'unpaid', // Inisialisasi status escrow
        ]);

        return redirect()->route('app.projects.index')
            ->with('success', 'Project berhasil dibuat. Silahkan tunggu respon dari Brand.');
    }
}
