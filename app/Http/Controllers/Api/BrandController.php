<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Menampilkan detail Brand berdasarkan Slug atau Nama.
     * Sudah dioptimasi dengan Eager Loading untuk mencegah N+1 Query.
     */
    public function showByQuery(Request $request)
    {
        $q = $request->query('q');

        if (!$q) {
            return response()->json(['message' => 'Query parameter q is required'], 422);
        }

        $brand = Brand::query()
            ->where(function ($query) use ($q) {
                // Prioritaskan slug (exact match) kemudian nama
                $query->where('slug', $q)
                    ->orWhere('name', 'like', "%{$q}%");
            })
            ->with([
                // 1. Portfolios & detail pendukungnya
                'portfolios' => fn($query) => $query->where('is_published', true)->orderByDesc('created_at'),
                'portfolios.project',
                'portfolios.thumbnail',
                'portfolios.assets' => fn($query) => $query->orderBy('sort_order'),

                // 2. Reviews terbaru (Max 5) untuk social proof
                'reviews' => fn($query) => $query->where('is_hidden', false)->latest()->limit(5),
                'reviews.reviewer', // Memuat user pemberi review (untuk foto profil)

                // 3. Project terbaru (Max 5)
                'projects' => fn($query) => $query->whereIn('project_status', ['active', 'completed'])
                    ->latest()
                    ->limit(5),

                // 4. Rating Summary (Fase 6 Performance Layer)
                'ratingSummary'
            ])
            ->first();

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        // Return menggunakan Resource agar output JSON bersih & Frontend-Friendly
        return new BrandResource($brand);
    }
}
