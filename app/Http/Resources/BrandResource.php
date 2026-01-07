<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'brand_info' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'is_verified' => (bool) $this->is_verified,
                'joined_since' => $this->created_at->format('M Y'),
            ],

            'latest_reviews' => ReviewResource::collection($this->whenLoaded('reviews')),

            'portfolios' => PortfolioResource::collection($this->whenLoaded('portfolios')),

            'recent_projects' => ProjectResource::collection($this->whenLoaded('projects')),

            'reputation' => [
                'average_rating' => (float) ($this->ratingSummary->average_rating ?? 0),
                'total_reviews' => (int) ($this->ratingSummary->total_reviews ?? 0),
            ]
        ];
    }
}
