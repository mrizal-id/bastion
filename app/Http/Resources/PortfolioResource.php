<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category, // Mengambil dari Accessor Model
            'tags' => $this->tags ?? [],
            'live_url' => $this->live_url,
            'stats' => [
                'views' => (int) $this->view_count,
            ],
            'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail->file_path) : null,
            'gallery' => $this->assets->map(fn($asset) => [
                'type' => $asset->asset_type,
                'url' => asset('storage/' . $asset->file_path),
                'is_main' => (bool) $asset->is_thumbnail,
            ]),
            'published_at' => $this->created_at->format('d M Y'),
        ];
    }
}
