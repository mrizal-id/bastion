<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_label' => str_replace('_', ' ', ucfirst($this->category)),
            'category_raw' => $this->category,
            'budget' => [
                'raw' => (float) $this->total_budget,
                'formatted' => 'IDR ' . number_format($this->total_budget, 0, ',', '.'),
            ],
            'status' => $this->project_status,
            'escrow' => $this->escrow_status,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
